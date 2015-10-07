<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EducationLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Social Network';
$this->params['breadcrumbs'][] = $this->title;
?>
<hr>
<div class="education-level-index">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <h3><?= Html::encode('Social Network') ?> &nbsp;&nbsp;
                        <?= Html::a('Add new Social Network', ['create'], ['class' => 'btn btn-success']) ?>
                    </h3>                   
                </div>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sp_id',
            'sp_logo',
            'sp_name',
            'sp_description',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
