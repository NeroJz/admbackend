<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Socialmedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="socialmedia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sp_id')->textInput() ?>

    <?= $form->field($model, 'sm_content')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
