<?php

namespace backend\controllers;

use backend\models\CouponGenerateForm;
use common\handel\WxConnHandel;
use common\handel\WxCouponHandel;
use common\models\MpConf;
use Yii;
use common\models\Coupon;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * CouponController implements the CRUD actions for Coupon model.
 */
class CouponController extends BaseController
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
     * Lists all Coupon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider( [
            'query' => Coupon::find()->orderBy( [
                'id'         => SORT_DESC,
                'coupon_key' => SORT_DESC,
            ] ),
        ] );

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Coupon model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new Coupon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Coupon();

        $model->quantity = 999;

        if ($model->load( Yii::$app->request->post() )) {

            $transaction = Yii::app()->db->beginTransaction();

            if (!$model->save()) {
                Yii::$app->getSession()->setFlash( 'error', '保存卡券失败!' );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            $result = [];

            // 获取公众号
            $result['mp'] = MpConf::findOne( ['is_working' => 'On'] );

            if (empty( $result['mp'] ) || empty( $result['mp']->app_id ) || empty( $result['mp']->app_secret )) {
                Yii::$app->getSession()->setFlash( 'error', '无法获取公众号内容!' );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            $token = WxConnHandel::getAccessToken( $result['mp']->app_id, $result['mp']->app_secret );

            $array = [
                'title'         => $model->title,
                'color'         => 'Color010',
                'code_type'     => $model->code_type,
                'notice'        => '使用时向服务员出示此券',
                'logo_url'      => '',
                'brand_name'    => '', // 商户名字,字数上限为12个汉字。
                'service_phone' => '', // 客服电话。
                'description'   => $model->description,
                'deal_detail'   => $model->deal_detail,
                'quantity'      => $model->quantity, // 卡券库存的数量，上限为100000000
            ];

            if (!($response = WxCouponHandel::ConnData( $array, $token['access_token'] ))) {
                Yii::$app->getSession()->setFlash( 'error', '创建卡券失败!' );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            return $this->redirect( ['view', 'id' => $model->id] );
        }

        $model->coupon_key = self::getRandomString();

        return $this->render( 'create', ['model' => $model,] );
    }

    /**
     * Updates an existing Coupon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel( $id );

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        }

        return $this->render( 'update', ['model' => $model,] );
    }

    /**
     * Deletes an existing Coupon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel( $id )->delete();

        return $this->redirect( ['index'] );
    }

    /**
     * Finds the Coupon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Coupon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if (($model = Coupon::findOne( $id )) !== null) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }

}
