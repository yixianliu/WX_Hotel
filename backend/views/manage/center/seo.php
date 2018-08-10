<?php
/**
 *
 * 网站SEO设置
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/1/12
 * Time: 10:40
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '网站 SEO 配置';
$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];

?>


<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">
            <div class="row" style="word-break : break-all;">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($result as $key => $value): ?>
                            <tr>
                                <td><?= $value ?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                    <hr/>
                    <h3>Seo 配置</h3>

                    <?php $form = ActiveForm::begin(['action' => ['admin/center/seo'], 'method' => 'post']); ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">

                        <?= Html::submitButton('保存内容', ['class' => 'btn btn-primary']) ?>

                        <?= Html::a('返回列表', ['/admin/center/seo'], ['class' => 'btn btn-primary']) ?>

                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </section>
</div>

