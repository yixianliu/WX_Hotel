<?php
/**
 *
 * 上传头像
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/12
 * Time: 14:44
 */

namespace common\widgets\iUpload;

use Yii;
use yii\widgets\InputWidget;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\widgets\iUpload\assets\FileUploadHeadAsset;

class FileHeadUpload extends InputWidget
{

    public $config = [];

    /**
     * 构造
     */
    public function init()
    {

        parent::init();

        // close csrf
        Yii::$app->request->enableCsrfValidation = false;

        return;
    }

    /**
     * @abstract 运行
     */
    public function run()
    {

        FileUploadHeadAsset::register($this->view);

        return $this->render('head', [
            'FormId'  => $this->config['FormId'],
            'FormUrl' => $this->config['FormUrl'],
            'UserId'  => $this->config['UserId'],
        ]);
    }

}