<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\WorkingInformation */

$this->title = 'Create Working Information';
$this->params['breadcrumbs'][] = ['label' => 'Working Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="working-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
