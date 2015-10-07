<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Course */

$this->title = $model->course_code;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

    <h1><?//= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'course_id',
            'course_code',
            'course_name',
        ],
    ]) ?>

    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary pull-right']) ?>
     
    </p>
    <br><br>

</div>
