<?php
/**
 *
 * 表单返回信息
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/25
 * Time: 18:12
 */

use yii\bootstrap\Alert;

if (Yii::$app->getSession()->hasFlash('success')) {

    echo Alert::widget([
        'options' => [
            'class' => 'alert-success', //这里是提示框的class
        ],
        'body'    => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);

}

if (Yii::$app->getSession()->hasFlash('error')) {

    if (is_array(Yii::$app->getSession()->getFlash('error'))) {

        $data = '<ul>';
        foreach (Yii::$app->getSession()->getFlash('error') as $key => $value) {
            $data .= '<li>' . $value[0] . '</li>';
        }
        $data .= '</ul>';
    } else {
        $data = Yii::$app->getSession()->getFlash('error');
    }

    echo Alert::widget([
        'options' => [
            'class' => 'alert alert-error alert-dismissible fade in',
        ],
        'body'    => $data,
    ]);
}

?>