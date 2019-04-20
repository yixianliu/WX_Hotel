<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_rooms".
 *
 * @property int    $id
 * @property string $hotel_id      酒店编号,唯一识别码
 * @property string $rooms_id      房间编号,唯一识别码
 * @property string $user_id       用户ID
 * @property string $c_key         房间分类KEY
 * @property string $room_num      房间号码
 * @property string $title         产品标题
 * @property string $content       产品内容
 * @property string $num           房间数量
 * @property string $check_in_num  入住房间数量
 * @property string $price         一口价
 * @property string $discount      折扣价
 * @property string $introduction  导读,获取房间介绍第一段.
 * @property string $keywords      关键字
 * @property string $path          房间文件路径
 * @property string $thumb         房间缩略图
 * @property string $images        房间图片
 * @property string $is_promote    推广
 * @property string $is_using      审核
 * @property string $is_comments   是否启用评论
 * @property int    $created_at
 * @property int    $updated_at
 */
class Rooms extends \yii\db\ActiveRecord
{

    public static $defaultRole = 'R15';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_rooms';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id', 'c_key', 'title', 'content'], 'required'],
            [['content', 'is_promote', 'is_using', 'is_comments'], 'string'],
            [['discount'], 'double'],
            [['num', 'check_in_num', 'price', 'created_at', 'updated_at'], 'integer'],
            [['hotel_id', 'rooms_id'], 'string', 'max' => 85],
            [['images', 'thumb'], 'string', 'max' => 3000],
            [['user_id', 'c_key', 'room_num'], 'string', 'max' => 55],
            [['title'], 'string', 'max' => 125],
            [['introduction', 'path'], 'string', 'max' => 255],
            [['keywords'], 'string', 'max' => 120],
            [['title'], 'unique'],

            [['is_promote', 'is_using', 'is_comments'], 'default', 'value' => 'On'],
            [['check_in_num'], 'default', 'value' => 0],
            [['room_num'], 'default', 'value' => rand( 00000, 99999 )],
            [['num'], 'default', 'value' => 10],
            [['price'], 'default', 'value' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'     => '所属酒店',
            'rooms_id'     => '房间 ID',
            'user_id'      => '用户 ID',
            'c_key'        => '房间分类',
            'room_num'     => '房间号码',
            'title'        => '房间标题',
            'content'      => '房间描述',
            'num'          => '房间数量',
            'check_in_num' => '入住数量',
            'price'        => '房间价格',
            'discount'     => '折扣价格',
            'introduction' => '房间导读',
            'keywords'     => '房间关键词',
            'path'         => '房间目录',
            'thumb'        => '房间缩略图',
            'images'       => '房间图片',
            'is_promote'   => '是否推广',
            'is_using'     => '是否审核',
            'is_comments'  => '是否开启留言',
            'created_at'   => '添加数据时间',
            'updated_at'   => '更新数据时间',
        ];
    }

    /**
     * 列表
     *
     * @param string $status
     *
     * @return array|Rooms[]|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = 'On')
    {

        // 审核状态
        $array = !empty( $status ) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', null];

        return static::find()->select( Hotels::tableName() . ".name, " . self::tableName() . ".*" )
            ->joinWith( 'hotels' )
            ->where( $array )
            ->orderBy( [self::tableName() . '.id' => SORT_DESC] )
            ->all();
    }

    /**
     * 查找某一个房间
     *
     * @param        $id
     * @param string $status
     *
     * @return array|Rooms[]|\yii\db\ActiveRecord[]
     */
    public static function findByOne($id, $status = 'On')
    {

        if (empty( $id )) {
            return false;
        }

        // 审核状态
        $array = !empty( $status ) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', null];

        return static::find()->select( Hotels::tableName() . ".name, " . self::tableName() . ".*" )
            ->joinWith( 'hotels' )
            ->where( $array )
            ->where( ['rooms_id' => $id] )
            ->one();
    }

    /**
     * 获取房间(选项框)
     *
     * @param string $is_using
     * @param null   $hotel_id
     *
     * @return array
     */
    public static function getSelect($is_using = 'On', $hotel_id = null)
    {

        // 初始化
        $result = [];

        // 产品分类
        if (empty( $hotel_id )) {

            $dataClassify = static::findByAll( $is_using );

        } else {

            $dataClassify = static::findAll( ['is_using' => $is_using, 'hotel_id' => $hotel_id] );

        }

        foreach ($dataClassify as $key => $value) {
            $result[ $value['rooms_id'] ] = $value['title'];
        }

        return $result;
    }

    /**
     * @abstract 获取酒店
     */
    public function getHotels()
    {
        return $this->hasOne( Hotels::className(), ['hotel_id' => 'hotel_id'] );
    }

    /**
     * 分类
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCls()
    {
        return $this->hasOne( RoomsClassify::className(), ['c_key' => 'c_key'] );
    }

    /**
     * 录入参数和标签数据
     *
     * @param        $model
     * @param        $post
     * @param string $delete
     *
     * @return bool
     */
    public static function CreateData($model, $post, $delete = 'Off')
    {

        if (empty( $model ) || empty( $post )) {
            return false;
        }

        // 房间参数
        if (!empty( $post['Rooms']['f_key'] ) && is_array( $post['Rooms']['f_key'] )) {

            if ($delete == 'On') {
                if (!RelevanceRoomsField::deleteAll( ['rooms_id' => $model->rooms_id] )) {
                    return false;
                }
            }

            foreach ($post['Rooms']['f_key'] as $key => $value) {

                if (empty( $value )) {
                    continue;
                }

                $modelField = new RelevanceRoomsField();

                $modelField->f_key = $key;
                $modelField->rooms_id = $model->rooms_id;
                $modelField->content = $value;

                if (!$modelField->save( false )) {
                    return false;
                }

            }
        }

        // 房间标签
        if (!empty( $post['Rooms']['t_key'] )) {

            if ($delete == 'On') {
                if (!RelevanceRoomsTag::deleteAll( ['rooms_id' => $model->rooms_id] )) {
                    return false;
                }
            }

            foreach ($post['Rooms']['t_key'] as $key => $value) {

                if (empty( $value )) {
                    continue;
                }

                $modelTag = new RelevanceRoomsTag();

                $modelTag->t_key = $key;
                $modelTag->rooms_id = $model->rooms_id;

                if (!$modelTag->save( false )) {
                    return false;
                }
            }

        }

        return true;
    }
}
