<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Tour;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validateOnSubmit' => true,
    ]); ?>
    <?= $form->field($model, 'address')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'infants')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'adults')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'agency_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'drop_off')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'group_num')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'pick_up')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'time')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'childs')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'tour_id')->dropDownList(
        ArrayHelper::map(Tour::getTours(true), 'id', 'name'),
        [
            'prompt' => Yii::t('app', '-- Select tour --'),
            'onchange'=>'
                $.get( "/booking/list?id="+$(this).val(), function( data ) {
                  $( "#fields" ).html( data );
                });'
        ]);
    ?>
    <div id="fields"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
