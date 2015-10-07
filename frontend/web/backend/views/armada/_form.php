<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Armada */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="armada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'armada_nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'armada_keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Tersedia' => 'Tersedia', 'Tidak Tersedia' => 'Tidak Tersedia', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
