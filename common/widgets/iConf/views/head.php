<?php
/**
 *
 * 头部模板
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/1/24
 * Time: 17:24
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<title><?= Html::encode($this->title) ?> - <?= $result['name'] ?> - <?= $result['title'] ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

<meta name='keywords' content='<?= $result['keywords'] ?>'/>
<meta name='description' content='<?= $result['description'] ?>'/>
<meta name='author' content='<?= $result['developers'] ?>'/>

<link rel='shortcut icon' type='image/x-icon' href='./favicon.ico'/>

<?= Html::csrfMetaTags() ?>
