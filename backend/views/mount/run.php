<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '程序挂载操作';
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading"><h3 class="panel-title"><?= $this->title ?></h3></div>

            <div class="panel-body">

                <h3>微酒店 - 安装</h3>

                <p>全渠道新零售解决方案，以数据化运营为核心的一体化系统，将‘线上商城’与‘线下门店’销售运营完美融合。</p>

                <?php $form = ActiveForm::begin( ['action' => ['mount/run/install'], 'class' => 'form-horizontal'] ); ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        挂载操作 (基础配置)
                    </button>
                </div>

                <?php ActiveForm::end(); ?>

                <br/>

            </div>

        </div>

    </div>
</div>

<?= Yii::$app->view->renderFile( '@app/views/_AjaxMsg.php', ['FormUrl' => Url::to( ['mount/run/verify'] )] ); ?>