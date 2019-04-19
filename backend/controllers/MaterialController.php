<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/17
 * Time: 16:31
 */

namespace backend\controllers;

use backend\models\UploadMaterialForm;
use Yii;
use common\handel\WxConnHandel;
use common\models\MpConf;
use common\handel\WxMaterialHandel;

/**
 * JobController implements the CRUD actions for Job model.
 */
class MaterialController extends BaseController
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
     * 素材列表
     *
     * @return string
     */
    public function actionIndex()
    {

        $wxResult = MpConf::findOne( ['is_working' => 'On'] );

        $tokenJson = WxConnHandel::getAccessToken( $wxResult->app_id, $wxResult->app_secret );

        $tokenArray = json_decode( $tokenJson, true );

        $result = [];

        if (empty( $tokenArray['access_token'] )) {
            Yii::$app->getSession()->setFlash( 'error', '无法获取 Token!' );
        } else {
            $resultJson = WxMaterialHandel::GetWxList( $tokenArray['access_token'] );

            $result = json_decode( $resultJson, true );
        }

        return $this->render( 'index', ['result' => $result] );
    }

    /**
     * 上传素材
     *
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {

        if (Yii::$app->request->isPost) {

            $wxResult = MpConf::findOne( ['is_working' => 'On'] );

            $tokenJson = WxConnHandel::getAccessToken( $wxResult->app_id, $wxResult->app_secret );

            $tokenArray = json_decode( $tokenJson, true );

            $post = Yii::$app->request->post();

            // 图片数组
            $postArray = explode( ',', $post['UploadMaterialForm']['images'] );

            if (!($response = WxMaterialHandel::UploadMaterial( $postArray, $tokenArray['access_token'] ))) {
                Yii::$app->getSession()->setFlash( 'error', '上传失败!' );
                return $this->redirect( ['material/index'] );
            }

            if (!empty( $response['errmsg'] )) {
                Yii::$app->getSession()->setFlash( 'error', $response['errmsg'] );
                return $this->redirect( ['material/index'] );
            }

            $session = Yii::$app->session;

            $session->set('material', $response);

            Yii::$app->getSession()->setFlash( 'success', '上传成功!' );

            return $this->redirect( ['material/index'] );
        }

        $model = new UploadMaterialForm();

        return $this->render( 'create', ['model' => $model] );
    }
}