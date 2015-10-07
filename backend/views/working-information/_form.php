<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkingInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="working-information-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wi_company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wi_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wi_year_of_service_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wi_year_of_service_to')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
