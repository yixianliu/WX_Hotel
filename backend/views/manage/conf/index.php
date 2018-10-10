<?php
/**
 *
 * 网站配置模板
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/1/3
 * Time: 14:53
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '网站配置';

?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row">

                <p>

                    <?= Html::a('添加网站配置', ['create', 'type' => $type], ['class' => "collapsed"]) . ' / ' ?>

                    <?= Html::a('中文版', ['conf', 'type' => 'cn'], ['class' => "collapsed"]) . ' / ' ?>

                    <?= Html::a('英文版', ['conf', 'type' => 'en'], ['class' => "collapsed"]) . ' / ' ?>

                    <?= Html::a('系统配置', ['conf', 'type' => 'system'], ['class' => "collapsed"]) . ' / ' ?>

                </p>

                <hr/>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns'      => [
                        [
                            'class'   => 'yii\grid\SerialColumn',
                            'options' => ['width' => 50]
                        ],
                        [
                            'attribute' => 'name',
                            'options'   => ['width' => 110]
                        ],
                        'parameter',
                        [
                            'attribute' => 'is_language',
                            'value'     => function ($model) {

                                if (empty($model->is_language))
                                    return '系统配置';

                                $state = [
                                    'cn' => '中文',
                                    'en' => '英文',
                                ];

                                return $state[ $model->is_language ];
                            },
                            'options'   => ['width' => 100]
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value'     => function ($model) {
                                return date('Y - m -d , h:i', $model->updated_at);
                            },
                            'options'   => ['width' => 160]
                        ],
                        [
                            'class'   => 'yii\grid\ActionColumn',
                            'options' => ['width' => 80]
                        ],
                    ],
                ]);
                ?>

            </div>
        </div>
    </section>
</div>