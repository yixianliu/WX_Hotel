<?php

/**
 * @abstract 产品模型
 * @author Yxl <zccem@163.com>
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Product1;

class ProductComment extends ActiveRecord
{

    /**
     * @abstract 数据库表名
     */
    public static function tableName()
    {
        return '{{%product_comment}}';
    }

    /**
     * 所有列表
     *
     * @param     $id
     * @param int $limit
     *
     * @return array|Product[]|ProductClassify[]|ProductComment[]|ActiveRecord[]
     */
    public static function findByAll($id, $limit = 10)
    {

        return static::find()->select(User::tableName() . ".*, " . self::tableName() . ".*, ")
            ->joinWith('user')
            ->where([self::tableName() . '.product_id' => $id, self::tableName() . '.is_audit' => 'On'])
            ->orderBy(self::tableName() . '.comment_id')
            ->limit($limit)
            ->asArray()
            ->all();
    }

    /**
     * 查找对应评论
     *
     * @param $cid
     * @param $pid
     *
     * @return array|Product[]|ProductClassify[]|ProductComment[]|ActiveRecord[]
     */
    public static function findWhereComment($cid, $pid)
    {

        return static::find()->select(User::tableName() . ".*, " . self::tableName() . ".*, ")
            ->joinWith('user')
            ->where([self::tableName() . '.ref_comment_id' => $cid, self::tableName() . '.product_id' => $pid, self::tableName() . '.is_audit' => 'On'])
            ->orderBy(self::tableName() . '.comment_id')
            ->asArray()
            ->all();
    }

    /**
     * @abstract 获取用户的所有产品
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

}
