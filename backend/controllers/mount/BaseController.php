<?php

/**
 * @abstract 安装控制器
 * @author Yxl <zccem@163.com>
 */

namespace backend\controllers\mount;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{

    public $layout = 'mount';

    /**
     * 构造函数
     */
    public function init()
    {

        // 跳转
        if (file_exists(Yii::getAlias('@common') . '/' . Yii::$app->params['WebInfo']['RD_FILE']))
            $this->redirect(['/center/view']);

        // 帐号密码
        Yii::setAlias('@Username', 'yixianliu');
        Yii::setAlias('@Password', Yii::$app->security->generatePasswordHash('yixianliu'));

        return;
    }

    /**
     * 是否登录
     *
     * @return bool
     */
    public function isLogin()
    {
        $session = Yii::$app->session;

        $data = $session->get('MountAdmin');

        if (empty($data['username']) || $data['username'] != Yii::getAlias('@Username')) {
            $this->redirect(['/mount/member/login']);
        }

        return true;
    }

}
