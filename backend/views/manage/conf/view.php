<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Confs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conf-view">

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
            'language',
            'name',
            'title',
            'email:email',
            'phone',
            'keywords',
            'site_url:url',
            'developers',
            'icp',
            'description:ntext',
            'copyright',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
