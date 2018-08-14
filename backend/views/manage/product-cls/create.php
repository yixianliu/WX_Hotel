<?php

/**
 * @abstract 产品列表模板
 * @author   Yxl <zccem@163.com>
 */

$this->title = '添加产品分类';

$this->params['breadcrumbs'][] = ['label' => '产品分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_form', ['model' => $model, 'result' => $result]) ?>

