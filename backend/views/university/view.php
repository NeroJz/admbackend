<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\University */

$this->title = $model->uni_code;
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-view">
<?php
    $status = "Inactive";
    if($model->uni_status == 1)
    {
        $status = "Active";
    }
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'uni_id',
            'uni_code',
            'uni_name',
            [
            'attribute' => 'uni_status',
            'value' =>  $status
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <br><br>

</div>
