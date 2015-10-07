<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SocialmediaPlatform */

$this->title = 'Create Socialmedia Platform';
$this->params['breadcrumbs'][] = ['label' => 'Socialmedia Platforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socialmedia-platform-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
