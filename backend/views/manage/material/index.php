<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '素材管理';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to( ['create'] ) ?>' class='btn btn-primary btn-lg' title='添加招聘'>添加素材</a>
    </div>

    <?= Yii::$app->view->renderFile( '@app/views/_FormMsg.php' ); ?>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode( $this->title ) ?> / 总数量 : <?= $result['total_count'] ?></h3></div>

        <div class="panel-body">

            <table class="table table-hover" style="word-break:break-all; word-wrap:break-word;">

                <tr>
                    <td>素材 ID</td>
                    <td>素材名称</td>
                    <td>更新时间</td>
                    <td>素材图片</td>
                </tr>

                <?php foreach ($result['item'] as $value): ?>

                    <tr>
                        <td><?= $value['media_id'] ?></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['update_time'] ?></td>
                        <td><img src="http://img01.store.sogou.com/net/a/04/link?appid=<?= $confModel['appid'] ?>&url=<?= $value['url'] ?>" width="380" height="280"/></td>
                    </tr>

                <?php endforeach; ?>

            </table>

        </div>
    </div>

</div>
