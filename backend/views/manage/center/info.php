<?php
/**
 *
 * 网站配置信息
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/1/12
 * Time: 10:33
 */

use yii\helpers\Html;

$this->title = '网站档案';

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

                </div>
            </div>
        </div>
    </section>
</div>
