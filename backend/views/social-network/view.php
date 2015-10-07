<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SocialmediaPlatform */

$this->title = $model->sp_name;
$this->params['breadcrumbs'][] = ['label' => 'Socialmedia Platforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socialmedia-platform-view">

    <h1><?//= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sp_id',
            //'sp_logo',
            'sp_name',
            'sp_description:ntext',
        ],
    ]) ?>

    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <br><br>

</div>
