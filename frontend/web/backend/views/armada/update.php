<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Armada */

$this->title = 'Update Armada: ' . ' ' . $model->armada_id;
$this->params['breadcrumbs'][] = ['label' => 'Armadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->armada_id, 'url' => ['view', 'id' => $model->armada_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="armada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
