<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Course */

$this->title = 'Update Course';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->course_id, 'url' => ['view', 'id' => $model->course_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
