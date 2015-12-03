<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TourFields */

$this->title = Yii::t('app', 'Create Tour Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tour Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
