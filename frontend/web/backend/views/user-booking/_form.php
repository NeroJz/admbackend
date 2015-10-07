<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBooking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'armada_id')->textInput() ?>

    <?= $form->field($model, 'alamat_penjemputan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'start_datetime')->textInput() ?>

    <?= $form->field($model, 'end_datetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
