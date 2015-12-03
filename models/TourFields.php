<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tour_fields}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $sort
 * @property integer $tour_id
 *
 * @property Tour $tour
 */
class TourFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tour_fields}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['sort', 'tour_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 64],
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
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'sort' => Yii::t('app', 'Sort'),
            'tour_id' => Yii::t('app', 'Tour'),
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
     * @return \app\models\queries\TourFieldsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TourFieldsQuery(get_called_class());
    }
}
