<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumni */

$this->title = 'Update Alumni: ' . ' ' . $model->alumni_id;
$this->params['breadcrumbs'][] = ['label' => 'Alumnis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->alumni_id, 'url' => ['view', 'id' => $model->alumni_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alumni-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
