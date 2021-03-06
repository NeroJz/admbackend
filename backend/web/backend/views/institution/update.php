<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Institution */

$this->title = 'Update Institution: ' . ' ' . $model->inst_id;
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inst_id, 'url' => ['view', 'id' => $model->inst_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="institution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
