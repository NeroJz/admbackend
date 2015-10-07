$(document).ready(function()
{
	$("#mapYear").on("click",function()
	{
		$("#selectYear").removeAttr("style");

	});

    $("#studentDetail").DataTable({
      "aoColumnDefs": [{ bSortable: false, aTargets: [0] }],
      "bPaginate": true,
      "bFilter": true,
      "bAutoWidth": true,
      "bInfo": true,
      "aaSorting": [[ 1, 'asc' ]],
        "oLanguage": { 
          "sLengthMenu":  'Display <select>'+
                            '<option value="10">10</option>'+
                            '<option value="25">25</option>'+
                            '<option value="50">50</option>'+
                            '<option value="100">100</option>'+
                            '</select> record',
                    "sZeroRecords": "No Record!",
                    "sEmptyTable": "No Record!",
                    "sInfo": "display _START_ from _END_ to _TOTAL_ records",
                    "sInfoEmpty": "display 0 to 0 from 0 record",
                    "sInfoFiltered": " ",
                    "sInfoPostFix": "",
                    "sSearch": "Search: "
                },
             /*    "dom": 'lf<"clear">Trtip',
                 "tableTools": {
                          "sSwfPath": "<?=base_url()?>assets/swf/copy_csv_xls_pdf.swf",
                          "aButtons": [ { "sExtends": "xls", "sButtonText": "Excel", "sFileName": "test.xls" },
                                { "sExtends": "pdf", "sButtonText": "Pdf","sFileName": "test.pdf" }, { "sExtends": "print", "sButtonText": "Print" } ] 
                        },
              "tableTools": $tabletools_options,*/
            "fnDrawCallback": function ( oSettings ) {
              if ( oSettings.bSorted || oSettings.bFiltered )
              {
                for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                {
                  $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                }
              }
            }
          });
          
          $('#studentDetail_length').addClass("pull-right");

          $("#studentDetailCurrent").DataTable({
            "aoColumnDefs": [{ bSortable: false, aTargets: [0] }],
            "bPaginate": true,
            "bFilter": true,
            "bAutoWidth": true,
            "bInfo": true,
            "aaSorting": [[ 1, 'asc' ]],
              "oLanguage": { 
                "sLengthMenu":  'Display <select>'+
                                  '<option value="10">10</option>'+
                                  '<option value="25">25</option>'+
                                  '<option value="50">50</option>'+
                                  '<option value="100">100</option>'+
                                  '</select> record',
                          "sZeroRecords": "No Record!",
                          "sEmptyTable": "No Record!",
                          "sInfo": "display _START_ from _END_ to _TOTAL_ records",
                          "sInfoEmpty": "display 0 to 0 from 0 record",
                          "sInfoFiltered": " ",
                          "sInfoPostFix": "",
                          "sSearch": "Search: "
                      },
                   /*    "dom": 'lf<"clear">Trtip',
                       "tableTools": {
                                "sSwfPath": "<?=base_url()?>assets/swf/copy_csv_xls_pdf.swf",
                                "aButtons": [ { "sExtends": "xls", "sButtonText": "Excel", "sFileName": "test.xls" },
                                      { "sExtends": "pdf", "sButtonText": "Pdf","sFileName": "test.pdf" }, { "sExtends": "print", "sButtonText": "Print" } ] 
                              },
                    "tableTools": $tabletools_options,*/
                  "fnDrawCallback": function ( oSettings ) {
                    if ( oSettings.bSorted || oSettings.bFiltered )
                    {
                      for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                      {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                      }
                    }
                  }
                });
                
                $('#studentDetailCurrent_length').addClass("pull-right");

	$("#chooseYear").on("click",function()
	{
		$("#map2").empty();
		var url = $("#urlPostYear").val();
		$("#selectYear").css("display","none");
		var content = "<div class='row'>"+
					  "<div class='col-xs-12'>"+
					  "<h3>Statistic of Alumni "+$("#yearSelected").val()+"</h3>"+
					  "</div>"+
					  "</div"+
					  "<div class='row'>"+
					  "<div class='col-md-12'>"+
					  "<div id='map-canvas2'></div>"+
					  "</div></div>";
		$("#map2").append(content);

		$.ajax({
			url: url,
			datatype:"JSON",
			type:'POST',
			data: {year:$("#yearSelected").val(), negeri:$("#StateSelected").val()},
			success:function(data)
			{
				//location.reload();
				
				var jData = $.parseJSON(data);
				//console.log(jData);
				//$('#fact_name').empty();
				/*$(data).each(function(){
					console.log(data['userpointarray']);
				});*/
				
				//console.log(jData['centerPoint'][0].r_geo_point);
				var finalmappointer = new google.maps.LatLng(2.791819, 108.991928);
				var zoomvalue = 0;
				if(jData['centerPoint'] != 0)
				{
					var mappointer = $.parseJSON(jData['centerPoint'][0].r_geo_point);
					finalmappointer = new google.maps.LatLng(mappointer[0].lat, mappointer[0].lon);
					zoomvalue = parseInt(jData['centerPoint'][0].s_zoom_level);
				}

					if(jData['userpointarray'].length > 0 )
				  {

					  	var finalpoint=[];
					  	var poscode = [];
					  	var reg_name = [];
					  	var totalStu = [];
					  	var choosenyear = $("#yearSelected").val();
				    	$(jData['userpointarray']).each(function(index)
				    	{
				    		var arrpointer = $.parseJSON(jData['userpointarray'][index].r_geo_point);
				    		poscode[index] = jData['userpointarray'][index].r_zipcode;
				    		reg_name[index] = jData['userpointarray'][index].r_name;
				    		totalStu[index] = jData['userpointarray'][index].totalstudent;
				    		/*if(jData[index].totalstudent == 1)
				    		{*/
				    		    finalpoint[index] = new google.maps.LatLng(arrpointer[0].lat, arrpointer[0].lon);
				    		/*}
				    		else
				    		{
				    		    for (var x = 1; x <= jData[index].totalstudent; x++) {

				    		        var latitude = parseFloat(arrpointer[0].lat) + 0.00005;
				    		        var longitude = parseFloat(arrpointer[0].lon) + 0.00005;
				    		       finalpoint[index] = new google.maps.LatLng(latitude, longitude);
				    		    }
				    		}*/
				    		//console.log(finalpoint);
				    	});

				    	initializemap(zoomvalue,finalmappointer,poscode,reg_name,totalStu,finalpoint,choosenyear);
				   }
				   else
				   {
				   		var finalpoint=[];
				   		var poscode = [];
				   		var reg_name = [];
				   		var totalStu = [];
				   		initializemap(zoomvalue,finalmappointer,poscode,reg_name,totalStu,finalpoint,choosenyear);
				   }
				  
			}
		});
	
		//

	});
});

