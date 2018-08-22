<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "w_article".
 *
 * @property int    $id
 * @property string $article_id   文章关键KEY
 * @property string $user_id      用户ID
 * @property string $c_key        分类ID
 * @property string $title        标题
 * @property string $content      内容
 * @property string $introduction 导读
 * @property string $keywords     关键字
 * @property string $path         路径
 * @property string $praise       赞
 * @property string $forward      转发
 * @property string $collection   收藏
 * @property string $share        分享
 * @property string $attention    关注
 * @property string $is_promote   推广
 * @property string $is_hot       热门
 * @property string $is_classic   经典
 * @property string $is_winnow    精选
 * @property string $is_recommend 推荐
 * @property string $is_comments  评论
 * @property string $is_using     审核
 * @property int    $created_at
 * @property int    $updated_at
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_key', 'title', 'content',], 'required'],
            [['content', 'is_promote', 'is_hot', 'is_classic', 'is_winnow', 'is_recommend', 'is_comments', 'is_using'], 'string'],
            [['praise', 'forward', 'collection', 'share', 'attention', 'created_at', 'updated_at'], 'integer'],
            [['article_id'], 'string', 'max' => 85],
            [['user_id', 'c_key', 'path'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
            [['introduction', 'keywords'], 'string', 'max' => 255],
            [['article_id'], 'unique'],
            [['title'], 'unique'],

            [['is_comments', 'is_using'], 'default', 'value' => 'On'],
            [['is_promote', 'is_hot', 'is_classic', 'is_winnow', 'is_recommend'], 'default', 'value' => 'Off'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id'   => '文章 ID',
            'user_id'      => 'User ID',
            'c_key'        => 'C Key',
            'title'        => 'Title',
            'content'      => 'Content',
            'introduction' => 'Introduction',
            'keywords'     => 'Keywords',
            'path'         => 'Path',
            'praise'       => 'Praise',
            'forward'      => 'Forward',
            'collection'   => 'Collection',
            'share'        => 'Share',
            'attention'    => 'Attention',
            'is_promote'   => 'Is Promote',
            'is_hot'       => 'Is Hot',
            'is_classic'   => 'Is Classic',
            'is_winnow'    => 'Is Winnow',
            'is_recommend' => 'Is Recommend',
            'is_comments'  => 'Is Comments',
            'is_using'     => 'Is Using',
            'created_at'   => 'Created At',
            'updated_at'   => 'Updated At',
        ];
    }
}
