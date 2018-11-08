<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RelevanceRoomsCoupon */

$this->title = 'Update Relevance Rooms Coupon: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '派送设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

        <div class="sr-item">
            <a href="#" class="sr-item-title"><?= $result['coupon']->title ?></a>
            <div class="sr-item-link">http://aqvatarius.com/themes/atlant/</div>
            <p>Atlant – is a powerful admin template based on Bootstrap 3.2. Template is fully responsive and retina ready. In downloaded package you will find .less files, documentation, clean and commented source code. Atlant is easy to use and customize, also you will find lots of ready to use elements.</p>
            <p class="sr-item-links"><a href="#">Translate this page</a> - <a href="#">View cache</a> - <a href="#">Remove from search</a></p>
        </div>

        <?= $this->render( '_form', [
            'model'  => $model,
            'result' => $result,
        ] ) ?>

    </div>

<?php ActiveForm::end(); ?>