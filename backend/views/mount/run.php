<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\widgets\iMessage\FormMsg;

$this->title = '程序挂载操作';
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading"><h3 class="panel-title"><?= $this->title ?></h3></div>

            <div class="panel-body">

                <h3>微酒店 - 安装</h3>

                <p>全渠道新零售解决方案，以数据化运营为核心的一体化系统，将‘线上商城’与‘线下门店’销售运营完美融合。</p>

                <?php $form = ActiveForm::begin(['action' => ['mount/run/install'], 'class' => 'form-horizontal', 'method' => 'post', 'id' => $model->formName()]); ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 10px;">
                        挂载操作 (基础配置)
                    </button>
                </div>

                <?php ActiveForm::end(); ?>

                <br/>

            </div>

        </div>
    </div>

    <?= FormMsg::widget(['config' => ['tpl' => 'mountform', 'FormName' => $model->formName(), 'Url' => Url::to(['mount/run/verify']),]]); ?>

</div>
