<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/25
 * Time: 15:45
 */

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;

class RoomsController extends ActiveController
{
    public $modelClass = 'common\models\Rooms';
}