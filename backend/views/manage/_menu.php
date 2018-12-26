<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/31
 * Time: 21:12
 */

$styleClass = [
    'liClass'     => 'xn-openable',
    'ulClass'     => '',
    'aClass'      => '',
    'activeClass' => 'active',
];

$html = \common\models\Menu::getParentMenu( 'AdminManage', 'On', $styleClass );

?>


<ul class="x-navigation" title='<?= $Conf['name'] ?>'>

    <li class="xn-logo">
        <a href="#" title="<?= $Conf['title']; ?> - <?= $Conf['name']; ?>"></a>
        <a href="#" class="x-navigation-control"></a>
    </li>

    <?= $html; ?>

</ul>
