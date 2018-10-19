<?php

namespace backend\controllers;

use Yii;
use common\models\Conf;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConfController implements the CRUD actions for Conf model.
 */
class ConfController extends Controller
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
     * Lists all Conf models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider( [
            'query' => Conf::find(),
        ] );

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Conf model.
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
     * Creates a new Conf model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Conf();

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( ['view', 'id' => $model->id] );
        }

        return $this->render( 'create', [
            'model' => $model,
        ] );
    }

    /**
     * Updates an existing Conf model.
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
     * Deletes an existing Conf model.
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
     * Finds the Conf model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Conf the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conf::findOne( $id )) !== null) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
