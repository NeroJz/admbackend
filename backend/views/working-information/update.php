<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkingInformation */

$this->title = 'Update Working Information: ' . ' ' . $model->wi_id;
$this->params['breadcrumbs'][] = ['label' => 'Working Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wi_id, 'url' => ['view', 'id' => $model->wi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="working-information-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
