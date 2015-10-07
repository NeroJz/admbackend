<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\University */

$this->title = 'Update University';
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uni_id, 'url' => ['view', 'id' => $model->uni_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="university-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
