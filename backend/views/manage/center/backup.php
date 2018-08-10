<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/3/19
 * Time: 23:34
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '网站备份';
$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];

?>

<div class="col-lg-12">
    <section class="box ">

        <header class="panel_header"><h2 class="title pull-left"><?= Html::encode($this->title) ?></h2></header>

        <div class="content-body">

            <div class="row">

                <?php $form = ActiveForm::begin(['action' => ['admin/backup/backup-sql'], 'method' => 'post', 'id' => 'BackUpForm']); ?>

                <div class="form-group">
                    <?= Html::submitButton('备份数据库', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div id="AjaxMsg"></div>

            </div>

            <div class="row">
                <hr/>
            </div>

            <div class="row">

                <?php if (!empty($dataProvider)): ?>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>创建时间</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($dataProvider as $value): ?>
                            <tr>
                                <td></td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['create_time'] ?></td>
                                <td>
                                    <a href="<?= \yii\helpers\Url::to(['admin/backup/view', 'id' => $value['name']]) ?>">查看</a> /
                                    <a href="<?= \yii\helpers\Url::to(['admin/backup/delete', 'id' => $value['name']]) ?>">删除</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>


                <?php else: ?>
                    <h1>暂无备份 !!</h1>
                <?php endif; ?>

            </div>

        </div>
    </section>

    <script type="text/javascript">

        $(function () {

            var AjaxMsg = $('#AjaxMsg');

            jQuery('#BackUpForm').on('beforeSubmit', function (e) {

                var $form = $(this);

                $.ajax({
                    url: $form.attr('action'),
                    type: 'post',
                    data: $form.serialize(),
                    success: function (data) {
                        AjaxMsg.text(data.msg);
                        window.location.href = data.url;
                        return true;
                    },
                    error: function () {
                        AjaxMsg.text('操作失败了!!');
                        return false;
                    }
                });
            }).on('submit', function (e) {
                e.preventDefault();
            });

        });
    </script>

</div>
