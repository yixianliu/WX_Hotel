<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '模板管理';

$html = recursionDir($result['default']);

// 递归
function recursionDir($data, $dir = null)
{

    if (empty($data) || !is_array($data))
        return;

    $html = null;

    foreach ($data as $key => $value) {

        $html .= '<li style="padding: 5px;">';

        if (!is_numeric($key)) {
            $dir = $key;
            $html .= '    <div class="uk-nestable-item">&nbsp;&nbsp;▸&nbsp;<font color="red">' . tplName($key, 'paths') . '</font> [目录 / <font color="#00008b">' . $key . '</font> ]</div>';
        } else {
            $html .= '    <div class="uk-nestable-item">&nbsp;&nbsp;▸&nbsp;<font color="red">' . tplName($value, 'files') . '</font> [模板文件 / <font color="#00008b">' . $value . '</font> / ';
            $html .= '      <a href="' . Url::to(['edit', 'id' => $value, 'path' => $dir]) . '">编辑</a> / ';
            $html .= '    ]</div>';
        }

        if (!empty($value)) {
            $html .= '<ul class="">';
            $html .= recursionDir($value, $dir);
            $html .= '</ul>';
        }

        $html .= '</li>';
    }

    return $html;
}

// 模板名字
function tplName($name, $type)
{

    if (empty($name) || empty($type))
        return;

    $array = ['paths' => 'path', 'files' => 'file'];

    $xml = simplexml_load_file(Yii::getAlias('@webroot') . '/tpl.xml');

    foreach ($xml->$type as $value) {

        if ($value->$array[ $type ] == $name) {
            return $value->name;
        }

    }

    return '未知目录或者文件,切勿修改 !!';
}

?>

<?php $this->registerCssFile('@web/themes/assets/plugins/uikit/css/uikit.min.css'); ?>
<?php $this->registerCssFile('@web/themes/assets/plugins/uikit/css/components/nestable.min.css'); ?>

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left"><?= Html::encode($this->title) ?></h2>
        </header>
        <div class="content-body">

            <?= Yii::$app->view->renderFile('@app/views/formMsg.php'); ?>

            <div class="row" style="word-break : break-all;">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <ul class="uk-nestable">
                        <?= $html ?>
                    </ul>

                </div>
            </div>

        </div>
    </section>
</div>