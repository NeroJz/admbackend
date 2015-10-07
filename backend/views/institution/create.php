<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\University;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Institution */

$this->title = 'Create Faculty';
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($hasRecord);

?>
<div class="institution-form">
<form id="regFact" method="POST">
<input type="hidden" id="urlfact" value="<?php echo \yii\helpers\Url::to(array('institution/saverecord'))?>">
 <div class="form-group">
    <div class="col-sm-12">
        <div class="col-sm-2">
           <label class="pull-right">University Name :</label>
        </div>
        <div class="col-sm-10">

        <?php
             if($hasRecord == "0")
              {
        ?>
                <select class="form-control" name="uni_id">
                  <option>Please Choose</option>
        <?php
                foreach($university as $uni)
                   {           
        ?>
                      <option value="<?=$uni['uni_id']?>"><?=ucwords(strtolower($uni['uni_name']))?></option>
        <?php
                   }
             }
             else
              {
        ?>
                <select class="form-control" name="uni_id">
        <?php
                foreach($university as $uni)
                   {
                     
        ?>
                      <option value="<?=$uni['uni_id']?>"><?=ucwords(strtolower($uni['uni_name']))?></option>
                      
        <?php
                   }
             }
              
        ?>
           </select>
        </div>
    </div>
  </div>
    <br><br><br>
    <table class="table table-striped table-bordered">
    	<thead>
    		<tr>
    			<th style="width:5%"><center>No</center></th>
    			<th style="width:50%"><center>Faculty Name</center></th>
    			<th style="width:20%"><center>Faculty Code</center></th>
    			<!-- <th style="width:10%"></th> -->
    		</tr>
    	</thead>
    	<tbody id="RegisterFaculty">
    		<tr>
    			<td><center>1</center></td>
    			<td><input style="width:100%" type="text" name="fact_1" value="" placeholder=""></td>
    			<td><input style="width:100%" type="text" name="factCode_1" value="" placeholder=""></td>
    			<!-- <td><center><button type="button" class="btn btn-danger btn-xs">Delete <i class="fa fa-minus-square"></i></button></center></td> -->
    		</tr>
    	</tbody>
    </table>
    <input type="hidden" id="hideTempInt" name="hideTempInt" value="2">
   <button type="button" class="btn btn-primary btn-sm addRow pull-right"><i class="fa fa-plus"> Add Faculty</i></button>

    <br>
    <hr>
    <div class="form-group">
    	<center><button type="button" id="saveFact" class="btn btn-success">Save</button></center>
    </div>
    <br>
</form>
</div>
