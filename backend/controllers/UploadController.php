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

        $attribute = Yii::$app->request->get( 'attribute', 'images' );

        if (empty( $type ) || empty( $ext ) || !Yii::$app->request->isAjax) {
            return Json::encode( ['error' => '参数错误!'] );
        }

        if ($type === 'conf') {
            $model = new Conf();
        } else {
            $typeClass = '\common\models\\' . ucfirst( $type );
            $model = new $typeClass;
        }

        // 上传组件对应model
        if (!($imageFile = UploadedFile::getInstance( $model, $attribute )))
            return Json::encode( ['error' => '上传组件文件异常!'] );

        // 验证后缀名
        if (!static::UploadExt( $ext, $imageFile->extension ))
            return Json::encode( ['error' => '上传格式有问题!'] );

        // 上传路径
        $directory = Yii::getAlias( '@backend/../frontend/web/temp' ) . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR;

        if (!is_dir( $directory ))
            FileHelper::createDirectory( $directory );

        $fileName = self::getRandomString() . '.' . $imageFile->extension;

        $filePath = $directory . $fileName;

        if ($imageFile->saveAs( $filePath )) {

            $path = Yii::getAlias( '@web/../../frontend/web/temp' ) . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $fileName;

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
     * @return string|void
     */
    public function actionUploadSingle()
    {

        $model = new UploadForm();

        if (Yii::$app->request->isPost) {

            $model->imageFile = UploadedFile::getInstance( $model, 'imageFile' );

            if ($model->upload()) {

                // 文件上传成功
                return;
            }
        }

        return $this->render( 'upload', ['model' => $model] );
    }
}