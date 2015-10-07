<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InstitutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faculty';
$this->params['breadcrumbs'][] = $this->title;
?>
<hr>
<div class="institution-index">
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-9">
                <h3><?= Html::encode('Faculty') ?> &nbsp;&nbsp;
                    <?= Html::a('Add new faculty', ['create'], ['class' => 'btn btn-success']) ?>
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
                        <tr>
                          <td style="width:20%"><center><span class="glyphicon glyphicon-open-file"></span></center></td>
                          <td style="width:80%"><center> Register Course</center></td>
                        </tr>
                    </tbody>
                </table>                 
            </div>
        </div>
    </div>
</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'inst_id',
            'inst_code',
            'inst_name',

            ['class' => 'yii\grid\ActionColumn',
                                   'template'=>'{view}{update}{delete}{create}',
                                     'buttons'=>[
                                       'update' => function ($url, $model) {     
                                         return '&nbsp;'.Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                 'title' => Yii::t('yii', 'Update'),
                                         ]).'&nbsp;';
                                     },

                                         'create' => function ($url, $model) {     
                                           return '&nbsp;'.Html::a('<span class="glyphicon glyphicon-open-file"></span>', \yii\helpers\Url::to(array("course/create")).'&id='.$model->inst_id, [
                                                   'title' => Yii::t('yii', 'Register Course'),
                                           ]);                                 
                     
                                       }
                                   ]                            
            ],
        ],
    ]); ?>

</div>
