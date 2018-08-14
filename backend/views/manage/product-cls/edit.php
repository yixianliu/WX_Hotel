<?php

/**
 * @abstract 产品列表模板
 * @author   Yxl <zccem@163.com>
 */


$this->title = '编辑产品分类 - ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => '产品分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<?= $this->render('_form', ['model' => $model, 'result' => $result]) ?>

