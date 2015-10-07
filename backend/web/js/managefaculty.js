$(document).ready(function()
{
	$(".addRow").on("click",function()
	{
		var tempId = $("#hideTempInt").val();
		$("#RegisterFaculty").append("<tr>"+
									 "<td><center>"+tempId+"</center></td>"+
									 "<td><input style='width:100%' type='text' name='fact_"+tempId+"' value='' placeholder=''></td>"+
									 "<td><input style='width:100%' type='text' name='factCode_"+tempId+"' value='' placeholder=''></td>"+
									// "<td><center><button type='button' class='btn btn-danger btn-xs'>Delete <i class='fa fa-minus-square'></i></button></center></td>"+
									 "</tr>"
									);
		tempId++;
		$("#hideTempInt").val(tempId);

	});

	//$("#saveFact")

	$('#saveFact').on('click', function()
	{
		//location.reload();
		var newdata = $("#regFact").serialize();
		var url = $("#urlfact").val();
		//console.log(url);
		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: newdata,
			success:function(data)
			{
				//location.reload();
				
			}
		});
	});
});