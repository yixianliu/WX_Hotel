<?php

namespace backend\controllers;

use Yii;
use common\models\RoomsClassify;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * RoomsClsController implements the CRUD actions for RoomsClassify model.
 */
class RoomsClsController extends BaseController
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
     * Lists all RoomsClassify models.
     * @return mixed
     */
    public function actionIndex()
    {

        // 初始化
        $result = [];

        $data = RoomsClassify::findByAll('On', RoomsClassify::$parentId);

        foreach ($data as $key => $value) {
            $result[] = RoomsClassify::recursionData($value['c_key']);
        }

        return $this->render('index', [
            'result' => $result,
        ]);
    }

    /**
     * Displays a single RoomsClassify model.
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
     * Creates a new RoomsClassify model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RoomsClassify();

        $model->c_key = self::getRandomString();

        $model->parent_id = Yii::$app->request->get('id', null);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $result['classify'] = RoomsClassify::getClsSelect('On');

        return $this->render('create', [
            'model'  => $model,
            'result' => $result,
        ]);
    }

    /**
     * Updates an existing RoomsClassify model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $result['classify'] = RoomsClassify::getClsSelect('On');

        return $this->render('update', [
            'model'  => $model,
            'result' => $result,
        ]);
    }

    /**
     * Deletes an existing RoomsClassify model.
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
     * Finds the RoomsClassify model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return RoomsClassify the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoomsClassify::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
