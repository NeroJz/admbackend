<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\University */

$this->title = 'Create University';
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uni_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uni_code')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
