<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AlumniSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumni-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'alumni_id') ?>

    <?= $form->field($model, 'e_nama') ?>

    <?= $form->field($model, 'e_kp') ?>

    <?= $form->field($model, 'e_jantina') ?>

    <?= $form->field($model, 'e_alamat') ?>

    <?php // echo $form->field($model, 'e_poskod') ?>

    <?php // echo $form->field($model, 'e_alamat_tetap') ?>

    <?php // echo $form->field($model, 'e_poskod_tetap') ?>

    <?php // echo $form->field($model, 'e_tel_rumah') ?>

    <?php // echo $form->field($model, 'e_tel_hp') ?>

    <?php // echo $form->field($model, 'e_emel1') ?>

    <?php // echo $form->field($model, 'e_emel2') ?>

    <?php // echo $form->field($model, 'e_program') ?>

    <?php // echo $form->field($model, 'e_fakulti') ?>

    <?php // echo $form->field($model, 'e_tahun_tamat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
