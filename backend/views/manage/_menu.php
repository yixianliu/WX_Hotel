<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/31
 * Time: 21:12
 */

?>

<?php if (!empty( $result['menu'] )): ?>

    <ul class="x-navigation" title='<?= $result['conf']['name'] ?>'>

        <li class="xn-logo">
            <a href="#" title="<?= $result['conf']['title']; ?> - <?= $result['conf']['name']; ?>"></a>
            <a href="#" class="x-navigation-control"></a>
        </li>

        <?php foreach ($result['menu'] as $value): ?>

            <?php if (!empty( $value['name'] )): ?>

                <li class='xn-openable <?php if (!empty( $value['open'] ) && $value['open'] == 'On'): ?>active<?php endif; ?>' title='<?= $value['name'] ?>'>

                    <a title='<?= $value['name'] ?>' href='<?= Url::to( [ '/audit/' . $value['url_data'] ] ) ?>'>

                        <?= $value['name'] ?>

                    </a>

                    <?php if (!empty( $value['child'] ) && is_array( $value['child'] )): ?>
                        <ul>
                            <?= recursionHtmlMenu( $value['child'] ) ?>
                        </ul>
                    <?php endif; ?>

                </li>

            <?php endif; ?>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>