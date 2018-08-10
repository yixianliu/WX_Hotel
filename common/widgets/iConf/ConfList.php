<?php
/**
 *
 * 网站配置插件
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/1/24
 * Time: 17:26
 */

namespace common\widgets\iConf;

use yii\widgets\InputWidget;
use common\models\Conf;

class ConfList extends InputWidget {

    public $config = array();

    public function init()
    {
        return;
    }

    /**
     * 执行
     *
     * @return bool|string|void
     */
    public function run()
    {

        // 初始化
        $result = array();

        $result['title'] = empty($this->config[0]) ? '没有标题' : $this->config[0];

        $result = $confData = Conf::findByOne();

        $this->config[1] = empty($this->config[1]) ? 'head' : $this->config[1];

        return $this->render($this->config[1], ['result' => $result]);
    }

}