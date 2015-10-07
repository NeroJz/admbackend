<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-booking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ub_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'armada_id') ?>

    <?= $form->field($model, 'alamat_penjemputan') ?>

    <?= $form->field($model, 'start_datetime') ?>

    <?php // echo $form->field($model, 'end_datetime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
