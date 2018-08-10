<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/11
 * Time: 17:13
 */


use yii\helpers\Url;

/**
 * 递归菜单
 *
 * @param $data
 *
 * @return null|string|void
 */
function recursionHtmlMenu($data)
{

    if (empty($data))
        return;

    $html = null;

    foreach ($data as $value) {

        if (empty($value['name']))
            continue;

        $html .= '<li class="xn-openable ' . (empty($value['active']) || $value['active'] != 'On' ? null : 'active') . '">';

        $html .= '    <a title="' . $value['name'] . '" href="' . Url::to([$value['url']]) . '">' . $value['name'] . '</a>';

        if (!empty($value['child'])) {
            $html .= '<ul>';
            $html .= recursionHtmlMenu($value['child']);
            $html .= '</ul>';
        }

        $html .= '</li>';
    }

    return $html;
}

?>

<?php if (!empty($result['menu'])): ?>

<ul class="x-navigation" title='<?= $result['conf']['name'] ?>'>

    <li class="xn-logo">
        <a href="#" title="<?= $result['conf']['title']; ?> - <?= $result['conf']['name']; ?>"></a>
        <a href="#" class="x-navigation-control"></a>
    </li>


    <?php foreach ($result['menu'] as $value): ?>

        <?php if (!empty($value['name'])): ?>

            <li class='xn-openable <?php if (!empty($value['open']) && $value['open'] == 'On'): ?>active<?php endif; ?>' title='<?= $value['name'] ?>'>

                <a title='<?= $value['name'] ?>' href='<?= Url::to(['/audit/' . $value['url_data']]) ?>'>

                    <?= $value['name'] ?>

                </a>

                <?php if (!empty($value['child']) && is_array($value['child'])): ?>
                    <ul>
                        <?= recursionHtmlMenu($value['child']) ?>
                    </ul>
                <?php endif; ?>

            </li>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif; ?>