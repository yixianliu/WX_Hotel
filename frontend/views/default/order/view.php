<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        <?= Html::a( '更新', ['更新', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
        <?= Html::a( '删除', ['删除', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => '是否删除这条记录?',
                'method'  => 'post',
            ],
        ] ) ?>
    </p>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'hotel_id',
            'room_id',
            'user_id',
            'c_key',
            'price',
            'title',
            'content:ntext',
            'keywords',
            'username',
            'path',
            'num',
            'check_in',
            'check_out',
            'pay_type',
            'express_type',
            'is_using',
            'place_order',
            'pay_order',
            'created_at',
            'updated_at',
        ],
    ] ) ?>

</div>

<script>
    window.open("<?= $TargetUrl ?>", "_blank");
</script>
