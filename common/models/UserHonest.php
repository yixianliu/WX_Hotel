<?php
/**
 *
 * 用户诚信模型
 *
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2017/10/31
 * Time: 14:54
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class UserHonest extends ActiveRecord
{

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%user_honest}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * 所有角色
     *
     * @param null $status
     *
     * @return array|ActiveRecord[]
     */
    public static function findByAll($status = null)
    {

        return static::find()->where((!empty($status) ? ['is_using' => $status] : ['!=', 'is_using', 'null']))
            ->orderBy(['sort_id' => SORT_DESC])
            ->asArray()
            ->all();
    }

}