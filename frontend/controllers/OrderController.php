<?php

namespace frontend\controllers;

use common\models\Hotels;
use common\models\Rooms;
use Yii;
use common\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
        $roomModel = Rooms::findOne(['id' => Yii::$app->request->get('id', null)]);

        // 酒店
        $hotelModel = Hotels::findOne(['hotel_id' => Yii::$app->request->get('hid', null)]);

        if ( empty($roomModel) || empty($hotelModel) ) {
            Yii::$app->session->setFlash('error', '模型异常!');
        }

        if ( $model->load(Yii::$app->request->post()) && $model->save() ) {

            $model->room_id = $roomModel->room_id;
            $model->user_id = Yii::$app->user->identity->user_id;
            $model->hotel_id = $hotelModel->hotel_id;
            $model->username = 'admin';
            $model->place_order = time();

            if ( !$model->save() ) {
                Yii::$app->session->setFlash('error', '数据异常!');
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model'      => $model,
            'hotelModel' => $hotelModel,
            'roomModel'  => $roomModel,
        ]);
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
        $model = $this->findModel($id);

        if ( $model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if ( ($model = Order::findOne($id)) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
