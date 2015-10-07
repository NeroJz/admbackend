<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Socialmedia */

$this->title = 'Update Socialmedia: ' . ' ' . $model->sm_id;
$this->params['breadcrumbs'][] = ['label' => 'Socialmedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sm_id, 'url' => ['view', 'id' => $model->sm_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="socialmedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
