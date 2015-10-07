<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SocialmediaPlatform */

$this->title = 'Update Socialmedia Platform';
$this->params['breadcrumbs'][] = ['label' => 'Socialmedia Platforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sp_id, 'url' => ['view', 'id' => $model->sp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="socialmedia-platform-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
