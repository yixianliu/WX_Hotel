<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/2/19
 * Time: 15:19
 */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '用户中心';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<a href='<?= Url::to( ['user/rooms-appointment/index'] ) ?>' class='btn btn-primary' title='添加预约'>预约管理</a>

<a href='<?= Url::to( ['user/credit/index'] ) ?>' class='btn btn-primary' title='添加预约'>积分记录</a>

<a href='<?= Url::to( ['user/order/index'] ) ?>' class='btn btn-primary' title='添加预约'>订单记录</a>

<a href='<?= Url::to( ['user/coupon/index'] ) ?>' class='btn btn-primary' title='添加预约'>卡券管理</a>