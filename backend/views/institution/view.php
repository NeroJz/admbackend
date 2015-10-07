<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Institution */

$this->title = $model->inst_code;
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-view">
<br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'inst_code',
            'inst_name',
        ],
    ]) ?>
    <br>
    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <br><br>
</div>
