<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $data array
/* @var $booking  app\models\Booking */
/* @var $booking  app\models\Booking */
/* @var $bookingFields  app\models\BookingFields */

foreach($data as $key => $value) { ?>
    <? if (isset($value->dbType)) { ?>
        <div class="form-group field-booking-<?=$key?>">
            <?= Html::label($value['name'], 'booking-'. $key, ['class' => 'control-label']) ?>
            <?= Html::activeInput($value['type'], $booking, $key, [ 'id' => 'booking-'. $key, 'class'=>'form-control']) ?>
            <?= Html::error($booking, $key) ?>
            <div class="hint-block"></div>
        </div>
    <? }else{ ?>
        <div class="form-group field-booking-<?=$key?>">
            <?= Html::label($value['name'], 'booking-'. $key, ['class' => 'control-label']) ?>
            <?= Html::activeInput($value['type'], $bookingFields, 'fields[' . $key. ']', [ 'id' => 'booking-'. $key, 'class'=>'form-control']) ?>
         </div>
    <?}?>
<? } ?>