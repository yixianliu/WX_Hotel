<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/9/3
 * Time: 16:18
 */

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use common\handel\MicHandel;
use common\models\WeChatConf;
use EasyWeChat\Payment\Order;

/**
 * Site controller
 */
class CenterController extends Controller
{

    public function actionIndex()
    {

        // 微信网页授权:
        if (Yii::$app->wechat->isWechat && !Yii::$app->wechat->isAuthorized()) {
            return Yii::$app->wechat->authorizeRequired()->send();
        }

        MicHandel::MicConnData(WeChatConf::findOne(1)->toArray());

        Yii::$app->params['WECHAT'] = MicHandel::$connArray;

        $order = new Order(['out_trade_no' => 20150806125346]);

        $payment = Yii::$app->wechat->payment;

        $prepayRequest = $payment->prepare($order);

        if($prepayRequest->return_code = 'SUCCESS' && $prepayRequest->result_code == 'SUCCESS') {
            $prepayId = $prepayRequest->prepay_id;
        }else{
            throw new yii\base\ErrorException('微信支付异常, 请稍后再试');
        }

        $jsApiConfig = $payment->configForPayment($prepayId);

        return $this->render('index');
    }
}