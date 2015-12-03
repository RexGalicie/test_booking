<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tour}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $sort
 *
 * @property Booking[] $bookings
 * @property TourFields[] $tourFields
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tour}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
            [['sort'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourFields()
    {
        return $this->hasMany(TourFields::className(), ['tour_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\TourQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TourQuery(get_called_class());
    }

    /**
     * Returns Tour objects.
     * @param bool $asArray Return the Tour as object or as 'flat' array
     * @return Tour|array
     */
    public static function getTours($asArray = false)
    {
        return static::find()->asArray($asArray)->all();
    }
}
