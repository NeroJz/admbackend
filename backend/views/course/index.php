<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EducationLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Course Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<hr>
<div class="education-level-index">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-9">
                    <h3><?= Html::encode('Course') ?> &nbsp;&nbsp;
                        <?= Html::a('Add new course', ['create'], ['class' => 'btn btn-success']) ?>
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'course_id',
            'course_code',
            'course_name',
            
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
