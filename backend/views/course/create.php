<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\University;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Institution */

$this->title = 'Create Course';
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="institution-form">
<form id="regCourse" method="POST">
<input type="hidden" id="urlgetFact" value="<?php echo \yii\helpers\Url::to(array('course/getfaculty'))?>">
<input type="hidden" id="urlsaveCourse" value="<?php echo \yii\helpers\Url::to(array('course/savecourse'))?>">

<?php
  if($hasRecord == 0)
  {
?>
 <div class="form-group">
    <div class="col-sm-12">
        <div class="col-sm-2">
           <label class="pull-right">University Name :</label>
        </div>
        <div class="col-sm-10">
           <select class="form-control" name="uni_id" id="uni_select">
             <option>Please Choose</option>
             <?php
              foreach($university as $uni)
              {
             ?>
              	<option value="<?=$uni['uni_id']?>"><?=ucwords(strtolower($uni['uni_name']))?></option>
          	<?php
              }
             ?>
           </select>
        </div>
    </div>
  </div>
  <br><br><br>
  <div class="form-group">
     <div class="col-sm-12">
         <div class="col-sm-2">
            <label class="pull-right">Faculty Name :</label>
         </div>
         <div class="col-sm-10">
            <select class="form-control" name="fact_id" id="fact_name" disabled>
              <option>Please Choose</option>
            </select>
         </div>
     </div>
   </div>
<?php
 }
  else if($hasRecord == 1)
  {
?>
<div class="form-group">
    <div class="col-sm-12">
        <div class="col-sm-2">
           <label class="pull-right">University Name :</label>
        </div>
        <div class="col-sm-10">
           <select class="form-control" name="uni_id" id="uni_select">
             <?php
              foreach($university as $uni)
              {
             ?>
                <option value="<?=$uni['uni_id']?>"><?=ucwords(strtolower($uni['uni_name']))?></option>
            <?php
              }
             ?>
           </select>
        </div>
    </div>
  </div>
  <br><br><br>
  <div class="form-group">
     <div class="col-sm-12">
         <div class="col-sm-2">
            <label class="pull-right">Faculty Name :</label>
         </div>
         <div class="col-sm-10">
            <select  class="form-control" name="fact_id" id="fact_name">
              <?php
               foreach($university as $uni)
               {
              ?>
                 <option value="<?=$uni['inst_id']?>"><?=ucwords(strtolower($uni['inst_name']))?></option>
             <?php
               }
              ?>
            </select>
         </div>
     </div>
   </div>
<?php
    }

?>
    <br><br><br>
    <table class="table table-striped table-bordered">
    	<thead>
    		<tr>
    			<th style="width:5%"><center>No</center></th>
    			<th style="width:50%"><center>Course Name</center></th>
    			<th style="width:40%"><center>Course Code</center></th>
    			<!-- <th style="width:10%"></th> -->
    		</tr>
    	</thead>
    	<tbody id="RegisterCourse">
    		<tr>
    			<td><center>1</center></td>
    			<td><input style="width:100%" type="text" name="course_1" value="" placeholder=""></td>
    			<td><input style="width:100%" type="text" name="courseCode_1" value="" placeholder=""></td>
    			<!-- <td><center><button type="button" class="btn btn-danger btn-xs">Delete <i class="fa fa-minus-square"></i></button></center></td> -->
    		</tr>
    	</tbody>
    </table>
    <input type="hidden" id="hideTempIntCourse" value="2">
   <button type="button" class="btn btn-primary btn-sm addRowCourse pull-right"><i class="fa fa-plus"> Add Course</i></button>

    <br>
    <hr>
    <div class="form-group">
    	<center><button type="button" id="saveCourse" class="btn btn-success">Save</button></center>
    </div>
    <br>
</form>
</div>
