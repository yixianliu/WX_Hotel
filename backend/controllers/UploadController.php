<?php
/**
 *
 * 上传控制器
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/12/8
 * Time: 15:15
 */

namespace backend\controllers;

use backend\models\UploadMaterialForm;
use backend\models\UploadSingleForm;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use common\models\Conf;
use common\models\Assist;

/**
 * SlideController implements the CRUD actions for Slide model.
 */
class UploadController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class'   => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * 上传文件
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionUploads()
    {

        $type = Yii::$app->request->get( 'type', null );

        $ext = Yii::$app->request->get( 'ext', null );

        $id = Yii::$app->request->get( 'id', null );

        $attribute = Yii::$app->request->get( 'attribute', 'images' );

        if (empty( $type ) || empty( $ext ) || !Yii::$app->request->isAjax) {
            return Json::encode( ['error' => '参数错误!'] );
        }

        if ($type === 'conf') {
            $model = new Conf();

        } else if ($type === 'material') {
            $model = new UploadMaterialForm();

        } else {
            $typeClass = '\common\models\\' . ucfirst( $type );
            $model = new $typeClass;
        }

        // 上传组件对应model
        if (!($imageFile = UploadedFile::getInstance( $model, $attribute ))) {
            return Json::encode( ['error' => '上传组件文件异常!'] );
        }

        // 验证后缀名
        if (!static::UploadExt( $ext, $imageFile->extension )) {
            return Json::encode( ['error' => '上传格式有问题!'] );
        }

        // 根据ID来生成路径
        if (!empty($id)) {
            $EndPath = DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $id;
        } else {
            $EndPath = DIRECTORY_SEPARATOR . $type;
        }

        // 上传路径
        $directory = Yii::getAlias( '@backend/../frontend/web/temp' ) . $EndPath;

        if (!is_dir( $directory )) {
            FileHelper::createDirectory( $directory );
        }

        $fileName = self::getRandomString() . '.' . $imageFile->extension;

        if ($imageFile->saveAs( $directory . DIRECTORY_SEPARATOR . $fileName )) {

            $path = Yii::getAlias( '@web/../../frontend/web/temp' ) . $EndPath . DIRECTORY_SEPARATOR . $fileName;

            return Json::encode( [

                'files' => [
                    [
                        'name'         => $fileName,
                        'size'         => $imageFile->size,
                        'url'          => $path,
                        'thumbnailUrl' => $path,
                    ],
                ],
            ] );
        }

        return Json::encode( ['error' => '上传失败!'] );
    }

    /**
     * 获取网站配置来判断后缀
     *
     * @param $ext
     * @param $fileExt
     *
     * @return bool
     */
    public static function UploadExt($ext, $fileExt)
    {

        if (empty( $ext ) || empty( $fileExt ))
            return false;

        $result = Assist::findByData();

        if (empty( $result ))
            return true;

        switch ($ext) {

            case 'image':

                if (empty( $result['IMAGE_UPLOAD_TYPE'] ) || strpos( $result['IMAGE_UPLOAD_TYPE'], $fileExt ) === false) {
                    return false;
                }
                break;

            case 'file':

                if (empty( $result['FILE_UPLOAD_TYPE'] ) || strpos( $result['FILE_UPLOAD_TYPE'], $fileExt ) === false) {
                    return false;
                }
                break;

            default:

                break;
        }

        return true;
    }

    /**
     * 删除(针对上传组件 2amigos/yii2-file-upload-widget)
     *
     * @param $name
     * @param $type
     *
     * @return string
     */
    public function actionImageDelete($name, $type)
    {

        if (empty( $name ) || empty( $type )) {
            return Json::encode( ['message' => '参数有误 !!'] );
        }

        $directory = Yii::getAlias( '@frontend/web/temp/' ) . DIRECTORY_SEPARATOR . $type;

        if (is_file( $directory . DIRECTORY_SEPARATOR . $name )) {
            unlink( $directory . DIRECTORY_SEPARATOR . $name );
        }

        $files = FileHelper::findFiles( $directory );

        $output = [];

        foreach ($files as $file) {

            $fileName = basename( $file );
            $path = '/img/temp/' . $type . DIRECTORY_SEPARATOR . $fileName;

            $output['files'][] = [
                'name'         => $fileName,
                'size'         => filesize( $file ),
                'url'          => $path,
                'thumbnailUrl' => $path,
                'deleteUrl'    => Url::to( ['upload/image-delete', 'name' => $fileName, 'type' => $type] ),
                'deleteType'   => 'GET',
            ];
        }

        return Json::encode( $output );
    }

    /**
     * 单个文件上传 (自己开发版本)
     *
     * @param $type
     * @param $id
     *
     * @return string|void
     * @throws \yii\base\Exception
     */
    public function actionUploadSingle($type, $id)
    {

        if (empty( $type ) || empty( $id )) {
            return Json::encode( ['msg' => '提交参数有误!'] );
        }

        if (!Yii::$app->request->isPost) {
            return Json::encode( ['msg' => '提交方式有误!'] );
        }

        $ImageFiles = UploadedFile::getInstanceByName( 'UploadFileSimple' );

        // 上传路径
        $directory = Yii::getAlias( '@backend/../frontend/web/temp' ) . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $id;

        if (!is_dir( $directory ))
            FileHelper::createDirectory( $directory );

        $fileNewName = self::getRandomString() . '.' . $ImageFiles->extension;

        $filePath = $directory . DIRECTORY_SEPARATOR . $fileNewName;

        if ($ImageFiles->saveAs( $filePath )) {
            return Json::encode( ['msg' => '上传成功!', 'status' => true, 'path' => $fileNewName] );
        }

        return Json::encode( ['msg' => '参数有误!'] );
    }
}