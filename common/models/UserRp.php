<?php
/**
 *
 * 关联角色权限模型
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/8/11
 * Time: 9:42
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class UserRp extends ActiveRecord
{

    /**
     * 数据库表名
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%user_related_rp}}';
    }

    /**
     * 角色相关的权限
     *
     * @param null $id
     * @return array|ActiveRecord[]
     */
    public static function findByAllPower($id = null)
    {

        if (empty($id))
            return static::find()->all();

        return static::find()->where(['r_key' => $id])->all();
    }

}