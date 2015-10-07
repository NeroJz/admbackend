<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EducationLevel */

$this->title = 'Add New Education Level';
$this->params['breadcrumbs'][] = ['label' => 'Education Levels', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="education-level-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
