<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\PersonalInformation;
use yii\web\JsExpression;
use fedemotta\datatables\DataTables;

$model2 = new \backend\models\PersonalInformation;
$model = new \backend\models\User;
$this->title = 'Alumni';
$this->params['breadcrumbs'][] = $this->title;

/*print_r($userList);
die();*/

?>

<hr>
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-9">
                <h3><?= Html::encode('Manage Alumnis') ?> &nbsp;&nbsp;
                    <?= Html::a('Add new alumni', ['create'], ['class' => 'btn btn-success']) ?>
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

<!-- <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="list_alumni">
<thead>
	<tr>
	<th style="width:5%;"><center>#</center></th>
	<th style="width:40%;"><center>Name</center></th>
	<th style="width:15%;"><center>Username</center></th>
	<th style="width:15%;"><center>Date Created</center></th>
	<th style="width:15%;"><center>Date Updated</center></th>
	<th><center>Action</center></th>
	</tr>
</thead>
<tbody>
	<?php 
		/*$bil = 0;
		foreach($userList as $user)
		{
			$bil++;*/
	?>
	<tr>
		<td><center><?//=$bil?></center></td>
		<td><?//=$user['pi_name']?></td>
		<td><center><?//=$user['username']?></center></td>
		<td><center><?//=date('d-m-Y', $user['created_at']);?></center></td>
		<td><center><?//=date('d-m-Y', $user['updated_at']);?></center></td>
		<td><center>
			<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons center">
				<button class="btn btn-xs btn-warning btntooltip" data-original-title="Kemaskini" data-toggle="modal" 
					data-target="#editAlumni" onclick="viewUpdate(<?//=$user['pi_id']?>)" 
					id="update_<?//=$user['pi_id']?>" value="<?//=$user['pi_id']?>">
						<i class="fa fa-pencil-square-o"></i>
				</button>
				<button class="btn btn-xs btn-danger btntooltip" data-original-title="Padam" 
					onclick="DeleteUser(<?//=$user['id']?>)" id="delete_<?//=$user['id']?>">
						<i class="fa fa-trash"></i>
				</button>
			</div>
			</center>
		</td>
	</tr>
	<?php
		//}
	?>
</tbody>
</table>
</div> -->

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],
    [
    'attribute' => 'pi',
    'value' => 'pi.pi_name'
    ],

   // 'username',
        //'auth_key',
        //'password_hash',
        // 'password_reset_token',
        // 'status',
        // 'online_status',
   // 'created_at',
    [
    'attribute' => 'created_at',
    'value' => 'pi.pi_hp',
    ],
    [
    'attribute' => 'updated_at',
    'value' => 'pi.pi_phone_home',
    ],
    [
    'attribute' => 'online_status',
    'value' => 'pi.pi_email_1',
    ],
    ['class' => 'yii\grid\ActionColumn']
    ],
    ]); ?>
