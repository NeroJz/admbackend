<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JobSpecialisation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-specialisation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'js_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'js_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
