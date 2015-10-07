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
     </ul>

                 <!-- Tab panes -->
     <div class="tab-content">
     
         
         <div role="tabpanel" class="tab-pane active" id="perInfo">
         <div class="container">
         <br>
               <form id="updateAlumniForm" method="post">
               <input type="hidden" id="url" value="<?php echo \yii\helpers\Url::to(array('user/saveupdate'))?>">
               <input type="hidden" name="userID" id="userID" value="<?=$user['id']?>">
               <input type="hidden" name="piID" id="piID" value="<?=$user['pi_id']?>">
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Full Name :</label>
                     </div>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Email" value="<?=$user['pi_name']?>">
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Permanent Address :</label>
                     </div>
                     <div class="col-sm-8">
                        <textarea style="width:100%" name="permanentaddress" id="permanentaddress"><?=$user['pi_address_permanent']?></textarea>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Permanent Zipcode :</label>
                     </div>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" name="permanentzipcode" id="permanentzipcode" value="<?=$user['pi_zipcode_permanent']?>" >
                     </div>
                     <div class="col-sm-8">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Address :</label>
                     </div>
                     <div class="col-sm-8">
                        <textarea style="width:100%" name="address" id="address"><?=$user['pi_address']?></textarea>
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Zipcode :</label>
                     </div>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?=$user['pi_zipcode']?>">
                     </div>
                     <div class="col-sm-8">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">IC Number :</label>
                     </div>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="icno" name="icno" value="<?=$user['pi_ic_or_passport']?>">
                     </div>
                     <div class="col-sm-3">
                        <label class="pull-right" id="gender">Gender :</label>
                     </div>
                     <div class="col-sm-4">
                        <div class="radio">
                        <?php
                            if($user['pi_gender'] == 1)
                            {

                        ?>
                            <label>
                              <input type="radio" name="optionsRadios" id="gender1" value="1" checked >
                              Male
                            </label>
                            &nbsp;
                            <label>
                              <input type="radio" name="optionsRadios2" id="gender2" value="2">
                              Female
                            </label>
                        <?php

                            }
                            else
                            {
                        ?>
                            <label>
                              <input type="radio" name="optionsRadios" id="gender1" value="1">
                              Male
                            </label>
                            &nbsp;
                            <label>
                              <input type="radio" name="optionsRadios2" id="gender2" value="2" checked >
                              Female
                            </label>
                        <?php       
                            }

                        ?>
                          
                        </div>
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Phone Number (home) :</label>
                     </div>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" name="phone" id="phone" value="<?=$user['pi_phone_home']?>" >
                     </div>
                     <div class="col-sm-3">
                        <label class="pull-right">Phone Number (Handphone) :</label>
                     </div>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" name="handphone" id="handphone" value="<?=$user['pi_hp']?>">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Email 1 :</label>
                     </div>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="email_1" id="email_1" value="<?=$user['pi_email_1']?>">
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 <br><br><br>
                 <div class="form-group">
                 <div class="col-sm-12">
                     <div class="col-sm-2">
                        <label class="pull-right">Email 2 :</label>
                     </div>
                     <div class="col-sm-8">
                        <input type="text" class="form-control" name="email_2" id="email_2" value="<?=$user['pi_email_2']?>">
                     </div>
                     <div class="col-sm-2">
                     </div>
                 </div>
                 </div>
                 
                
               
                     
               </div>
         </div>

         <div role="tabpanel" class="tab-pane" id="loginInfo">
            <div class="container">
            <br>
              
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Username :</label>
                    </div>
                    <div class="col-sm-8">
                       <input type="text" class="form-control" name="username" id="username" value="<?=$user['username']?>">
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
                <br><br><br>
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
                       <input type="text" class="form-control" name="userstatus" id="userstatus" value="<?=$status?>">
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
                <br><br><br>
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Created at :</label>
                    </div>
                    <div class="col-sm-3">
                       <input type="text" class="form-control" name="createdat" id="createdat" value="<?=date('d-m-Y', $user['created_at']);?>">
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
                <br><br><br>
                <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                       <label class="pull-right">Last updated at :</label>
                    </div>
                    <div class="col-sm-3">
                       <input type="text" class="form-control" name="updateat" id="updateat" value="<?=date('d-m-Y', $user['updated_at']);?>">
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                </div>
               
               
            </div>
             
         </div>
     </div>
     <br>
    <br>
   </div>

 

</div>

<p class="pull-right">
    <?= Html::a('back', ['index'], ['class' => 'btn btn-default']) ?>
    &nbsp;&nbsp;
    <?//= Html::a('Update', ['update', 'id' => $user['id']], ['class' => 'btn btn-primary']) ?>
    <button type="button" class="btn btn-primary" id="saveAlumni">Save Changes</button>
    &nbsp;&nbsp;&nbsp;
    <?/*= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ])*/ ?>
</p>
 </form>
<br>
<?php
}
?> 
