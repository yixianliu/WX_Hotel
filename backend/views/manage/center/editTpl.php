<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/6
 * Time: 10:06
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '编辑模板';

?>

<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<?= Html::cssFile('@web/themes/assets/plugins/bootstrap3-wysihtml5/css/bootstrap3-wysihtml5.min.css') ?>
<?= Html::cssFile('@web/themes/assets/plugins/uikit/css/uikit.min.css') ?>
<?= Html::cssFile('@web/themes/assets/plugins/uikit/vendor/codemirror/codemirror.css') ?>
<?= Html::cssFile('@web/themes/assets/plugins/uikit/css/components/htmleditor.css') ?>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row">

                <?php $form = ActiveForm::begin(['action' => ['admin/tpl/edit', 'id' => $model->fileName, 'path' => $model->path], 'method' => 'post']); ?>

                <?= $form->field($model, 'path')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

                <?= $form->field($model, 'fileName')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

                <?= $form->field($model, 'content')->textarea(['rows' => 32, 'data-uk-htmleditor' => "{mode:'tab', markdown:true}"]) ?>

                <div class="form-group">

                    <?= Html::submitButton('保存内容', ['class' => 'btn btn-primary']) ?>

                    <?= Html::a('返回列表', ['/admin/tpl/index'], ['class' => 'btn btn-primary']) ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

        <?= Yii::$app->view->renderFile('@app/views/formMsg.php'); ?>

    </section>
</div>

<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<?= Html::jsFile('@web/themes/assets/plugins/bootstrap3-wysihtml5/js/bootstrap3-wysihtml5.all.min.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/ckeditor/ckeditor.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/js/uikit.min.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/vendor/codemirror/codemirror.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/vendor/codemirror/mode/markdown/markdown.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/vendor/codemirror/addon/mode/overlay.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/vendor/codemirror/mode/xml/xml.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/vendor/codemirror/mode/gfm/gfm.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/vendor/marked/marked.min.js') ?>
<?= Html::jsFile('@web/themes/assets/plugins/uikit/js/components/htmleditor.js') ?>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->