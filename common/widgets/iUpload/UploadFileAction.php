<?php

/**
 * @abstract 上传文件功能
 * @author Yxl <zccem@163.com>
 */

namespace common\widgets\iUpload;

use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class UploadFileAction extends Action
{

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

        switch (Yii::$app->request->get('action', null)) {

            // 上传文件
            case 'uploadfile':
                $result = $this->ActUpload();
                break;
            // error
            default:
                $result = json_encode(array(
                    'state' => '请求地址出错'
                ));
                break;
        }

        echo $result;
    }

    /**
     * 上传
     * @return string
     */
    protected function ActUpload()
    {

        $config = array(
            "pathFormat" => $this->config['filePathFormat'],
            "maxSize"    => $this->config['fileMaxSize'],
            "allowFiles" => $this->config['fileAllowFiles'],
        );

        $fieldName = $this->config['imageFieldName'];

        $config['uploadFilePath'] = isset($this->config['uploadFilePath']) ? $this->config['uploadFilePath'] : '';

        // 生成上传实例对象并完成上传
        if (!$this->upFile($fieldName)) {
            return json_encode(false);
        }

        // 返回数据
        return json_encode($this->getFileInfo());
    }

}
