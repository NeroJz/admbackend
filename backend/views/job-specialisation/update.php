<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JobSpecialisation */

$this->title = 'Update Job Specialisation: ' . ' ' . $model->js_id;
$this->params['breadcrumbs'][] = ['label' => 'Job Specialisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->js_id, 'url' => ['view', 'id' => $model->js_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-specialisation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
