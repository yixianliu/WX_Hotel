<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Conf */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['center/conf']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <p>
                        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?=
                        Html::a('删除', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data'  => [
                                'confirm' => '是否删除这条记录?',
                                'method'  => 'post',
                            ],
                        ]);
                        ?>
                        <?= Html::a('返回列表', ['conf', 'type' => (empty($model->is_language) ? 'system' : $model->is_language)], ['class' => 'btn btn-primary']) ?>
                    </p>

                    <?=
                    DetailView::widget([
                        'model'      => $model,
                        'attributes' => [
                            'c_key',
                            'name',
                            [
                                'attribute' => 'parameter',
                                'format'    => 'html',
                                'value'     => function ($model) {

                                    if ($model->c_key == 'CODE_IMG') {
                                        return '<img width=300 height=300 src="' . Yii::getAlias('@web') . '/temp/conf/' . $model->parameter . '" /><br /><br />';
                                    }

                                    return $model->parameter;
                                },
                            ],
                            'description:ntext',
                            [
                                'attribute' => 'is_language',
                                'value'     => function ($model) {
                                    $state = [
                                        'cn' => '中文',
                                        'en' => '英文',
                                        ''   => '系统配置',
                                    ];

                                    return $state[ $model->is_language ];
                                },
                            ],
                            [
                                'attribute' => 'is_using',
                                'value'     => function ($model) {
                                    $state = [
                                        'On'  => '开启',
                                        'Off' => '未启用',
                                    ];

                                    return $state[ $model->is_using ];
                                },
                            ],
                            [
                                'attribute' => 'created_at',
                                'value'     => function ($model) {
                                    return date('Y - m -d , h:i', $model->created_at);
                                },
                            ],
                            [
                                'attribute' => 'updated_at',
                                'value'     => function ($model) {
                                    return date('Y - m -d , h:i', $model->updated_at);
                                },
                            ],
                        ],
                    ]);
                    ?>

                </div>
            </div>
        </div>
    </section>
</div>
