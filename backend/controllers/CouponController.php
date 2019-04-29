<?php

namespace backend\controllers;

use Yii;
use backend\models\CouponGenerateForm;
use common\models\Coupon;
use common\handel\WxConnHandel;
use common\handel\WxCouponHandel;
use common\models\Hotels;
use common\models\MpConf;
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

        $type = Yii::$app->request->get( 'type', null );

        if (empty( $type )) {

            $dataProvider = new ActiveDataProvider( [
                'query' => Coupon::find()->orderBy( [
                    'id'         => SORT_DESC,
                    'coupon_key' => SORT_DESC,
                ] ),
            ] );

        } else {

            // 获取公众号
            $result['mp'] = MpConf::findOne( ['is_working' => 'On'] );

            if (empty( $result['mp'] ) || empty( $result['mp']->app_id ) || empty( $result['mp']->app_secret )) {
                Yii::$app->getSession()->setFlash( 'error', '无法获取公众号内容!' );
                return $this->redirect( ['index', 'type' => 'wechat'] );
            }

            $token = WxConnHandel::getAccessToken( $result['mp']->app_id, $result['mp']->app_secret );

            $tokenArray = json_decode( $token, true );

            if (empty( $tokenArray['access_token'] )) {

                if (!empty( $tokenArray['errmsg'] )) {
                    Yii::$app->getSession()->setFlash( 'error', $tokenArray['errmsg'] . ' - ' . $tokenArray['errcode'] );
                } else {
                    Yii::$app->getSession()->setFlash( 'error', '没有 Token!' );
                }

                return $this->redirect( ['index', 'type' => 'wechat'] );
            }

            $dataProvider = WxCouponHandel::GetCouponBatch( $tokenArray['access_token'] );
        }

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
            'type'         => $type,
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

            // 事务回滚
            $transaction = Yii::$app->db->beginTransaction();

            $model->begin_time_stamp = strtotime( $model->begin_time_stamp );

            $model->end_time_stamp = strtotime( $model->end_time_stamp );

            // 对应酒店名字
            $hotel = Hotels::findOne( ['hotel_id' => $model->brand_name] );

            $model->brand_name = $hotel->name;

            $result = [];

            // 获取公众号
            $result['mp'] = MpConf::findOne( ['is_working' => 'On'] );

            if (empty( $result['mp'] ) || empty( $result['mp']->app_id ) || empty( $result['mp']->app_secret )) {
                Yii::$app->getSession()->setFlash( 'error', '无法获取公众号内容!' );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            $token = WxConnHandel::getAccessToken( $result['mp']->app_id, $result['mp']->app_secret );

            $tokenArray = json_decode( $token, true );

            if (empty( $tokenArray['access_token'] )) {

                if (!empty( $tokenArray['errmsg'] )) {
                    Yii::$app->getSession()->setFlash( 'error', $tokenArray['errmsg'] . ' - ' . $tokenArray['errcode'] );
                } else {
                    Yii::$app->getSession()->setFlash( 'error', '没有 Token!' );
                }

                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            $array = [
                'title'         => $model->title,
                'card_type'     => $model->card_type,
                'color'         => 'Color010',
                'code_type'     => $model->code_type,
                'notice'        => '使用时向服务员出示此券',
                'logo_url'      => 'http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZJkmG8xXhiaHqkKSVMMWeN3hLut7X7hicFNjakmxibMLGWpXrEXB33367o7zHN0CwngnQY7zb7g/0',
                'brand_name'    => $model->brand_name, // 商户名字,字数上限为12个汉字。
                'service_phone' => $model->service_phone, // 客服电话。
                'description'   => $model->description,
                'quantity'      => $model->quantity, // 卡券库存的数量，上限为100000000
            ];

            if (!($response = WxCouponHandel::CreateCardData( $array, $tokenArray['access_token'] ))) {
                Yii::$app->getSession()->setFlash( 'error', '创建卡券失败!' );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            if (!empty( $response['errcode'] ) && !empty( $response['errmsg'] )) {
                Yii::$app->getSession()->setFlash( 'error', $response['errmsg'] . ' - ' . $response['errcode'] );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            // 创建公众号后生成 Card Id
            $model->card_id = $response['card_id'];

            if (!$model->save()) {
                Yii::$app->getSession()->setFlash( 'error', '保存卡券失败!' );
                $transaction->rollBack();
                return $this->redirect( ['create'] );
            }

            Yii::$app->getSession()->setFlash( 'success', '创建卡券成功!' );

            $transaction->commit();

            return $this->redirect( ['view', 'id' => $model->id] );
        }

        $model->coupon_key = self::getRandomString();

        $result['hotel'] = Hotels::getHotelSelect();

        return $this->render( 'create', ['model' => $model, 'result' => $result] );
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
