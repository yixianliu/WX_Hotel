<?php

/**
 * @abstract 产品列表模板
 * @author   Yxl <zccem@163.com>
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '所有分类';

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

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>

        <div class="panel-body">
            <div class="row">

                <div class="form-group">
                    <a href='<?= Url::to(['product-cls/create']) ?>' class='btn btn-default' title='添加分类'>添加分类</a>
                    <a href='<?= Url::to(['product/create']) ?>' class='btn btn-default' title='添加产品'>添加产品</a>
                </div>

                <?php if (!empty($result['result'])): ?>

                    <ul class="list-group border-bottom">
                        <?php foreach ($result['result'] as $key => $value): ?>

                            <li class="list-group-item">

                                <span scope="row"><?= $key + 1; ?>&nbsp;&nbsp;-&nbsp;&nbsp;</span>
                                <span><a href="<?= Url::to(['product-cls/edit', 'id' => $value['c_key']]); ?>" title="<?= $value['name']; ?>"><?= $value['name']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span>
                                    [<?php if ($value['is_using'] == 'On'): ?>已开启<?php else: ?>已关闭<?php endif; ?>]&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                <span>

                                    [
                                    <a href="<?= Url::to(['product-cls/edit', 'id' => $value['c_key']]); ?>" title="编辑 - <?= $value['name']; ?>">编辑</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                    <a href="<?= Url::to(['product-cls/audit', 'id' => $value['c_key']]); ?>" title="停用分类">停用</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                                    <a href="<?= Url::to(['product-cls/create', 'id' => $value['c_key']]); ?>" title="创建分类">添加子类</a>
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
</div>