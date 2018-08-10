<?php

/**
 * @abstract 针对本程序的菜单插件
 * @author Yxl <zccem@163.com>
 */

namespace common\widgets\iMessage;

use yii\widgets\InputWidget;
use common\models\UserMsg;

class MessageList extends InputWidget
{

    // 菜单ID
    public $config = array();

    public function init()
    {

    }

    public function run()
    {

        if (empty($this->config)) {
            return FALSE;
        }

        $result = UserMsg::findByUserMsg($this->config);

        return $this->render('index', ['result' => $result]);
    }

}
