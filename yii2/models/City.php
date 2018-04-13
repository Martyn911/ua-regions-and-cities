<?php

namespace common\models;

use Yii;
use common\models\Region;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $region_id
 * @property string $name_ru
 * @property string $name_uk
 * @property string $name_long_ru
 * @property string $name_long_uk
 * @property string $url
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Region $region
 */
class City extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name_ru', 'name_uk'], 'required'],
            [['region_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name_ru', 'name_uk'], 'string', 'max' => 100],
            [['name_long_ru', 'name_long_uk'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 50],
            [['url'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'name_ru' => 'Name Ru',
            'name_uk' => 'Name Uk',
            'name_long_ru' => 'Name Long Ru',
            'name_long_uk' => 'Name Long Uk',
            'url' => 'Url',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}
