<?php

/**
 * @abstract 产品模型
 * @author Yxl <zccem@163.com>
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

class UserMsg extends ActiveRecord
{

    public $username;
    public $coverimg;

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%user_msg}}';
    }

    /**
     * @abstract 查找所属用户产品
     * @param int $id 用户id
     * @param string $status 产品状态
     */
    public static function findByUserMsg($id)
    {

        if (empty($id)) {
            return FALSE;
        }

        return static::find()->where(['user_id' => $id])
            ->orderBy('msg_id')
            ->asArray();
    }

    /**
     * @abstract 获取用户的所有产品
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

}
