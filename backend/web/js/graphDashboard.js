 $(function () {

 /*var ImportData= [];
 for (var i = 0; i < xAxis.length; i++) {
    var CurrentImportData = {};
    CurrentImportData.name = xAxis[i];

    
    CurrentImportData.data = datayear1;
    ImportData.push(CurrentImportData);
 }*/
    var year = [ $("#year_1").val(), $("#year_2").val(),$("#year_3").val(),
                $("#year_4").val(),$("#year_5").val()];

    var year1 = $("#year_1").val();
    var year2 = $("#year_2").val();
    var year3 = $("#year_3").val();
    var year4 = $("#year_4").val();
    var year5 = $("#year_5").val();
    
    var ImportData= [];

    for (var i = 1; i < 6;i++) {
       var CurrentImportData = {};
       CurrentImportData.name = $("#code_"+i).val();
       var data1 = parseInt($("#data"+year1+i).val());
       var data2 = parseInt($("#data"+year2+i).val());
       var data3 = parseInt($("#data"+year3+i).val());
       var data4 = parseInt($("#data"+year4+i).val());
       var data5 = parseInt($("#data"+year5+i).val());
       CurrentImportData.data = [data1,data2,data3,data4,data5];
       ImportData.push(CurrentImportData);
    }


     $('#container').highcharts({
         title: {
             text: 'Total of Alumni',
             x: -20 //center
         },
         subtitle: {
             text: 'Based on faculty',
             x: -20
         },
         xAxis: {
             categories: year
         },
         yAxis: {
             title: {
                 text: 'Total'
             },
             plotLines: [{
                 value: 0,
                 width: 1,
                 color: '#808080'
             }]
         },
         tooltip: {
             valueSuffix: ''
         },
         legend: {
             layout: 'vertical',
             align: 'right',
             verticalAlign: 'middle',
             borderWidth: 0
         },
         series: ImportData
     });

 	$("#list_alumni").dataTable({
 		"aoColumnDefs": [{ bSortable: false, aTargets: [0] } ],
 		"bPaginate": true,
 		"bFilter": true,
 		"bAutoWidth": true,
 		"bInfo": true,
 		//"aaSorting": [[ 1, 'asc' ]],
 		"oLanguage": { 
 			"sLengthMenu": 	'Display <select>'+
           					'<option value="10">10</option>'+
           					'<option value="25">25</option>'+
           					'<option value="50">50</option>'+
           					'<option value="100">100</option>'+
           					'</select> records',
           	"sZeroRecords": "No Record found!",
             "sEmptyTable": "No Record found!",
             "sInfo": "Display _START_ to _END_ from _TOTAL_ records",
             "sInfoEmpty": "Display 0 to 0 from 0 records",
             "sInfoFiltered": " ",
             "sInfoPostFix": "",
             "sSearch": "Search : "
         },

 	});

 $('#list_alumni_length').addClass("pull-left");

 });

 