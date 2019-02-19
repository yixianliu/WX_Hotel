<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/2/19
 * Time: 16:21
 */

$this->title = '添加房间预约';
$this->params['breadcrumbs'][] = ['label' => '房间预约管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render( '_form', [
    'model'  => $model,
    'result' => $result,
] ) ?>

