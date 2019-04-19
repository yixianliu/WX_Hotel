<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/4/19
 * Time: 10:06
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '上传素材';

?>

<?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

        <div class="panel panel-default">

            <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3></div>

            <div class="panel-body">

                <?=
                Yii::$app->view->renderFile( '@app/views/_Upload.php', [
                        'model'     => $model,
                        'id'        => $model->images,
                        'type'      => 'material',
                        'attribute' => 'images',
                        'text'      => '上传素材',
                        'form'      => $form]
                );
                ?>

            </div>

            <div class="panel-footer">

                <?= Html::submitButton( '上传素材', ['class' => 'btn btn-primary btn-lg'] ) ?>

                <a href='<?= Url::to( ['index'] ) ?>' class='btn btn-primary btn-lg' title='返回列表'>返回列表</a>

            </div>

        </div>
    </div>

<?php ActiveForm::end(); ?>