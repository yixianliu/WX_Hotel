<?php

namespace frontend\controllers;

use Yii;
use common\models\Order;
use common\models\Hotels;
use common\models\Rooms;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use linslin\yii2\curl;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends BaseController
{

    private static $curlUrl = 'http://www.yxlcms.com:7777/Wx_Platform/backend/web/index.php/order-hotel/index';

    /**
     * {@inheritdoc}
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
                    'logout' => ['post'],
                ],
            ],
        ];

    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider( [
            'query' => Order::find(),
        ] );

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        // 房间
        $roomModel = Rooms::findOne( ['id' => Yii::$app->request->get( 'id', null )] );

        // 酒店
        $hotelModel = Hotels::findOne( ['hotel_id' => Yii::$app->request->get( 'hid', null )] );

        if (empty( $roomModel ) || empty( $hotelModel )) {
            Yii::$app->session->setFlash( 'error', '模型产生异常!' );
        }

        if ($model->load( Yii::$app->request->post() )) {

            $model->title = $roomModel->title . ' + ' . Yii::$app->user->identity->user_id . ' + ' . self::getRandomString();
            $model->room_id = $roomModel->room_id;
            $model->user_id = Yii::$app->user->identity->user_id;
            $model->hotel_id = $hotelModel->hotel_id;
            $model->username = 'admin';
            $model->place_order = time();

            $transaction1 = Yii::$app->db->beginTransaction();

            // 保存订单出错
            if (!$model->save()) {
                $transaction1->rollBack();
                Yii::$app->session->setFlash( 'error', '数据异常!' );
                return $this->redirect( ['order/create', 'hid' => Yii::$app->request->get( 'hid', null ), 'id' => Yii::$app->request->get( 'id', null )] );
            }

            // Init curl
            $curl = new curl\Curl();

            $array = [
                'type'      => 'hotel',
                'type_name' => '微酒店',
            ];

            $array = array_merge( $array, $model->toArray() );

            $response = $curl->setPostParams( $array )
                ->setHeaders( ['Content-Type' => 'application/json', 'Content-Length' => strlen( json_encode( $array ) )] )
                ->setOption( CURLOPT_TIMEOUT, 60 )
                ->post( static::$curlUrl );

            if (!empty( $curl->errorCode ) || !empty( $curl->errorText )) {

                $transaction1->rollBack();

                if (empty( $curl->errorText )) {
                    Yii::$app->session->setFlash( 'error', '订单服务器异常!' );
                } else {
                    Yii::$app->session->setFlash( 'error', $curl->errorText . ' - ' . $curl->errorCode );
                }

                return $this->redirect( ['order/create', 'hid' => Yii::$app->request->get( 'hid', null ), 'id' => Yii::$app->request->get( 'id', null )] );
            }

            $transaction1->commit();

            Yii::$app->session->setFlash( 'success', '等待付款!' );

            return $this->redirect( ['view', 'id' => $model->id, 'response' => $response] );
        }

        $model->order_id = self::getRandomString();

        return $this->render( 'create', [
            'model'      => $model,
            'hotelModel' => $hotelModel,
            'roomModel'  => $roomModel,
        ] );
    }

    /**
     * Updates an existing Order model.
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

        return $this->render( 'update', [
            'model' => $model,
        ] );
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne( $id )) !== null) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
