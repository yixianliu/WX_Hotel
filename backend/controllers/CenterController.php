<?php

/**
 * @abstract 首页控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use common\models\Product;
use common\models\User;
use common\models\Conf;

class CenterController extends BaseController
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
                        'roles' => [ '@' ],
                    ],
                ],
            ],

            'verbs' => [
                'class'   => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'POST' ],
                ],
            ],
        ];
    }

    /**
     * @abstract 首页
     */
    public function actionIndex()
    {

        return $this->render( 'index' );
    }

    /**
     * @abstract 网页配置单
     */
    public function actionView()
    {

        // 初始化
        $result = [];

        $result['noAuditProduct'] = Product::findByAll( 'On' );

        $result['noAuditUser'] = User::findByAll( 'Off' );

        return $this->render( 'view', [ 'result' => $result ] );
    }

    /**
     * @abstract 数据库备份
     */
    public function actionBackup()
    {

        $model = new ConfForm;

        return $this->render( 'backup', [ 'model' => $model ] );
    }

    /**
     * @abstract 数据库列表
     */
    public function actionDblist()
    {

        return $this->render( 'dblist' );
    }

}
