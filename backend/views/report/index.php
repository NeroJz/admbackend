<?php
/* @var $this yii\web\View */

$this->title = 'Alumni Reports';
?>
<hr>
<div class="site-index">


    <div class="body-content">
    <center><h3>Report Details</h3></center>
        <div class="row">
           	<div class="form-group">
            <input type="hidden" id="advurlgetReport" value="<?php echo \yii\helpers\Url::to(array('report/get-report'))?>">
           		<div class="col-sm-3">
           		<label class="pull-right">Search by : </label>
           		</div>
                <div class="col-sm-7">
                  	<select class="form-control" id="searchInput">
                  	<option> -- Please Choose --</option>
                  	  <option value="Faculty">Faculty</option>
                  	  <option value="Course">Course</option>
                      <option value="Negeri">State</option>
                      <option value="Jantina">Gender</option>
                  	  <option value="work">Working Status</option>
                  	</select>
                </div>
            </div>
            <br>
            <div  id="yearlist">
            <br>
            <div class="row" id="nmaFact" style="display:none">
            <div class="form-group">
                <div class="col-sm-4">
                <label class="pull-right">Faculty: </label>
                </div>
                 <div class="col-sm-6">
                    <select class="form-control" id="FactNameChoosen" name="FactNameChoosen">
                    <option> -- Please Choose --</option>
                    <?php
                      foreach($faculty as $fact)
                      {
                    ?>
                        <option value="<?=$fact['inst_id']?>"><?=ucwords(strtolower($fact['inst_name']))?></option>
                    <?php
                      }
                    ?>
                    </select>
                 </div>
             </div>
             </div>
            <br>
            <div class="row" id="from" style="display:none">
            <div class="form-group">
            		<div class="col-sm-4">
            		<label class="pull-right">Year: </label>
            		</div>
                 <div class="col-sm-4">
                  <?php
                      $currentYear = date('Y',time()) - 1;
                      //$range = ($currentYear - 2005);

                    ?>
                  <select class="form-control" id="yearFrom">
                  <option value="">--Please Choose--</option>
                  option
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
             <div class="row">
               <div class="col-sm-12">
                 <div class="col-sm-3">
                 </div>
                   <div id="alertbox" class="col-sm-6">
                     
                   </div>
               </div>
             </div>
             <div class="row" id="to" style="display:none">
             <div class="form-group">
             		<div class="col-sm-4">
             		<label class="pull-right">to: </label>
             		</div>
                  <div class="col-sm-4">
                    	<?php
                          $currentYear = date('Y',time()) - 1;
                          //$range = ($currentYear - 2005);

                        ?>
                      <select class="form-control" id="yearTo">
                      <option id="validateYear" value="0">--Please Choose--</option>
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
             </div>
          </div>
          <br>
          <br>
        <div class="row">
           	<div class="form-group">
           		<center>
           			<button type="button" id="searchReport" class="btn btn-success">Search</button>
           		</center>
            </div>
          </div>
        <br>
    </div>
    <div id="graphReport" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <br>
    <div id="graphReportState" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <br>
    
    
   
</div>

