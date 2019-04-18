<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/6/9
 * Time: 17:10
 */

namespace common\handel;

use Yii;

class UserHandel extends \yii\base\Model
{

    public function getUserInfo($access_token, $openid)
    {

        $request_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';

        // 初始化一个curl会话
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = $this->response($result);

        return $result;
    }

    /**
     * 微信获取用户资料
     *
     * @return mixed
     */
    public static function UserInfo($open_id, $user)
    {

        if (isset($open_id)) {

            // 模型
            // $user = WechatUser::find()->where(['openid' => $open_id])->one();

            if ($user) {
                $result['error'] = 0;
                $result['msg'] = '获取成功';
                $result['user'] = $user;
            } else {
                $result['error'] = 1;
                $result['msg'] = '没有该用户';
            }

        } else {
            $result['error'] = 1;
            $result['msg'] = 'openid为空';
        }

        return $result;
    }

}