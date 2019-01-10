<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_rooms_appointment".
 *
 * @property int    $id
 * @property string $hotel_id       酒店 Id
 * @property string $rooms_id       房间 Id
 * @property string $telphone       手机号码
 * @property string $name           预约姓名
 * @property string $start_time     预约开始时间
 * @property string $end_time       预约结束时间
 * @property string $advance_charge 是否预付房费
 * @property string $is_using       是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class RoomsAppointment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_rooms_appointment';
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
            [['hotel_id', 'rooms_id', 'advance_charge'], 'required'],
            [['advance_charge', 'is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['hotel_id', 'rooms_id'], 'string', 'max' => 55],
            [['telphone', 'name', 'start_time', 'end_time'], 'string', 'max' => 85],
            [['name'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hotel_id'       => '酒店 Id',
            'rooms_id'       => '房间 Id',
            'telphone'       => '手机号码',
            'name'           => '预约姓名',
            'start_time'     => '预约开始时间',
            'end_time'       => '预约结束时间',
            'advance_charge' => '是否预付房费',
            'is_using'       => '是否审核',
            'created_at'     => '添加数据时间',
            'updated_at'     => '更新数据时间',
        ];
    }
}
