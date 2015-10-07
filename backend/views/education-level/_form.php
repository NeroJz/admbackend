<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EducationLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="education-level-form">
<br>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'el_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'el_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
