<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkingInformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="working-information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'wi_id') ?>

    <?= $form->field($model, 'wi_company_name') ?>

    <?= $form->field($model, 'wi_position') ?>

    <?= $form->field($model, 'wi_year_of_service_from') ?>

    <?= $form->field($model, 'wi_year_of_service_to') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
