<?php

/**
 * @abstract 安装控制器
 * @author   Yxl <zccem@163.com>
 */

namespace backend\controllers\mount;

use Yii;
use yii\helpers\Json;
use backend\models\MountForm;
use backend\models\MountFileForm;

class RunController extends BaseController
{

    /**
     * @abstract 挂载页面
     */
    public function actionIndex()
    {
        return $this->render( '../run');
    }

    /**
     * @abstract 安装开启
     */
    public function actionInstall()
    {

        if (!Yii::$app->request->isAjax) {
            Yii::$app->getSession()->setFlash('error', '登录失败,请检查 !!');
            return $this->redirect( ['/mount/center/view'] );
        }

        // 批量SQL语句
        $Sql_Data = file_get_contents( Yii::getAlias( '@backend' ) . '/web/sql/base.sql' ) .
            file_get_contents( Yii::getAlias( '@backend' ) . '/web/sql/hotel.sql' ) .
            file_get_contents( Yii::getAlias( '@backend' ) . '/web/sql/power.sql' ) .
            file_get_contents( Yii::getAlias( '@backend' ) . '/web/sql/data.sql' );

        $Sql_Data = str_ireplace( '#DB_PREFIX#', Yii::$app->components['db']['tablePrefix'], $Sql_Data );

        $Sql_Data = str_ireplace( '#NAME#', Yii::$app->params['WebInfo']['NAME'], $Sql_Data );
        $Sql_Data = str_ireplace( '#TITLE#', Yii::$app->params['WebInfo']['TITLE'], $Sql_Data );
        $Sql_Data = str_ireplace( '#DESCRIPTION#', Yii::$app->params['WebInfo']['DESCRIPTION'], $Sql_Data );
        $Sql_Data = str_ireplace( '#KEYWORDS#', Yii::$app->params['WebInfo']['KEYWORDS'], $Sql_Data );
        $Sql_Data = str_ireplace( '#DEVELOPERS#', Yii::$app->params['WebInfo']['DEVELOPERS'], $Sql_Data );
        $Sql_Data = str_ireplace( '#EMAIL#', Yii::$app->params['WebInfo']['EMAIL'], $Sql_Data );
        $Sql_Data = str_ireplace( '#SITE_URL#', Yii::$app->params['WebInfo']['SITE_URL'], $Sql_Data );
        $Sql_Data = str_ireplace( '#ICP#', Yii::$app->params['WebInfo']['ICP'], $Sql_Data );
        $Sql_Data = str_ireplace( '#PHONE#', Yii::$app->params['WebInfo']['PHONE'], $Sql_Data );
        $Sql_Data = str_ireplace( '#COPYRIGHT#', Yii::$app->params['WebInfo']['COPYRIGHT'], $Sql_Data );

        $Sql_Data = str_ireplace( '#USERNAME#', Yii::getAlias( '@Username' ), $Sql_Data );
        $Sql_Data = str_ireplace( '#PASSWORD#', Yii::getAlias( '@Password' ), $Sql_Data );
        $Sql_Data = str_ireplace( '#TIME#', time(), $Sql_Data );

        $arraySql = explode( ';', $Sql_Data );

        // 执行 SQL
        foreach ($arraySql as $value) {

            if (!isset( $value ) || empty( $value ))
                continue;

            // 执行 Sql
            Yii::$app->db->createCommand( $value )->execute();
        }

        return Json::encode( [ 'msg' => '数据库生成完毕 !!', 'status' => true ] );
    }

    /**
     * 验证文件
     *
     * @return string
     */
    public function actionVerify()
    {

        if (Yii::$app->request->isAjax) {

            // 生成安装文件
            file_put_contents( Yii::getAlias( '@common' ) . '/' . Yii::$app->params['WebInfo']['RD_FILE'], date( 'Y年m月d日 H时i分s秒' ) . "\r\n" . Yii::$app->params['WebInfo']['NAME'] . "\r\n" . Yii::$app->params['WebInfo']['TITLE'] . "\r\n" . Yii::$app->params['WebInfo']['DESCRIPTION'] );

            $session = Yii::$app->session;

            $session->close();
            $session->destroy();

            return Json::encode( [ 'msg' => '挂载成功 !!', 'status' => true ] );
        }

        $model = new MountForm();

        return $this->render( '../verify', [ 'model' => $model ] );
    }

    /**
     * 环境检测
     *
     * @return string
     */
    public function actionEnv()
    {

        // 初始化
        $data = [];

        // 函数
        $fun = [ 'session_start', 'mysqli_connect', 'file_get_contents', 'file_put_contents', 'gd_info' ];

        $num = count( $fun );

        for ($i = 0; $i < $num; $i++) {
            if (!function_exists( $fun[ $i ] )) {
                return Json::encode( '程序不支持该函数 : ' . $fun[ $i ] );
            }
        }

        // 目录
        $path = [];

        foreach ($path as $key => $value) {

        }

        return $this->render( '../env', [ 'data' => $data ] );
    }

    /**
     * 编辑数据库文件
     *
     * @return string
     */
    public function actionEditFile()
    {

        $model = new MountFileForm();

        $request = Yii::$app->request;

        if ($request->isAjax) {
            return Json::encode( [ 'msg' => '非法提交!' ] );
        }

        return $this->render( '../dbfile', [ 'model' => $model ] );
    }
}
