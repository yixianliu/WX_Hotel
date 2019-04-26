<?php
$this->title = '添加卡卷';
$this->params['breadcrumbs'][] = ['label' => '卡卷管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model, 'result' => $result]) ?>
