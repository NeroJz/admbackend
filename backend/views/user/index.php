<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Alumni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
        'attribute' => 'pi',
        'value' => 'pi.pi_name'
        ],

        'username',
            //'auth_key',
            //'password_hash',
            // 'password_reset_token',
            // 'status',
            // 'online_status',
        [
        'attribute' => 'created_at',
        'value' => 'date("m/d/y",created_at)'
        ],
        'updated_at',

        //['test'],
        ],
        ]); ?>

    </div>
    <p>dfgfdg</p>
