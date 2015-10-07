<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Alumni */

$this->title = $model->alumni_id;
$this->params['breadcrumbs'][] = ['label' => 'Alumnis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumni-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->alumni_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->alumni_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'alumni_id',
            'e_nama',
            'e_kp',
            'e_jantina',
            'e_alamat',
            'e_poskod',
            'e_alamat_tetap',
            'e_poskod_tetap',
            'e_tel_rumah',
            'e_tel_hp',
            'e_emel1',
            'e_emel2',
            'e_program',
            'e_fakulti',
            'e_tahun_tamat',
        ],
    ]) ?>

</div>
