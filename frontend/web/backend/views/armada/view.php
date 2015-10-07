<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Armada */

$this->title = $model->armada_id;
$this->params['breadcrumbs'][] = ['label' => 'Armadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="armada-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->armada_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->armada_id], [
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
            'armada_id',
            'armada_nama',
            'armada_keterangan:ntext',
            'status',
        ],
    ]) ?>

</div>
