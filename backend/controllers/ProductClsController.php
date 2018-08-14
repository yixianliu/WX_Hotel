<?php

/**
 * @abstract 分类控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use common\models\ProductClassify;

class ProductClsController extends BaseController
{

    /**
     * @abstract 列表
     */
    public function actionIndex()
    {

        // 初始化
        $result = [];

        $data = ProductClassify::findByAll();

        foreach ($data as $key => $value) {
            $result['result'][] = ProductClassify::recursionData($value['c_key']);
        }

        return $this->render('index', ['result' => $result]);
    }

    /**
     * 编辑
     *
     * @param $id
     *
     * @return string
     */
    public function actionEdit($id)
    {

        $request = Yii::$app->request;

        $model = ProductClassify::findWhereClassify($id);

        // Ajax
        if ($request->isAjax) {

            if (!$model->load($request->post()) || !$model->save()) {
                return Json::encode($model->getErrors());
            }

            return Json::encode(['msg' => '添加成功!', 'status' => true]);
        }

        // 初始化
        $result = [];

        $result['classify'] = ProductClassify::getClsSelect();

        return $this->render('edit', ['model' => $model, 'result' => $result]);
    }

    /**
     * @abstract 创建
     */
    public function actionCreate()
    {

        $model = new ProductClassify();

        $model->c_key = self::getRandomString();

        $id =  Yii::$app->request->get('id', null);

        // Ajax
        if (Yii::$app->request->isAjax) {

            if (!$model->load(Yii::$app->request->post()) || !$model->save()) {
                return Json::encode($model->getErrors());
            }

            return Json::encode(['msg' => '添加分类成功!', 'status' => true]);
        }

        $result['classify'] = ProductClassify::getClsSelect();

        return $this->render('create', ['model' => $model, 'result' => $result]);
    }

}
