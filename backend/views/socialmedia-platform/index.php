<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SocialmediaPlatformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Socialmedia Platforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socialmedia-platform-index">

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-9">
                <h3><?= Html::encode('Socialmedia Platforms') ?> &nbsp;&nbsp;
                    <?= Html::a('Add new platform', ['create'], ['class' => 'btn btn-success']) ?>
                </h3>                   
            </div>
            <div class="col-xs-3">
                <table border="1" width="100%">
                    <thead>
                      <tr>
                          <th colspan="2"><center>Guide</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td style="width:20%"><center><span class="glyphicon glyphicon-eye-open"></span></center></td>
                          <td style="width:80%"><center>View Information</center></td>
                        </tr>
                        <tr>
                          <td style="width:20%"><center><span class="glyphicon glyphicon-pencil"></span></center></td>
                          <td style="width:80%"><center> Edit Information</center></td>
                        </tr>
                        <tr>
                          <td style="width:20%"><center><span class="glyphicon glyphicon-trash xs"></span></center></td>
                          <td style="width:80%"><center> Delete Information</center></td>
                        </tr>
                    </tbody>
                </table>                 
            </div>
        </div>
    </div>
</div>
<br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'sp_id',
           // 'sp_logo',
            'sp_name',
            'sp_description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
