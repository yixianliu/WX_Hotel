<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/17
 * Time: 16:31
 */

namespace backend\controllers;

use common\handel\WxConnHandel;
use common\models\MpConf;
use Yii;
use common\handel\WxMaterialHandel;
use yii\web\NotFoundHttpException;

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

    public function actionIndex()
    {

        $wxResult = MpConf::findOne( ['is_working' => 'On'] );

        print_r($wxResult);

        $token = WxConnHandel::getAccessToken( $wxResult->app_id, $wxResult->app_secret );

        $result = WxMaterialHandel::GetWxList( $token );

        exit($result);

        return $this->render( 'index', ['result' => $result] );
    }

}