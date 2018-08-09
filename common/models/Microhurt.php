<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_Microhurt".
 *
 * @property int    $id
 * @property string $m_id            商户编号,唯一识别码
 * @property string $user_id         用户ID
 * @property string $fullname        企业负责人(类似于CEO)
 * @property string $c_key           商户分类(企业是什么类型?)关键KEY
 * @property string $l_key           等级关键KEY
 * @property string $weixin          微信号
 * @property string $praise          好评
 * @property string $bad             差评
 * @property string $name            企业名称
 * @property string $keywords        企业关键字
 * @property string $description     企业介绍
 * @property string $whyus           企业简介 / 为什么选择我们.
 * @property string $purpose         企业简介 / 我们的宗旨.
 * @property string $getwhat         企业简介 / 你得到什么.
 * @property string $email           邮箱
 * @property string $address         公司地址
 * @property string $telphone        手机号码
 * @property string $fax             传真
 * @property string $idcard          身份证
 * @property string $is_promote      推广
 * @property string $is_approve      商户是否通过认证,审核判断该商户提交的文字性内容.
 * @property string $is_approve_id   是否已验证身份证(图片) / Rest(重新提交,等待验证.)
 * @property string $is_approve_mic  是否已验证商户(图片),包括营业执照,组织机构代码,税务登记证
 * @property string $is_thumb        是否生成缩略图
 * @property string $is_display      是否显示商户的相关照片
 * @property string $is_using        是否启用
 * @property string $grade           本站评分1-15, 工作人员审核评分
 * @property string $seller_grade    卖方评分1-15, 工作人员审核评分
 * @property string $user_grade      用户评分1-15, 本站用户进行评分
 * @property string $colligate_grade 综合评分1-15, 工作人员审核评分
 * @property string $published       发布时间
 * @property string $is_auth
 */
class Microhurt extends \yii\db\ActiveRecord
{

