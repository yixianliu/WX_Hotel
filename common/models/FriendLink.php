<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_friend_link".
 *
 * @property int    $id
 * @property string $title     标题
 * @property string $content   介绍
 * @property string $author    联系人
 * @property string $img       图片地址
 * @property string $url       链接地址
 * @property string $is_status 友情链接状态
 * @property string $is_audit  审核
 * @property int    $created_at
 * @property int    $updated_at
 */
class FriendLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w_friend_link';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_status', 'is_audit'], 'string'],
            [['is_audit'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 85],
            [['content'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 55],
            [['img', 'url'], 'string', 'max' => 125],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'title'      => 'Title',
            'content'    => 'Content',
            'author'     => 'Author',
            'img'        => 'Img',
            'url'        => 'Url',
            'is_status'  => 'Is Status',
            'is_audit'   => 'Is Audit',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
