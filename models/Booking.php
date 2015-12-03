<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%booking}}".
 *
 * @property integer $id
 * @property string $time
 * @property string $address
 * @property integer $group_num
 * @property integer $agency_id
 * @property integer $adults
 * @property integer $childs
 * @property integer $infants
 * @property integer $tour_id
 * @property integer $pick_up
 * @property integer $drop_off
 *
 * @property Tour $tour
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%booking}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'address', 'group_num', 'agency_id', 'adults', 'childs', 'infants', 'pick_up', 'drop_off'], 'required'],
            [['time'], 'safe'],
            [['group_num', 'agency_id', 'adults', 'childs', 'infants', 'tour_id', 'pick_up', 'drop_off'], 'integer'],
            [['address'], 'string', 'max' => 250],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'time' => Yii::t('app', 'Time'),
            'address' => Yii::t('app', 'Address'),
            'group_num' => Yii::t('app', 'Group Num'),
            'agency_id' => Yii::t('app', 'Agency ID'),
            'adults' => Yii::t('app', 'Adults'),
            'childs' => Yii::t('app', 'Childs'),
            'infants' => Yii::t('app', 'Infants'),
            'tour_id' => Yii::t('app', 'Tour ID'),
            'pick_up' => Yii::t('app', 'Pick Up'),
            'drop_off' => Yii::t('app', 'Drop Off'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\BookingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\BookingQuery(get_called_class());
    }

    /**
     * @param array $array
     * @param string $column
     * @return array
     */
    public function customMultiSort($array, $column) {
        $sortArr = array();
        foreach($array as $key => $val){
            $sortArr[$key] = $val[$column];
        }

        array_multisort($sortArr,$array);

        return $array;
    }
}
