<?php
/**
 *
 * 编辑数据库文件模板
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/8/3
 * Time: 9:56
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\widgets\iMessage\FormMsg;

$this->title = '编辑数据库';

?>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-9 col-xs-10">

                    <?php $form = ActiveForm::begin(['action' => ['mount/run/dbfile'], 'class' => 'form-horizontal', 'method' => 'post', 'id' => $model->formName()]); ?>

                    <div class="form-group">
                        <div class="controls">

                            <?=
                            $form->field($model, 'filename')->textInput(['maxlength' => 30, 'class' => 'form-control', 'autofocus' => true])
                                ->label('文件名');
                            ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">

                            <?=
                            $form->field($model, 'content')->textarea(['class' => 'form-control', 'style' => 'height: 600px;resize: none;'])
                                ->label('数据内容');
                            ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 10px;">
                            挂载操作 (基础配置)
                        </button>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>

        <?=
        FormMsg::widget(['config' => [
            'tpl'      => 'mountform',
            'FormName' => $model->formName(),
            'Url'      => Url::to(['manager/center/view']),
        ]]);
        ?>

    </div>
</div>