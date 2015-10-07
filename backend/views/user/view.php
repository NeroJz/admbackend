<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\PersonalInformation;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

foreach($userList as $user)
{
$this->title = "view record";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

   <div>
   

                 <!-- Nav tabs -->
     <ul class="nav nav-tabs nav-justified" role="tablist">
         <li role="presentation" class="active"><a href="#perInfo" aria-controls="perInfo" role="tab" data-toggle="tab">Personal Information</a></li>
         <li role="presentation"><a href="#loginInfo" aria-controls="loginInfo" role="tab" data-toggle="tab">Login Information</a></li>
         <li role="presentation"><a href="#EducationInfo" aria-controls="EducationInfo" role="tab" data-toggle="tab">Education Information</a></li>
         <li role="presentation"><a href="#WorkingInfo" aria-controls="WorkingInfo" role="tab" data-toggle="tab">Working Information</a></li>
     </ul>

                 <!-- Tab panes -->
     <div class="tab-content">
     
         
         <div role="tabpanel" class="tab-pane active" id="perInfo">
         <div class="container">
         <br>
               <form id="updateAlumniForm" method="post">
               <input type="hidden" id="url" value="<?php echo \yii\helpers\Url::to(array('user/saveupdate'))?>">
               <input type="hidden" id="urlview" value="<?php echo \yii\helpers\Url::to(array('user/viewuser'))?>">
               <input type="hidden" name="userID" id="userID" value="<?=$user['id']?>">
               <input type="hidden" name="piID" id="piID" value="<?=$user['pi_id']?>">
                 <div class="form-group">
                 <h4>User Detail</h4>
                 <hr>
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Full Name :</label>
                     </div>
                     <div class="col-sm-8">
                        <p><?=ucwords(strtolower($user['pi_name']))?></p>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">IC Number :</label>
                     </div>
                     <div class="col-sm-8">
                        <p><?=ucfirst($user['pi_ic_or_passport'])?></p>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Permanent Address :</label>
                     </div>
                     <div class="col-sm-8">
                        <p><?=ucwords(strtolower($user['pi_address_permanent']))?></p>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Address :</label>
                     </div>
                     <div class="col-sm-8">
                        <p><?=ucwords(strtolower($user['pi_address']))?></p>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Permanent Zipcode :</label>
                     </div>
                     <div class="col-sm-2">
                        <p><?=$user['pi_zipcode_permanent']?></p>
                     </div>
                     <div class="col-sm-2">
                        <label class="pull-right">Permanent Zipcode :</label>
                     </div>
                     <div class="col-sm-2">
                        <p><?=$user['pi_zipcode']?></p>
                     </div>
                     
                 </div>
                 </div>

                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right" id="gender">Gender :</label>
                     </div>
                     <div class="col-sm-4">
                        <div class="radio">
                        <?php
                            if($user['pi_gender'] == 1)
                            {

                        ?>
                            <p>
                              <input type="radio" name="optionsRadios" id="gender1" value="1" checked >
                              Male
                            </p>
                            &nbsp;
                            <p>
                              <input type="radio" name="optionsRadios2" id="gender2" value="2" disabled>
                              Female
                            </p>
                        <?php

                            }
                            else
                            {
                        ?>
                            <p>
                              <input type="radio" name="optionsRadios" id="gender1" value="1" disabled>
                              Male
                            </p>
                            &nbsp;
                            <p>
                              <input type="radio" name="optionsRadios2" id="gender2" value="2" checked >
                              Female
                            </p>
                        <?php       
                            }

                        ?>
                          
                        </div>
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <hr>
                 <br>
                 <h4>Contact Information</h4>
                 <hr>
              
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Email 1 :</label>
                     </div>
                     <div class="col-sm-8">
                        <p><?=$user['pi_email_1']?></p>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Email 2 :</label>
                     </div>
                     <div class="col-sm-8">
                        <p><?=$user['pi_email_2']?></p>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Phone Number (home) :</label>
                     </div>
                     <div class="col-sm-2">
                        <p><?=$user['pi_phone_home']?></p>
                     </div>
                     <div class="col-sm-3">
                        <label class="pull-right">Phone Number (Handphone) :</label>
                     </div>
                     <div class="col-sm-2">
                        <p><?=$user['pi_hp']?></p>
                     </div>
                 </div>
                 </div>
                 
                
               
                     
               </div>
         </div>

         <div role="tabpanel" class="tab-pane" id="loginInfo">
            <div class="container">
            <br>
              <h4>Login Detail</h4>
              <hr>
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Username :</label>
                    </div>
                    <div class="col-sm-8">
                        <p><?=$user['username']?></p>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
                <br>
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Status :</label>
                    </div>
                    <div class="col-sm-3">
                    <?php 
                        $status = "";
                        if($user['status'] == 0)
                        {
                            $status = "Inactive";
                        }
                        else if($user['status'] == 10)
                        {
                            $status = "Active";
                        }

                    ?>
                        <p><?=$status?></p>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
                <br>
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Created at :</label>
                    </div>
                    <div class="col-sm-3">
                        <p><?=date('d-m-Y', $user['created_at']);?></p>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
                <br>
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Last updated at :</label>
                    </div>
                    <div class="col-sm-3">
                        <p><?=date('d-m-Y', $user['updated_at']);?></p>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
               
               
            </div>
             
         </div>
        <div role="tabpanel" class="tab-pane" id="EducationInfo">

        <br>
        <h4>Education Detail</h4>
        <hr>
        <br>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myEducation"> Add Education Data</button>
        <br><br>
        <table class="table table-striped table-bordered">
          
            <thead>
                <tr>
                    <th style="width:5%;"><center>No</center></th>
                    <th style="width:20%;"><center>University</center></th>
                    <th style="width:25%;"><center>Faculty</center></th>
                    <th style="width:25%;"><center>Course</center></th>
                    <th style="width:10%;"><center>Level</center></th>
                    <th style="width:10%;"><center>Graduation Year</center></th>
                    <th style="width:10%;"><center>Action</center></th>

                </tr>
            </thead>
            <tbody>
            <?php
            $bil = 0;
            foreach($userEducation as $education)
            {
                $bil++;
                $content = "";
                if($education['uni_code'] == "UTeM")
                {
                    $content =  "<center><button type='button' data-toggle='modal' data-target='#myEditEducation' class='btn btn-warning btn-xs' onclick='EditEducation(".$education['id'].")'><i class='fa fa-edit'><i></button></center>";
                }
                else
                {
                    $content =  "<center>-</center>";
                }
            ?>
                <tr id="edit<?=$bil?>">
                    <td><center><?=$bil?></center></td>
                    <td><?=ucwords(strtolower($education['uni_name']))?></td>
                    <td><?=ucwords(strtolower($education['inst_name']))?></td>
                    <td><?=ucwords(strtolower($education['course_name']))?></td>
                    <td><center><?=ucwords(strtolower($education['el_name']))?></center></td>
                    <td><center><?=ucwords(strtolower($education['ei_graduation_year']))?></center></td>
                    <td><?=$content?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
            
         </div>
         <div role="tabpanel" class="tab-pane" id="WorkingInfo">
           <br>

           <h4>Working Detail</h4>
           <hr>
           <br>
           <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"> Add Working Data</button>
           <br><br>
           <table class="table table-striped table-bordered">
             
               <thead>
                   <tr>
                       <th style="width:5%;"><center>No</center></th>
                       <th style="width:20%;"><center>Company Name</center></th>
                       <th style="width:25%;"><center>Position</center></th>
                       <th style="width:25%;"><center>Year</center></th>
                   </tr>
               </thead>
               <tbody>
               <?php
               $bil = 0;
               foreach($userWorking as $working)
               {
                   $bil++;
               ?>
                   <tr>
                       <td><center><?=$bil?></center></td>
                       <td><center><?=$working['wi_company_name']?></center></td>
                       <td><center><?=ucwords(strtolower($working['wi_position']))?></center></td>
                       <td><center><?=$working['wi_year_of_service_from']. "-" .$working['wi_year_of_service_to']?></center></td>
                   </tr>
               <?php
               }
               ?>
               </tbody>
           </table>
          </div>
     </div>
     <br>
    <br>
   </div>

 

</div>

<p class="pull-right">
    <?= Html::a('back', ['index'], ['class' => 'btn btn-primary']) ?>
    &nbsp;&nbsp;
</p>
 </form>
<br>
<?php
}
?> 

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><center>Add Working Data</center></h4>
       <form id="regWorking" method="POST">     
            <div class="col-sm-12">
                <input type="hidden" id="urlWorking" value="<?php echo \yii\helpers\Url::to(array('working-information/saveworkingrecord'))?>">
                <input type="hidden" name="userID" id="userID" value='<?=$user['id']?>'>
               <input type="hidden" class="form-control" name="working_status" id="working_status" value="2">

               <br>
                <label class="pull-left">Company Name :</label>
                 <input type="text" class="form-control" name="company_name" id="company_name"> 
            </div>
            <div class="col-sm-12">
               <input type="hidden" class="form-control" name="working_status" id="working_status" value="2">
               <br>
                   <label class="pull-left"> Position :</label>
                   <input type="text" class="form-control" name="company_position" id="company_position">
            </div>
            <div class="col-sm-12">
                           
            </div>
            <div class="col-sm-12">
                    <br>
                    <div class="col-sm-8">
                        <label class="pull-left">Service From :  &nbsp;</label>
                        <input type="text" class="form-control" style="width:70%" name="service_start" id="service_start" placeholder="eg : 2011" >      
                    </div>             
            </div>
            <div class="col-sm-12">
                           
            </div>
            <div class="col-sm-12">
                <br>
                <div class="col-sm-8">
                    <label class="pull-left">Service To : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" style="width:70%" name="service_to" id="service_to" placeholder="eg : 2015">
                </div>
                <div class="col-sm-4 pull-left">
                    <label>
                        <input type="checkbox" id="current" name="current"> Current
                    </label>
                </div>              
            </div>
            <div class="col-sm-12">
                           
            </div>
            <br>
            </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveWorkingRecord">Save changes</button>
      </div>

    
    </div>
  </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="myEducation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><center>Education Information</center></h4>
           <form id="NewEducationForm" method="POST">     
                <div class="col-sm-12">
                    <input type="hidden" id="urlEducation" value="<?php echo \yii\helpers\Url::to(array('user/saveneweducation'))?>">
                    <input type="hidden" id="urlEducationCourse" value="<?php echo \yii\helpers\Url::to(array('user/getcourse'))?>">

                    <input type="hidden" name="stuid" id="stuid" value='<?=$user['id']?>'>

                   <br>
                    <label class="pull-left">University Name :</label>
                    <input type="hidden" name="uni_id" id="uni_id" value="1">
                     <input type="text" class="form-control" name="uni_name" id="uni_name" value="UNIVERSITI TEKNIKAL MALAYSIA MELAKA" readonly> 
                </div>
                <div class="col-sm-12">
                    <br>
                       <label class="pull-left"> Faculty Name :</label>
                       <select  class="form-control" name="fact_name" id="fact_name">
                            <option value="0">- Please choose -</option>}
                            option
                        
                        <?php
                            foreach($institution as $data)
                            {
                        ?>
                                <option value="<?=$data['inst_id']?>"><?=strtoupper($data['inst_name'])?></option>
                        <?php
                            }
                        ?>
                       </select>
                </div>
                <div class="col-sm-12">
                        <br>
                        <label class="pull-left"> Course Name :</label>
                        <!-- <input type="text" id="current"class="form-control" name="update_course_name" id="update_course_name" readonly>  -->
                        <select  class="form-control" name="course_name" id="course_name" disabled >  
                        </select>
                                    
                </div>
                <div class="col-sm-12">
                        <br>
                            <label class="pull-left">Level :</label>  
                            <select  class="form-control" name="level" id="level"> 
                                <option value="">- Please Choose - </option>}
                                 option 
                                <?php
                                    foreach($level  as $data2)
                                    {
                                ?>
                                        <option value="<?=$data2['el_id']?>"><?=strtoupper($data2['el_name'])?></option>
                                <?php
                                    }
                                ?>
                            </select>    
                </div>
                <div class="col-sm-12">
                    <br>
                    <div class="col-sm-8">
                        <label class="pull-left">Graduation Year : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" style="width:70%" name="year" id="year" placeholder="eg : 2015">
                    </div>             
                </div>
                <div class="col-sm-12">
                               
                </div>
                <br>
                </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveNewEducationRecord">Save changes</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myEditEducation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><center>Education Information</center></h4>
           <form id="EditEducationForm" method="POST">     
                <div class="col-sm-12">
                    <input type="hidden" id="urlEducationEdit" value="<?php echo \yii\helpers\Url::to(array('user/updateeducation'))?>">
                    <input type="hidden" id="urlEducationCourse" value="<?php echo \yii\helpers\Url::to(array('user/getcourse'))?>">

                    <input type="hidden" name="id" id="id" value=''>

                   <br>
                    <label class="pull-left">University Name :</label>
                     <input type="text" class="form-control" name="update_uni_name" id="update_uni_name" readonly> 
                </div>
                <div class="col-sm-12">
                    <br>
                       <label class="pull-left"> Faculty Name :</label>
                       <select  class="form-control" name="update_fact_name" id="update_fact_name">
                        
                        <option id="update_fact_name_selected" selected></option>
                        <?php
                            foreach($institution as $data)
                            {
                        ?>
                                <option value="<?=$data['inst_id']?>"><?=strtoupper($data['inst_name'])?></option>
                        <?php
                            }
                        ?>
                       </select>
                </div>
                <div class="col-sm-12">
                        <br>
                        <label class="pull-left"> Course Name :</label>
                        <!-- <input type="text" id="current"class="form-control" name="update_course_name" id="update_course_name" readonly>  -->
                        <select  class="form-control" name="update_course_name" id="update_course_name">  
                        </select>
                                    
                </div>
                <div class="col-sm-12">
                        <br>
                            <label class="pull-left">Level :</label>  
                            <select  class="form-control" name="update_level" id="update_level">  
                                <option id="update_level_selected" selected></option>
                                <?php
                                    foreach($level  as $data2)
                                    {
                                ?>
                                        <option value="<?=$data2['el_id']?>"><?=strtoupper($data2['el_name'])?></option>
                                <?php
                                    }
                                ?>
                            </select>    
                </div>
                <div class="col-sm-12">
                    <br>
                    <div class="col-sm-8">
                        <label class="pull-left">Graduation Year : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" style="width:70%" name="update_year" id="update_year" placeholder="eg : 2015">
                    </div>             
                </div>
                <div class="col-sm-12">
                               
                </div>
                <br>
                </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveEducationRecord">Save changes</button>
          </div>

        </div>
        </div>
      </div>