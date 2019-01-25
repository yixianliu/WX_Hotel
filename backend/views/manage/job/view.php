<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '招聘管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <h1><?= Html::encode( $this->title ) ?></h1>

            <p>
                <?= Html::a( '更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => '是否删除这条记录?',
                        'method'  => 'post',
                    ],
                ] ) ?>
                <?= Html::a( '返回列表', ['index'], ['class' => 'btn btn-primary'] ) ?>
                <?= Html::a( '继续添加', ['create'], ['class' => 'btn btn-primary'] ) ?>
            </p>

            <?= DetailView::widget( [
                'model'      => $model,
                'attributes' => [
                    'job_id',
                    'user_id',
                    'title',
                    'keywords',
                    [
                        'attribute' => 'images',
                        'format'    => 'html',
                        'value'     => function ($model) {

                            if (empty( $model->images )) {
                                return '<img width="280" height="150" src="' . Yii::getAlias( '@web/../../frontend/web/img/' ) . 'not.jpg' . '" alt="' . $model->title . '" />';
                            }

                            $imagesData = explode( ',', $model->images );

                            $html = '<div class="row">';
                            foreach ($imagesData as $value) {

                                if (empty( $value ))
                                    continue;

                                $html .= '<div class="col-md-3">';
                                $html .= '<img width="340" height="220" src="' . Yii::getAlias( '@web/../../frontend/web/temp/job/' ) . $value . '" alt="' . $model->title . '" />';
                                $html .= '</div>';
                            }
                            $html .= '</div>';

                            return $html;
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'is_language',
                        'value'     => function ($model) {
                            $data = \common\models\Language::findOne( ['lang_key' => $model->is_language] );
                            return $data['name'];
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
                            return date( 'Y - m -d , H:i:s', $model->created_at );
                        },
                        'options'   => ['width' => 180],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , H:i:s', $model->updated_at );
                        },
                        'options'   => ['width' => 180],
                    ],
                    'content:html',
                ],
                'template'   => '<tr><th width="200">{label}</th><td>{value}</td></tr>',
            ] ) ?>

        </div>
    </div>
</div>
