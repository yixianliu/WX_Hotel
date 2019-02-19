<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '小程序设置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mini-program-conf-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除这条记录?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'conf_id',
            'weixin_id',
            'app_id',
            'mch_id',
            'api_psw',
            'cert_path',
            'cert_psw',
            'is_using',
            [
                'attribute' => 'created_at',
                'value'     => function ($model) {
                    return date( 'Y - m -d , h:i', $model->created_at );
                },
            ],
            [
                'attribute' => 'updated_at',
                'value'     => function ($model) {
                    return date( 'Y - m -d , h:i', $model->updated_at );
                },
            ],
        ],
    ]) ?>

</div>
