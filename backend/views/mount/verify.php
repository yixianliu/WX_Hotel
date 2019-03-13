<?php

use yii\widgets\ActiveForm;

$this->title = '验证文件';

?>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title"><?= $this->title ?></h3>
            </div>

            <div class="panel-body">

                <h3><?= Yii::$app->params['WebInfo']['NAME'] ?> - <?= $this->title ?></h3>

                <p>全渠道新零售解决方案，以数据化运营为核心的一体化系统，将‘线上商城’与‘线下门店’销售运营完美融合。</p>

                <?php $form = ActiveForm::begin( ['action' => ['mount/run/verify'], 'class' => 'form-horizontal', 'method' => 'post'] ); ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        验证文件
                    </button>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>

        <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

    </div>
</div>
