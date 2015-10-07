<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlumniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alumnis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumni-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alumni', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'alumni_id',
            'e_nama',
            'e_kp',
            'e_jantina',
            'e_alamat',
            // 'e_poskod',
            // 'e_alamat_tetap',
            // 'e_poskod_tetap',
            // 'e_tel_rumah',
            // 'e_tel_hp',
            // 'e_emel1',
            // 'e_emel2',
            // 'e_program',
            // 'e_fakulti',
            // 'e_tahun_tamat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
