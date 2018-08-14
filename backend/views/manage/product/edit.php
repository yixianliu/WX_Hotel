<?php

/**
 * @abstract 产品列表模板
 * @author   Yxl <zccem@163.com>
 */

$this->title = $result['data']['title'];

?>

<?= $this->render('_form', ['model' => $model, 'result' => $result]) ?>