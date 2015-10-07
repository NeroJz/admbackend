<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Armada */

$this->title = 'Create Armada';
$this->params['breadcrumbs'][] = ['label' => 'Armadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
