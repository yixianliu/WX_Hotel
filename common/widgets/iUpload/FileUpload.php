<?php

/**
 * @abstract 上传组件
 * @author Yxl <zccem@163.com>
 */

namespace common\widgets\iUpload;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\widgets\iUpload\assets\FileUploadAsset;
use common\widgets\iUpload\assets\FileUploadHeadAsset;

class FileUpload extends InputWidget
{

    public $config = [];
    public $value = '';

    public function init()
    {

        // 默认设置
        $_config = require(__DIR__ . '/config.php');

        $this->config = ArrayHelper::merge($_config, $this->config);
    }

    public function run()
    {

        // 模板选择
        $tpl = empty($this->config['tpl']) ? 'index' : $this->config['tpl'];

        $this->registerClientScript($tpl);

        $result = (!empty($this->config['result']) && !is_array($this->config['result'])) ? $this->config['result'] : array();

        // 不存在模型
        if ($this->hasModel()) {
            return $this->render($tpl, [
                'config'     => $this->config,
                'inputName'  => 'file-upload',
                'inputValue' => $this->value
            ]);
        }

        $inputName = Html::getInputName($this->model, $this->attribute);

        if (!empty($this->config['value'])) {
            $inputValue = $this->config['value'];
        } else {
            $inputValue = Html::getAttributeValue($this->model, $this->attribute);
        }

        return $this->render($tpl, [
            'config'     => $this->config,
            'inputName'  => $inputName,
            'inputValue' => $inputValue,
            'attribute'  => $this->attribute,
            'result'     => $result,
        ]);
    }

    /**
     * 载入央视文件
     *
     * @param $tpl
     */
    public function registerClientScript($tpl)
    {

        if (!empty($tpl) && $tpl == 'head') {

            FileUploadHeadAsset::register($this->view);

            return;
        }

        FileUploadAsset::register($this->view);

    }

}
