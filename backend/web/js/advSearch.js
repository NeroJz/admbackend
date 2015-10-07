$(document).ready(function()
{

	$("#advFaculty").on("change",function()
	{
		var fact_id = $(this).val();
		var url = $("#advurlgetFact").val();
		//location.reload();
		//$('#fact_name').removeAttr('disabled');
		//console.log(url);
		$.ajax({
			url: url,
			datatype:"JSON",
			type:'POST',
			data: {fact_id:fact_id},
			success:function(data)
			{
				//console.log(data);
				//location.reload();
				$('#advCourse').empty();
				
					if(data.length > 0 )
				  {
				  	
				  	//$('#fact_name').removeAttr('disabled');
				  	var content = "<option value='0'>All Course </option>";
				    	$(data).each(function(index)
				    	{
				    		content += '<option value='+data[index].course_id+'>'+data[index].course_name+'</option>';
				    	});
				    	$('#advCourse').append(content);
				   }
				
			}
		});

	});

	/*$("#searchadv").on("click", function()
	{
		var postData = $("#advancedForm").serialize();
		//console.log(test);
		var url = $("#getAdvancedReport").val();
		//alert(url);

		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: {fact_id:postData},
			success:function(data)
			{
				
				
			}
		});

	});*/
	
	//$("#tble_search").DataTable();
	//$.fn.dataTableExt.oStdClasses.sPageButton = "button";
		$("#tble_search").DataTable({
			"aoColumnDefs": [{ bSortable: false, aTargets: [0] }],
			"bPaginate": true,
			"bFilter": true,
			"bAutoWidth": true,
			//"bInfo": true,
			"aaSorting": [[ 1, 'asc' ]],
				"oLanguage": { 
					"sLengthMenu": 	'Display <select>'+
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
					
					$('#tble_search_length').addClass("pull-right");
});

 function viewAdvancedStudentDetail(pi_id)
   {
   		//alert("test");
   		var url = $('#urlAdvancedRedirect').val()+pi_id;
   		window.location = url;
   }