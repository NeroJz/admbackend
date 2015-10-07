$(document).ready(function()
{
	$(".addRowCourse").on("click",function()
	{
		var tempId = $("#hideTempIntCourse").val();
		$("#RegisterCourse").append("<tr>"+
									 "<td><center>"+tempId+"</center></td>"+
									 "<td><input style='width:100%' type='text' name='course_"+tempId+"' value='' placeholder=''></td>"+
									 "<td><input style='width:100%' type='text' name='courseCode_"+tempId+"' value='' placeholder=''></td>"+
									// "<td><center><button type='button' class='btn btn-danger btn-xs'>Delete <i class='fa fa-minus-square'></i></button></center></td>"+
									 "</tr>"
									);
		tempId++;
		$("#hideTempIntCourse").val(tempId);

	});

	

	$('#uni_select').on('change', function()
	{
		var uni_id = $(this).val();
		var url = $("#urlgetFact").val();
		//location.reload();
		//$('#fact_name').removeAttr('disabled');
		//console.log(url);
		$.ajax({
			url: url,
			datatype:"JSON",
			type:'POST',
			data: {uni_id:uni_id},
			success:function(data)
			{
				//location.reload();
				$('#fact_name').empty();
					if(data.length > 0 )
				  {
				  	
				  	$('#fact_name').removeAttr('disabled');
				  		var content = "";
				    	$(data).each(function(index)
				    	{
				    		content = '<option value='+data[index].inst_id+'>'+data[index].inst_name+'</option>';
				    		$('#fact_name').append(content);
				    	});
				   }
				   else
				   {
				   	 $('#fact_name').attr('disabled', 'disabled');
				   	 $('#fact_name').append('<option>No faculty register</option>');
				   }
				
			}
		});
	});

	$('#saveCourse').on('click', function()
	{
		var uni_id = $(this).val();
		var url = $("#urlsaveCourse").val();
		var form = $("#regCourse").serialize();
		//location.reload();
		//$('#fact_name').removeAttr('disabled');
		//console.log(url);
		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: form,
			success:function(data)
			{
				location.reload();
			}
		});
	});
});