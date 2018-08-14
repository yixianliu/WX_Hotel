<?php

/**
 * @abstract 产品控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\Product;
use common\models\ProductClassify;
use common\models\ProductLevel;

class ProductController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		
        return [

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @abstract 列表
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query'      => Product::find(),
            'pagination' => [
                'pageSize' => self::$assist['VIEW_NUM'],
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {

        $model = new Product();

        $model->user_id = '网站负责人';

        $model->product_id = self::getRandomString();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $result['classify'] = ProductClassify::getClsSelect('Off');

        $result['level'] = ProductLevel::getClsSelect();

        return $this->render('create', ['model' => $model, 'result' => $result]);
    }

    /**
     * @abstract 编辑
     */
    public function actionUpdate($id)
    {

        $model = Product::findOne(['product_id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $result['classify'] = ProductClassify::getClsSelect();

        $result['level'] = ProductLevel::findBySql();

        return $this->render('edit', ['model' => $model, 'result' => $result]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Finds the AuthRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return AuthRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @abstract 停用
     */
    public function actionStop()
    {

    }

}
