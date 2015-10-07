<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EducationLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advanced Search Result';
$this->params['breadcrumbs'][] = $this->title;
?>
<table class="table table-bordered" id="tble_search">
	<input type="hidden" id="urlAdvancedRedirect" value="<?php echo \yii\helpers\Url::to(array('user/view')).'&id='?>">
	<thead>
		<tr>
			<th><center>#</center></th>
			<th><center>Name</center></th>
			<th><center>Phone Number</center></th>
			<th><center>Email</center></th>
			<th><center>Address</center></th>
			<th><center>Action</center></th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				$bil = 0;
				foreach($student as $data)
				{
					$bil++;
			?>
			<tr>
				<td><?=$bil?></td>
				<td><?=$data['pi_name']?></td>
				<td><?=$data['pi_hp']?></td>
				<td><?=$data['pi_email_1']?></td>
				<td><?=$data['pi_address_permanent']?></td>
				<td><center><button class='btn btn-success btn-xs' onclick='viewAdvancedStudentDetail(<?=$data['pi_id']?>)'><i class='fa fa-search'>View Detail</i></button></center></td>
			</tr>
			<?php		
				}
			?>
		
	</tbody>
</table>