function initializemap(zoomvalue,finalmappointer,poscode,reg_name,totalStu,finalpoint,choosenyear) {
      // Create the map.
      var zoomattr = 5;
      if(zoomvalue != 0)
      {
      	zoomattr = zoomvalue;
      }

      var mapOptions = {
        zoom: zoomattr,
        center: finalmappointer,
        mapTypeId: google.maps.MapTypeId.roadmap
      };

      var map = new google.maps.Map(document.getElementById('map-canvas2'),
          mapOptions);

          var image = {
            url: "img/icon3.svg",
            size: new google.maps.Size(10, 10),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(0, 0),
            scaledSize: new google.maps.Size(10, 10),
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
                map.setZoom(12);
                map.setCenter(marker.getPosition());
            //keluarkan detail untuk setiap kawasan
       
                      infowindow.setContent('<div class = "MarkerPopUp" style="width: 300px"><div class = "MarkerContext">'+
                      						"<table class='table table-bordered'>"+
                      							"<tr class='success'>"+
                      							"<td><b>Region Name </b></td>"+
                      							"<td>"+reg_name[i]+"</td>"+
                      							"</tr>"+
                      							"<tr>"+
                      							"<td><b>Region poscode</b></td>"+
                      							"<td>"+poscode[i]+"</td>"+
                      							"</tr>"+
                      							"<tr class='success'>"+
                      							"<td><b>Total Student</b></td>"+
                      							"<td>"+totalStu[i]+"</td>"+
                      							"</tr>"+
                      							//"Poscode :"+poscode[i]+"<button class='btn btn-success btn-xs'>gf</button>"
                      							"</table>"+
                      							"<button href='#table2' class='btn btn-success btn-xs pull-right' onclick='viewDetail("+poscode[i]+","+choosenyear+")''><a href='#table2' style='color:white'>View</a></button>"+
                      							'</div></div>');
                  								

                      infowindow.open(map, marker);

            }
          })(marker, i));
      }

    }

    function viewDetail(r_zipcode,year)
    {
    	//alert(year);
 
    	var zipcode = r_zipcode;
    	var newUrl = $("#urlGetDetail").val();

    	$.ajax({
    		url: newUrl,
    		datatype:"JSON",
    		type:'POST',
    		data: {zipcode:zipcode, year:year},
    		success:function(data)
    		{
    			$("#studentDetail > tbody").empty();
    			$("#tbleTitle").empty();
    			//console.log(data);//studentDetail
    			$("#table2").removeAttr("style");
    			$("#tbleTitle").append("Detail of Alumni, "+$("#yearSelected").val());
    			$(data).each(function(index){

            var work = "<center> - </center>";
            if(data[index].wi_company_name != null)
            {
              work = data[index].wi_company_name;
            }

    				var content = "<tr>"+
    							  "<td>"+data[index].pi_name+"</td>"+
    							  "<td>"+work+"</td>"+
    							  "<td><center><button class='btn btn-success btn-xs' onclick='viewStudentDetail("+data[index].pi_id+")''><i class='fa fa-search'></i></button></center></td>"+
    							  "</tr>";
    				$("#studentDetail > tbody").append(content);
    			});
    		}
    	});
    }

   // google.maps.event.addDomListener(window, 'load', initializemap);
   function viewStudentDetail(pi_id)
   {
   		var url = $('#urlRedirect').val()+pi_id;
   		window.location = url;
   }