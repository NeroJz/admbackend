<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SocialmediaPlatform */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="socialmedia-platform-form">

	<?php $form = ActiveForm::begin() ?>
	
	<?= $form->field($model, 'sp_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'sp_description')->textarea(['rows' => 6]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
