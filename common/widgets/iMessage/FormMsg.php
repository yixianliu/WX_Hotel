<?php

/**
 * @abstract 针对本程序的表单插件
 * @author Yxl <zccem@163.com>
 */

namespace common\widgets\iMessage;

use yii\widgets\InputWidget;
use common\widgets\iMenu\assets\MessageAsset;

class FormMsg extends InputWidget
{

    public $config = array();

    public function init()
    {

    }

    public function run()
    {

        if (empty($this->config) || empty($this->config['FormName'])) {
            return false;
        }

        $result['FormName'] = $this->config['FormName'];
        $result['Url'] = !empty($this->config['Url']) ? $this->config['Url'] : null;

        //模板
        $this->config['tpl'] = empty($this->config['tpl']) ? 'index' : $this->config['tpl'];

        return $this->render($this->config['tpl'], ['result' => $result]);
    }

    /**
     * 样式
     */
    public function registerClientScript()
    {
        MenuAsset::register($this->view);
        //$script = "FormFileUpload.init();";
        //$this->view->registerJs($script, View::POS_READY);

        return ;
    }
}
