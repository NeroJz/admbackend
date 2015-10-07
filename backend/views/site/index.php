<?php
/* @var $this yii\web\View */

$this->title = 'UTeM Alumni Management System';
/*echo "<pre>";
print_r($report);
echo "</pre>";*/
?>

<div class="site-index">


    <div class="body-content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h4><b>Add Alumni</b></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(array('user/create')) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4><b>Add Course</b></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(array('course/create')) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4><b>Add Faculty</b></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(array('institution/create')) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h4><b>View Report</b></h4>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to(array('report/index')) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
    </div>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <br>
    <div>
    <input type="hidden" id="urlgetData" value="<?php echo \yii\helpers\Url::to(array('site/search-data'))?>">
    <?php

        $faculty = array();
        foreach ($report as $reportData) {

            $faculty[$reportData['inst_id']]['facultyName'] = $reportData['inst_name'];
            $faculty[$reportData['inst_id']]['facultyCode'] = $reportData['inst_code'];
            $faculty[$reportData['inst_id']][$reportData['ei_graduation_year']] = $reportData['totalstudent'];

        }
/*        echo "<pre>";
        print_r( $faculty);
        echo "</pre>";
*/
        $currentYear = date('Y',time());
    ?>
     <table class="table table-bordered">
       <thead>
         <tr>
           <th rowspan="2"><center>Faculty</center></th>
           <th colspan="5"><center>Year</center></th>
         </tr>
         <tr>
         <?php
         $year = array();
         $bil = 1;
         for ($i= $currentYear - 5; $i < $currentYear ; $i++) { 
              $year[] = $i;
          ?>
            
              <th><?=$i?><input type="hidden" id="year_<?=$bil?>" value="<?=$i?>"></th>
          <?php
          $bil++;
         }
         ?>

        </tr>
       </thead>
       <tbody>
       <?php
          $no = 1;
          foreach($faculty as $data)
          {
        ?>
        <tr id="faculty_<?=$no?>">
          <td><input type="hidden" id="code_<?=$no?>" value="<?=$data['facultyCode']?>"><?=$data['facultyName']." (".$data['facultyCode'].")"?></td>
          <?php
          for ($i=0; $i < sizeof($year) ; $i++)
           { 
          ?>
          <td><?php
             // if($data[])
                if (array_key_exists($year[$i],$data))
                  {
                  echo '<input type="hidden" id="data'.$year[$i].$no.'" value="'.$data[$year[$i]].'">'.$data[$year[$i]];

                  }
                else
                  {
                  echo '<input type="hidden" id="data'.$year[$i].$no.'" value="0"> 0 ';
                  }

          ?>
          </td>
          <?php
          } // tutup for
          ?>
        </tr>
        <?php 
            $no++;
          }
       ?>
       </tbody>
     </table> 
    </div>
    
   
</div>

