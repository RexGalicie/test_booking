<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Tour;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TourFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'tour_id')->dropDownList(ArrayHelper::map(Tour::getTours(true), 'id', 'name'), ['prompt' => Yii::t('app', '-- Select tour --')]) ?>
    <?= $form->field($model, 'sort')->input(['number']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
