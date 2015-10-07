<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\models\User;
use backend\models\Armada;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBooking */
/* @var $form ActiveForm */
?>
<div class="order">

    <?php $form = ActiveForm::begin(); ?>


        <?=$form->field($model,'user_id')->dropDownList(
        ArrayHelper::map(User::find()->all(),'id','firstname'),
        ['prompt'=>'Pilih Nama']
); ?>
           <?=$form->field($model,'armada_id')->dropDownList(
        ArrayHelper::map(Armada::find()->all(),'armada_id','armada_nama'),
        ['prompt'=>'Pilih Armada']
); ?>
        <?= $form->field($model, 'alamat_penjemputan') ?>
<?php
echo $form->field($model, 'start_datetime')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Tanggal Mulai'],
     'value' => date('d M Y h:m:s'),
    'pluginOptions' => [
    'format' => 'yyyy-mm-dd h:m:s',
        'autoclose' => true
    ]
]);
?>
  
    <?php
echo $form->field($model, 'end_datetime')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Tanggal Mulai'],
     'value' => date('d M Y h:m:s'),
    'pluginOptions' => [
    'format' => 'yyyy-mm-dd h:m:s',
        'autoclose' => true
    ]
]);
?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- order -->
