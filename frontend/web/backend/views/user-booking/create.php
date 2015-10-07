<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserBooking */

$this->title = 'Create User Booking';
$this->params['breadcrumbs'][] = ['label' => 'User Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-booking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
