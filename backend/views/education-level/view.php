<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EducationLevel */

$this->title = $model->el_code;
$this->params['breadcrumbs'][] = ['label' => 'Education Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="education-level-view">

    <h1><?//= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'el_id',
            'el_code',
            'el_name',
        ],
    ]) ?>

    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary pull-right', 'url' => ['/education-level']]) ?>
    </p>
    <br><br>
</div>