    private $_user;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%microhurt}}';
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
     * 验证规则
     *
     * @inheritdoc
     */
    public function rules()
    {

        return [

            // 更新和激活必填
            [['address', 'name', 'weixin', 'telphone', 'email', 'idcard', 'fullname', 'c_key'], 'required', 'on' => ['activate', 'update']],

            // 后台收纳盒必填
            [['is_promote', 'is_approve', 'is_approve_id', 'is_approve_mic',], 'required', 'on' => ['audit']],

            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['name', 'unique', 'targetClass' => '\common\models\Microhurt', 'message' => '商家店铺名称已经被使用!'],

            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['weixin', 'unique', 'targetClass' => '\common\models\Microhurt', 'message' => '商家店铺名称已经被使用!'],

            // 必填
            [['telphone'], 'required', 'message' => '手机号码必须填写!'],
            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['telphone', 'unique', 'targetClass' => '\common\models\Microhurt', 'message' => '手机号码已经被使用!'],

            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段nickname必须唯一
            ['fullname', 'unique', 'targetClass' => '\common\models\Microhurt', 'message' => '名称已存在!'],

            // 身份证唯一
            ['idcard', 'unique', 'targetClass' => '\common\models\Microhurt', 'message' => '身份证已存在!'],

            // email 特性必须是一个有效的 email 地址
            ['email', 'email'],


            [['is_using', 'is_display'], 'default', 'value' => 'On'],
            [['is_promote', 'is_display'], 'default', 'value' => 'On'],
            [['grade'], 'default', 'value' => 1],
        ];
    }

    /**
     * 标签
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'm_id'            => '店铺编号',
            'fullname'        => '法人名称',
            'c_key'           => '微商分类',
            'l_key'           => '微商等级',
            'weixin'          => '微信号',
            'name'            => '店铺名称',
            'keywords'        => '店铺关键字',
            'description'     => '店铺描述',
            'whyus'           => '为什么选择我们',
            'purpose'         => '我们的宗旨',
            'getwhat'         => '你得到什么',
            'email'           => '微商邮箱',
            'address'         => '店铺地址',
            'telphone'        => '店铺电话',
            'fax'             => '店铺传真',
            'idcard'          => '法人身份证',
            'is_auth'         => 'Is Auth',
            'is_promote'      => 'Is Promote',
            'is_approve'      => 'Is Approve',
            'is_approve_id'   => 'Is Approve ID',
            'is_approve_mic'  => 'Is Approve Mic',
            'is_thumb'        => 'Is Thumb',
            'is_display'      => '是否显示企业信息',
            'is_using'        => '是否启用',
            'grade'           => '本站评分',
            'seller_grade'    => '卖方评分',
            'user_grade'      => '用户评分',
            'colligate_grade' => '综合评分',
            'published'       => '申请地址',
        ];
    }

    /**
     * 场景
     *
     * @return array
     */
    public function scenarios()
    {
        return [
            'activate' => ['address', 'name', 'weixin', 'telphone', 'email', 'idcard', 'fullname', 'c_key'],
            'audit'    => ['is_promote', 'is_approve', 'is_approve_id', 'is_approve_mic', 'is_thumb', 'is_display', 'is_using', 'grade'],
            'update'   => ['address', 'name', 'weixin', 'telphone', 'email', 'idcard', 'fullname', 'c_key', 'whyus', 'purpose', 'getwhat'],
        ];
    }

    /**
     * 商户列表
     *
     * @param null   $status
     * @param int    $limit
     * @param string $page
     *
     * @return array|Microhurt[]|MicrohurtClassify[]|Product[]|\yii\db\ActiveQuery|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = null, $limit = 10, $page = 'off')
    {

        // 审核状态
        $array = !empty($status) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        if ($page == 'on') {

            return static::find()->select(User::tableName() . ".*, " . MicrohurtClassify::tableName() . ".name as cname, " . self::tableName() . ".*, " . MicrohurtLevel::tableName() . '.name as lname')
                ->joinWith('level')
                ->joinWith('classify')
                ->joinWith('user')
                ->where($array)
                ->orderBy(self::tableName() . '.m_id DESC')
                ->limit($limit);

        }

        return static::find()->select(User::tableName() . ".*, " . MicrohurtClassify::tableName() . ".name as cname, " . self::tableName() . ".*, " . MicrohurtLevel::tableName() . '.name as lname')
            ->joinWith('level')
            ->joinWith('classify')
            ->joinWith('user')
            ->where($array)
            ->orderBy(self::tableName() . '.m_id DESC')
            ->asArray()
            ->limit($limit)
            ->all();
    }

    /**
     * 条件查询微商
     *
     * @param      $id
     * @param null $status
     *
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    public static function findByData($id, $status = null)
    {

        if (empty($id)) {
            return false;
        }

        // 状态
        $array = !empty($status) ? [self::tableName() . '.is_using' => $status] : ['!=', self::tableName() . '.is_using', 'null'];

        return static::find()->select(User::tableName() . ".*, " . self::tableName() . ".*, " . MicrohurtLevel::tableName() . '.name as lname')
            ->joinWith('user')
            ->joinWith('level')
            ->where($array)
            ->andwhere([self::tableName() . '.m_id' => $id])
            ->orderBy(self::tableName() . '.m_id')
            ->one();
    }

    /**
     * 激活微商
     *
     * @param $user_id
     *
     * @return bool|Microhurt
     */
    public function activation($user_id)
    {

        if (empty($user_id))
            return false;

        $this->user_id = $user_id;
        $this->m_id = time() . '_' . $user_id;

        // 默认状态
        $this->l_key = 'L6';
        $this->is_promote = 'Off';
        $this->is_approve = 'Off';
        $this->is_approve_id = 'Not';
        $this->is_approve_mic = 'Not';
        $this->is_using = 'Off';
        $this->is_display = 'Off';

        // save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，因为我们上面已经调用Signup的rules校验过了，这里就没必要在用UserBackend的rules校验了
        return !$this->save(false) ? false : true;
    }

    /**
     * 更新商户资料
     *
     * @param $id
     *
     * @return bool
     */
    public function updateData($id)
    {

        if (empty($id)) {
            return false;
        }

        $Cls = static::findOne(['m_id' => $id]);

        $Cls->telphone = $this->telphone;
        $Cls->address = $this->address;
        $Cls->fullname = $this->fullname;
        $Cls->c_key = $this->c_key;
        $Cls->name = $this->name;
        $Cls->weixin = $this->weixin;
        $Cls->idcard = $this->idcard;
        $Cls->email = $this->email;
        $Cls->l_key = $this->l_key;
        $Cls->whyus = $this->whyus;
        $Cls->getwhat = $this->getwhat;
        $Cls->purpose = $this->purpose;
        $Cls->is_promote = $this->is_promote;
        $Cls->is_approve = $this->is_approve;
        $Cls->is_approve_id = $this->is_approve_id;
        $Cls->is_approve_mic = $this->is_approve_mic;
        $Cls->is_using = $this->is_using;
        $Cls->is_display = $this->is_display;

        // save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，因为我们上面已经调用Signup的rules校验过了，这里就没必要在用UserBackend的rules校验了
        return !$Cls->update(false) ? false : true;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function findUser()
    {

        if ($this->_user == null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * @abstract 获取微商等级
     */
    public function getLevel()
    {
        return $this->hasOne(MicrohurtLevel::className(), ['l_key' => 'l_key']);
    }

    /**
     * @abstract 获取微商分类
     */
    public function getClassify()
    {
        return $this->hasOne(MicrohurtClassify::className(), ['c_key' => 'c_key']);
    }

    /**
     * @abstract 获取用户
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
