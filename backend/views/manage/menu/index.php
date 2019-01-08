<?php

use yii\helpers\Html;

$this->title = '菜单列表';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-12">

    <div class="form-group">
        <?= Html::a( '创建菜单', ['create'], ['class' => 'btn btn-primary btn-lg'] ) ?>
        <?= Html::a( '创建单页面', ['admin/pages/create'], ['class' => 'btn btn-primary btn-lg'] ) ?>
        <?= Html::a( '创建单页面分类', ['admin/pages-cls/create'], ['class' => 'btn btn-primary btn-lg'] ) ?>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

        <div class="panel-body">

            <?php if (!empty( $dataProvider )): ?>

                <ul class="uk-nestable" style="font-size: 13px;">
                    <?= $html ?>
                </ul>

            <?php else: ?>

                没有菜单 !!

            <?php endif; ?>

        </div>
    </div>
</div>
