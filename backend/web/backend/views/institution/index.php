<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InstitutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Institutions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Institution', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'inst_id',
            'inst_code',
            'inst_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
