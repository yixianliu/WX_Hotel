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
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '配置中心';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加优惠卷'>添加配置</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?=
            GridView::widget( [
                'dataProvider' => $dataProvider,
                'columns'      => [
                    [
                        'class'   => 'yii\grid\SerialColumn',
                        'options' => ['width' => 50],
                    ],
                    [
                        'attribute' => 'name',
                        'options'   => ['width' => 110],
                    ],
                    [
                        'attribute' => 'title',
                        'options'   => ['width' => 130],
                    ],
                    [
                        'attribute' => 'site_url',
                        'options'   => ['width' => 150],
                    ],
                    [
                        'attribute' => 'phone',
                        'options'   => ['width' => 110],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return date( 'Y - m -d , h:i', $model->updated_at );
                        },
                        'options'   => ['width' => 160],
                    ],
                    [
                        'class'   => 'yii\grid\ActionColumn',
                        'options' => ['width' => 80],
                    ],
                ],
                'tableOptions' => ['class' => 'table table-hover'],
                'pager'        => [
                    'options' => ['class' => 'pagination'],
                ],
            ] );
            ?>

        </div>
    </div>

    <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

</div>