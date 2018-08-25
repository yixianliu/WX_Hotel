<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '房间分类列表';
$this->params['breadcrumbs'][] = $this->title;


/**
 * 递归
 *
 * @param $data
 *
 * @return null|string|void
 */
function recursionData($data)
{
    if (empty($data) || !is_array($data)) {
        return;
    }

    // 初始化
    $html = null;

    $html .= '<ul class="list-group border-bottom" style="margin-top: 8px;">';

    // 循环
    foreach ($data as $key => $value) {

        $html .= '  <li class="list-group-item">';
        $html .= '      <span scope="row">' . ($key + 1) . '&nbsp;&nbsp;-&nbsp;&nbsp;</span>';
        $html .= '      <span>' . $value['name'] . '</span>';

        // Url
        $editUrl = Url::to(['product-cls/edit', 'id' => $value['c_key']]);
        $auditUrl = Url::to(['product-cls/audit', 'id' => $value['c_key']]);
        $createUrl = Url::to(['product-cls/create', 'id' => $value['c_key']]);

        $html .= <<<EOF
            <span>
                [
                <a href="{$editUrl}" title="编辑 - {$value['name']}">编辑</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                <a href="{$auditUrl}" title="停用">停用</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                <a href="{$createUrl}" title="添加子类">添加子类</a>
                ]
            </span>
EOF;

        if (!empty($value['child'])) {
            $html .= recursionData($value['child']);
        }

        $html .= '  </li>';

    }

    $html .= '</ul>';

    return $html;
}

?>

<div class="col-lg-12">

    <div class="form-group">
        <a href='<?= Url::to(['rooms/create']) ?>' class='btn btn-primary btn-lg' title='添加酒店房间'>添加酒店房间</a>
        <a href='<?= Url::to(['create']) ?>' class='btn btn-primary btn-lg' title='添加房间分类'>添加房间分类</a>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading"><h3 class="panel-title"><?= Html::encode($this->title) ?></h3></div>

        <div class="panel-body">

            <?php if (!empty($result)): ?>

                <ul class="list-group border-bottom">
                    <?php foreach ($result as $key => $value): ?>

                        <li class="list-group-item">

                            <span scope="row"><?= $key + 1; ?>&nbsp;&nbsp;-&nbsp;&nbsp;</span>
                            <span><a href="<?= Url::to(['rooms-cls/update', 'id' => $value['c_key']]); ?>" title="<?= $value['name']; ?>"><?= $value['name']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span>
                                    [<?php if ($value['is_using'] == 'On'): ?>已开启<?php else: ?>已关闭<?php endif; ?>]&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                            <span>

                                    [
                                    <a href="<?= Url::to(['rooms-cls/update', 'id' => $value['c_key']]); ?>" title="编辑 - <?= $value['name']; ?>">编辑</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                    <a href="<?= Url::to(['rooms-cls/delete', 'id' => $value['c_key']]); ?>" title="停用分类">删除</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                    <a href="<?= Url::to(['rooms-cls/create', 'id' => $value['c_key']]); ?>" title="创建分类">添加子类</a>
                                    ]

                                </span>

                            <?php if (!empty($value['child'])): ?>
                                <?= recursionData($value['child']); ?>
                            <?php endif; ?>

                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php else: ?>

                <p><h1>暂无内容!</h1></p>

            <?php endif; ?>

        </div>
    </div>
</div>

