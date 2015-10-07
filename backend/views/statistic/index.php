<?php

$this->title = 'Statistic Alumni';
$this->params['breadcrumbs'][] = $this->title;

print_r($userpoint);
?>
    <style>
         #map-canvas,#map-canvas2 {
        width: 	900px;
        height: 400px;
        border-style: solid;
        border-width: medium;
      }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
    var usrPoint = <?=$userpoint?>;
   // console.log(usrPoint);
    function initialize() {

        var userdata =  usrPoint;//$.parseJSON(usrPoint);
    
        var iData = userdata.length;
        console.log(userdata);

        var finalpoint=[];
        var poscode = [];
        for (var i = 0; i < iData; i++)
         {
            var arrpointer = $.parseJSON(userdata[i].r_geo_point);
            poscode[i] = userdata[i].r_zipcode;

                finalpoint[i] = new google.maps.LatLng(arrpointer[0].lat, arrpointer[0].lon);
                                                   
          }
          //console.log(finalpoint);

      var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(2.791819, 108.991928),
        mapTypeId: google.maps.MapTypeId.roadmap
      };

      var map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);

      var image = {
        url: "img/icon3.svg",
        size: new google.maps.Size(15, 15),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 0),
        scaledSize: new google.maps.Size(8, 8),
      };
      var infowindow = new google.maps.InfoWindow();

        for (i = 0; i < finalpoint.length; i++) {
 
      marker = new google.maps.Marker({
      position:finalpoint[i],
      animation:google.maps.Animation.DROP,
      map: map,
      icon:image
    });

      google.maps.event.addListener(marker, 'click', (function(marker,i) {
        return function() {
            map.setZoom(14);
            map.setCenter(marker.getPosition());
        //keluarkan detail untuk setiap kawasan
   
                  infowindow.setContent("Poscode :"+poscode[i]+"");
              

                  infowindow.open(map, marker);

        }
      })(marker, i));
  }

    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <!-- Page Content -->
    <?php
   /* echo "<pre>";
    print_r($userpoint);
    echo "</pre>";*/
    ?>
<div class="site-index">
    <div class="content">
    <input type="hidden" id="urlPostYear" value="<?php echo \yii\helpers\Url::to(array('statistic/get-statisctic'))?>">
    <input type="hidden" id="urlGetDetail" value="<?php echo \yii\helpers\Url::to(array('statistic/get-student'))?>">
        <div class="row">
            <div class="col-xs-12">
            	 <?php
            	   $currentYear = date('Y',time()) - 1;
            	   $range = ($currentYear - 2005);

            	   ?>
            	<h3>Statistic of Alumni <?=$currentYear;?>&nbsp;&nbsp;
            	<button type="button" id="mapYear" class="btn btn-warning btn-xs"><i class="fa fa-plus"> Add Year</i></button>
            	</h3>
            </div>
        </div>
        <div class="row" id="selectYear" style="display:none">
            <div class="col-xs-12">
	            <div class="col-xs-3">
	            </div>
            	<div class="col-xs-2">
            		<select class="form-control" id="yearSelected">
            		<?php
            			for ($i=2005; $i < $currentYear ; $i++) { 

            		?>
            				<option value="<?=$i?>"><?=$i?></option>
            		<?php
            			}
            		?>
            		</select>
            	</div>
              <div class="col-xs-4">
                <select class="form-control" id="StateSelected">
                <option value="0"> - Seluruh Malaysia - </option>}
                option
                <?php
                  foreach($state as $key) { 

                ?>
                    <option value="<?=$key['s_id']?>"><?=$key['s_name']?></option>
                <?php
                  }
                ?>
                </select>
              </div>
            	<div class="col-xs-2">
            		<button type="button" id="chooseYear" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button>
            	</div>
            </div>
        </div>
        <br>
        <div class="row">
        <div>
              <div id="map-canvas"></div>
              <div>
                
              </div>
        </div>
        </div>
        <br>
        <hr>
        <div id="map2">
          
        </div>
        <br>
        <div class="col-xs-12">
        <div class="col-xs-6" id="table1">
          <h3>Detail of Alumni , <?=$currentYear;?></h3>
          <table class="table table-bordered" id="studentDetailCurrent">
            <thead>
              <tr class="danger">
                <th><center>Name</center></th>
                <th><center>Company</center></th>
                <th><center>#</center></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
         
          <div class="col-xs-6" id="table2" style="display:none">
          <input type="hidden" id="urlRedirect" value="<?php echo \yii\helpers\Url::to(array('user/view')).'&id='?>">
            <h3><span id="tbleTitle"></span></h3>
            <table class="table table-bordered" id="studentDetail">
              <thead>
                <tr class="danger">
                  <th><center>Name</center></th>
                  <th><center>Company</center></th>
                  <th><center>#</center></th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
        
        </div>
        

        <!-- /.row -->

        <hr>
<br>

    </div>
    </div>


