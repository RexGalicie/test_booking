<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */
/* @var $form yii\widgets\ActiveForm */
/* @var $bookingFields array */
?>

<div class="tour-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <h2 style="margin-bottom: 15px" class="text-center">Sort fields</h2>
    <?
        foreach($bookingFields as $key => $field){ ?>
            <div class="form-group">
                <div class="row">
                    <?= Html::label($field, 'booking-field'. $key, ['class' => 'control-label col-sm-4 col-xs-12']) ?>
                    <div class="col-sm-6 col-xs-12">
                        <?= Html::input('number', 'sort[' . $key . '][sort]', '', [ 'id' => 'booking-field'. $key, 'class'=>'form-control']) ?>
                    </div>
                </div>
            </div>
        <? } ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
