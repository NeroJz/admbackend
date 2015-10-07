<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumni */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumni-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'e_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_kp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_jantina')->textInput() ?>

    <?= $form->field($model, 'e_alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_poskod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_alamat_tetap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_poskod_tetap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_tel_rumah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_tel_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_emel1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_emel2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_fakulti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e_tahun_tamat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
