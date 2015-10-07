<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBooking */

$this->title = 'Update User Booking: ' . ' ' . $model->ub_id;
$this->params['breadcrumbs'][] = ['label' => 'User Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ub_id, 'url' => ['view', 'id' => $model->ub_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-booking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
