<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/8/27
 * Time: 16:42
 */

namespace frontend\controllers\user;

use Yii;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class CenterController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}