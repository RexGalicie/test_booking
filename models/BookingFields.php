<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%booking_fields}}".
 *
 * @property integer $id
 * @property integer $booking_id
 * @property string $fields
 *
 * @property Booking $booking
 */
class BookingFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%booking_fields}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booking_id'], 'integer'],
            [['fields'], 'string'],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'booking_id' => Yii::t('app', 'Booking ID'),
            'fields' => Yii::t('app', 'Fields'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\BookingFieldsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\BookingFieldsQuery(get_called_class());
    }


}
