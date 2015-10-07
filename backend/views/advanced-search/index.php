<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EducationLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advanced Search';
$this->params['breadcrumbs'][] = $this->title;
?>
<hr>
<div class="education-level-index">

<?php
$form = ActiveForm::begin(['action'=> ['advanced-search/get-advanced-report'], 'options'=>['method'=>'post']]);
?>
<h3 style="">General</h3>
<hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-6">
                <label style="font-size:15px">State :</label>
                <select class="form-control" name="state" id="state">
                    <option value="0"></option>
                    option
                <?php
                foreach($state as $namestate)
                {
                ?>
                    <option value="<?=$namestate['s_id']?>"><?=ucwords($namestate['s_name'])?></option>
                <?php
                }
                ?>
                  
                </select>
            </div>
            <div class="col-xs-6">
                <label style="font-size:15px">Race :</label>
                <select class="form-control" name="race" id="race">
                  <option value="0"></option>
                  <option value="1">Malay</option>
                  <option value="2">Chinese</option>
                  <option value="3">Indian</option>
                  <option value="4">Others</option>
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-6">
                <label style="font-size:15px">Age :</label>
                <select class="form-control" name="age" id="age">
                  <option value="0"></option>
                  <option value="20-25">Between 20 to 25</option>
                  <option value="26-30">Between 26 to 30</option>
                  <option value="31-35">Between 31 to 35</option>
                  <option value="36-40">Between 36 to 40</option>
                  <option value="41">41 and above</option>
                </select>
            </div>
            <div class="col-xs-6">
                <label style="font-size:15px">Gender :</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="radio-inline">
                  <input type="radio" name="gender" id="inlineRadio1" value="1"> Male
                </label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="radio-inline">
                  <input type="radio" name="gender" id="inlineRadio2" value="2"> Female
                </label>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <h3 style="">Education </h3>
    <hr>
        <div class="row">
            <div class="col-xs-12">
            <input type="hidden" id="advurlgetFact" value="<?php echo \yii\helpers\Url::to(array('advanced-search/get-course'))?>">
                    <label style="font-size:15px">Faculty :</label>
                    <select class="form-control" id="advFaculty" name="advFaculty">
                      <option value="0">All Faculty</option>
                      <?php
                      foreach($Faculty as $namefact)
                      {
                      ?>
                        <option value="<?=$namefact['inst_id']?>"><?=ucwords(strtolower($namefact['inst_name']))?></option>
                      <?php
                      }
                      ?>
                    </select>
            </div>
        </div>
        <br>
            <div class="row">
                <div class="col-xs-12">
                        <label style="font-size:15px">Course :</label>
                        <select class="form-control" name="advCourse" id="advCourse">
                              <option value="0">All Course</option>
                        <?php
                            foreach($course as $course)
                            {
                         ?>
                            <option value="<?=$course['course_id']?>"><?= ucwords(strtolower($course['course_name']))?></option>
                         <?php
                             }
                         ?>
                        </select>
                </div>
            </div>
            <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-6">
                    <label style="font-size:15px">Level :</label>
                    <select class="form-control" id="level" name="level">
                          <option value="0"></option>
                       <?php
                         foreach($level as $lvl)
                         {
                         ?>
                            <option value="<?=$lvl['el_id']?>"><?=ucwords(strtolower($lvl['el_name']))?></option>
                         <?php
                         }
                         ?>
                    </select>
                </div>
                <div class="col-xs-6">
                    <label style="font-size:15px">Year :</label>
                    <?php
                      $currentYear = date('Y',time()) - 1;
                      //$range = ($currentYear - 2005);

                    ?>
                    <select class="form-control" id="year" name="year">
                          <option value="0"></option>
                    <?php
                        for ($i=2005; $i <= $currentYear ; $i++) { 
                           // $num_padded = sprintf("%02d", $i);
                    ?>
                            <option value="<?=$i?>"><?=$i?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <h3 style="">Occupation </h3>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-6">
                    <label style="font-size:15px">State :</label>
                    <select class="form-control" id="stateWork" name="stateWork">
                        <option value="0"></option>
                    <?php
                    foreach($state as $namestate)
                    {
                    ?>
                        <option value="<?=$namestate['s_id']?>"><?=ucwords($namestate['s_name'])?></option>
                    <?php
                    }
                    ?>
                      
                    </select>
                </div>
                <div class="col-xs-6">
                    <label style="font-size:15px">Position :</label>
                    <input type="text" class="form-control" name="workposition" id="workposition">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
               <label style="font-size:15px">Status :</label>
               <label class="radio-inline">
                 <input type="radio" name="workstatus" id="inlineRadio1" value="2"> Employed
               </label>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <label class="radio-inline">
                 <input type="radio" name="workstatus1" id="inlineRadio2" value="0"> Unemployed
               </label>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" id="searchadv" class="btn btn-primary pull-right">Search</button>
            </div>
        </div>
 <!-- </form>  --> 
 <?php ActiveForm::end(); ?>     
</div>