<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JobSpecialisation */

$this->title = 'Create Job Specialisation';
$this->params['breadcrumbs'][] = ['label' => 'Job Specialisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-specialisation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
