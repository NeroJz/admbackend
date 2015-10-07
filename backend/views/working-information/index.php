<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkingInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Working Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="working-information-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Working Information', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'wi_id',
            'wi_company_name',
            'wi_position',
            'wi_year_of_service_from',
            'wi_year_of_service_to',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
