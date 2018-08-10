<?php

/**
 * @abstract 上传图片功能
 * @author Yxl <zccem@163.com>
 */

namespace common\widgets\iUpload;

use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class UploadImgAction extends Action
{

    private $oriName; // 原始文件名
    private $fileName; // 新文件名
    private $fullName; // 完整文件名,即从当前配置目录开始的URL
    private $filePath; // 完整文件名,即从当前配置目录开始的URL
    private $fileSize; // 文件大小
    private $fileType; // 文件类型
    private $stateInfo; // 上传状态信息

    /**
     * 配置信息
     * @var array
     */
    public $config = [];

    /**
     * 构造
     */
    public function init()
    {

        // close csrf
        Yii::$app->request->enableCsrfValidation = false;

        // 默认设置
        $_config = require(__DIR__ . '/config.php');

        // load config file
        $this->config = ArrayHelper::merge($_config, $this->config);

        parent::init();
    }

    /**
     * @abstract 运行
     */
    public function run()
    {

        // 操作选择
        switch (Yii::$app->request->get('action', null)) {

            // 上传图片
            case 'uploadimage':
                $result = $this->ActUpload();
                break;

            // error
            default:
                $result = json_encode(array(
                    'state' => '请求地址出错'
                ));
                break;
        }

        exit($result);
    }

    /**
     * 上传,得到上传文件所对应的各个参数,数组结构
     *
     * @return string
     */
    protected function ActUpload()
    {

        // Remove old files
        $cleanupTargetDir = true;

        // Temp file age in seconds
        $maxFileAge = 5 * 3600;

        // 类型
        $type = Yii::$app->request->get('type', null);

        // 文件Id
        $id = Yii::$app->request->get('id', 0);

        if (empty($type)) {
            return Json::encode(['message' => '没有图片属性类型 !!']);
        }

        if (empty($id)) {
            return Json::encode(['message' => '没有图片ID !!']);
        }

        // 创建和获取上传目录
        if (!($uploadDir = $this->getFilePath())) {
            return Json::encode(['message' => '没有指定目录 !!']);
        }

        // 临时目录
        $targetDir = $this->config['imagePathFormat'] . DIRECTORY_SEPARATOR . 'upload_tmp';

        // Create Temp dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // 获取文件名
        if (isset($_REQUEST["name"])) {
            $fileUploadName = $_REQUEST["name"];
        } else if (!empty($_FILES)) {
            $fileUploadName = $_FILES["file"]["name"];
        } else {
            $fileUploadName = uniqid("file_");
        }

        // 后缀名
        $ext = strtolower(strrchr($fileUploadName, '.'));

        // 检查文件大小是否超出限制
        if (!empty($fileUploadName['size'])) {
            if (!$this->checkSize($fileUploadName['size'])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "文件大小不符合!!"}, "id" : "id"}');
            }
        }

        // 检查是否不允许的文件格式
        if (!in_array($ext, $this->config["imageAllowFiles"])) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "文件类型不允许!!"}, "id" : "id"}');
        }

        $fileName = time() . '_' . rand(0, 999) . $ext;

        // 上传图片路径
        $uploadFilePath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

        // Temp 上传
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;

        // Remove old temp files
        if ($cleanupTargetDir) {

            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }
                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }

        // Open temp file
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }
            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }
        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;

        for ($index = 0; $index < $chunks; $index++) {
            if (!file_exists("{$filePath}_{$index}.part")) {
                $done = false;
                break;
            }
        }

        if ($done) {

            if (!$out = @fopen($uploadFilePath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if (flock($out, LOCK_EX)) {

                for ($index = 0; $index < $chunks; $index++) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }
                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }
                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }

            @fclose($out);
        }

        // 返回 Json
        $result = array(
            'jsonrpc' => '2.0',
            'id'      => 'id',
            'result'  => array(
                'filename'  => $fileName,
                'uploadDir' => Yii::$app->request->get('id'),
            ),
        );

        return \yii\helpers\Json::encode($result);
    }

    /**
     * 获取文件名
     *
     * @return string
     */
    private function getFileName()
    {
        return substr($this->filePath, strrpos($this->filePath, '/') + 1);
    }

    /**
     * 获取文件完整路径
     *
     * @return string
     */
    private function getFilePath()
    {

        // 获取文件Id
        $id = Yii::$app->request->get('id', 0);

        // 上传目录
        if (!empty($id) && is_numeric($id)) {

            // Id 目录
            $idPath = $this->config['imagePathFormat'] . DIRECTORY_SEPARATOR . $id;

        } else {

            // Id 目录
            $idPath = $this->config['imagePathFormat'] . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . $id;
        }

        $uploadDir = $idPath . DIRECTORY_SEPARATOR . Yii::$app->request->get('type');

        // Create Id dir
        if (!file_exists($idPath)) {
            @mkdir($idPath);
        }

        // Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

        return $uploadDir;
    }

    /**
     * 文件大小检测
     *
     * @param int $size 图片文件大小
     * @return bool
     */
    private function checkSize($size)
    {
        return $size <= ($this->config["imageMaxSize"] * 1024 * 1024);
    }

    /**
     * desription 压缩图片
     * @param sting $imgsrc 图片路径
     * @param string $imgdst 压缩后保存路径
     */
    function image_png_size_add($imgsrc, $imgdst)
    {

        list($width, $height, $type) = getimagesize($imgsrc);

        $new_width = ($width > 600 ? 600 : $width) * 0.9;

        $new_height = ($height > 600 ? 600 : $height) * 0.9;

        switch ($type) {
            case 1:
                $giftype = check_gifcartoon($imgsrc);
                if ($giftype) {
                    header('Content-Type:image/gif');
                    $image_wp = imagecreatetruecolor($new_width, $new_height);
                    $image = imagecreatefromgif($imgsrc);
                    imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                    imagejpeg($image_wp, $imgdst, 75);
                    imagedestroy($image_wp);
                }
                break;
            case 2:
                header('Content-Type:image/jpeg');
                $image_wp = imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefromjpeg($imgsrc);
                imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_wp, $imgdst, 75);
                imagedestroy($image_wp);
                break;
            case 3:
                header('Content-Type:image/png');
                $image_wp = imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefrompng($imgsrc);
                imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_wp, $imgdst, 75);
                imagedestroy($image_wp);
                break;
        }
    }

    /**
     * desription 判断是否gif动画
     * @param sting $image_file图片路径
     * @return boolean t 是 f 否
     */
    function check_gifcartoon($image_file)
    {
        $fp = fopen($image_file, 'rb');
        $image_head = fread($fp, 1024);
        fclose($fp);

        return preg_match("/" . chr(0x21) . chr(0xff) . chr(0x0b) . 'NETSCAPE2.0' . "/", $image_head) ? false : true;
    }

}
