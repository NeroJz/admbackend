<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PersonalInformation;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Add New Alumni';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<? /*$this->render('_form', [
    'model' => $model,
])*/ ?>
<div class="user-create">
<?php $form = ActiveForm::begin(); ?>

     <?php $model2 = new \backend\models\PersonalInformation?>

      <?= $form->field($model2, 'pi_name')->textInput()->label('Full Name') ?>
      <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
      <?php echo $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive']); ?>
                 
     <br><br>

     <div class="form-group">
         <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     </div>
 	<?php ActiveForm::end(); ?>


</div>
