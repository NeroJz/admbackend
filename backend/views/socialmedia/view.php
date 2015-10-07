<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Socialmedia */

$this->title = $model->sm_id;
$this->params['breadcrumbs'][] = ['label' => 'Socialmedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socialmedia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sm_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sm_id], [
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
            'sm_id',
            'sp_id',
            'sm_content',
        ],
    ]) ?>

</div>
