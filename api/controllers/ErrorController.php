<?php
/**
 *
 * Error 页面
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/3/22
 * Time: 16:23
 */

namespace api\controllers;

use Yii;
use yii\web\Controller;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class ErrorController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionError()
    {

        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null) {
            return $this->render( 'error', ['exception' => $exception] );
        }
    }
}