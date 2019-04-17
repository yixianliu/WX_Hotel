<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/17
 * Time: 16:31
 */

namespace backend\controllers;

use Yii;
use common\models\Job;
use yii\data\ActiveDataProvider;
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
        return $this->render( 'index' );
    }

}