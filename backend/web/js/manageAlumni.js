$(document).ready(function()
{

/*	$("#save_update").on("click",function()
 {
 	$.ajax({
 		url:'<?= \yii\helpers\Url::to(array('user/saveupdate')) ?>',
 		datatype:"html",
 		type:'POST',
 		data: $('#active-form').serialize(),
 		success:function(data)
 		{
 			
 			
 		}
 	});
 });*/

	$('#updateAlumni').on("click",function()
		{
		    $("#saveAlumni").removeAttr("style");
		    //$("#updateAlumni").attr("style='display:none'");
		    $('#updateAlumni').css('display','none');
		    $('#fullname').removeAttr("readonly");
		    $('#permanentaddress').removeAttr("readonly");
		    $('#permanentzipcode').removeAttr("readonly");
		    $('#address').removeAttr("readonly");
		    $('#zipcode').removeAttr("readonly");
		    $('#icno').removeAttr("readonly");
		    $('#gender1').removeAttr("disabled");
		    $('#gender2').removeAttr("disabled");
		    $('#phone').removeAttr("readonly");
		    $('#handphone').removeAttr("readonly");
		    $('#email_1').removeAttr("readonly");
		    $('#email_2').removeAttr("readonly");
		    $('#username').removeAttr("readonly");
		    $('#userstatus').removeAttr("readonly");
		    $('#updateat').removeAttr("readonly");

		});

	$('#saveAlumni').on('click', function()
	{
		//location.reload();
		var newdata = $("#updateAlumniForm").serialize();
		var url = $("#url").val();

		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: newdata,
			success:function(data)
			{
				location.reload();
				
			}
		});
	});

	$('#saveWorkingRecord').on('click', function()
	{
		//location.reload();
		//var newdata = $("#regWorking").serialize();
		var url = $("#urlWorking").val();
		//console.log(newdata);
		var serviceto="current";
		var to = $("#service_to").val();
		var userID = $("#userID").val();
		var workingstatus = $("#working_status").val();
		var companyname = $("#company_name").val();
		var position = $("#company_position").val();
		var start = $("#service_start").val();

		    if($('input[type="checkbox"]').prop("checked") != true){
		             //   alert("Checkbox is checked.");
		           // serviceTo = "current";
		            serviceto = to;
		    }
		   
		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: {userID:userID,workingstatus:workingstatus,companyname:companyname,position:position,start:start, serviceto:serviceto },
			success:function(data)
			{
				location.reload();
				
			}
		});
	});

	$('#saveEducationRecord').on('click', function()
	{
		//location.reload();
		//var newdata = $("#regWorking").serialize();
		var url = $("#urlEducationEdit").val();
		//console.log(newdata);
		var form = $("#EditEducationForm").serialize();
		  
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

	$('#saveNewEducationRecord').on('click', function()
	{
		//location.reload();
		//var newdata = $("#regWorking").serialize();
		var url = $("#urlEducation").val();
		//console.log(newdata);
		var form = $("#NewEducationForm").serialize();
		  
		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: form,
			success:function(data)
			{
				//location.reload();
				
			}
		});
	});

	$("#update_fact_name, #fact_name").on("change",function()
	{
		var factID = $(this).val();
		var url = $("#urlEducationCourse").val();
		//alert(factID);
		$.ajax({
			url: url,
			datatype:"html",
			type:'POST',
			data: {factID:factID},
			success:function(data)
			{
				console.log(data);
				$("#update_course_name,#course_name").empty();
				$("#update_course_name").removeAttr('disabled','false');
				$("#course_name").removeAttr('disabled','false');
				$(data).each(function(index)
				{
		
					$("#update_course_name,#course_name").append("<option value='"+data[index].course_id+"' >"+data[index].course_name.toUpperCase()+"</option>");
					
				});
				
			}
		});
	});

	$('#myEditEducation').on('hidden.bs.modal', function () {
	 location.reload();
	})
	
});

function EditEducation(id)
{
	var viewURL = $('#urlview').val();
	
	$.ajax({
		url: viewURL,
		datatype:"html",
		type:'POST',
		data: {userID:id },
		success:function(data)
		{
			$(data).each(function(index)
			{
				$("#update_uni_name").val(data[index].uni_name.toUpperCase());
				$("#update_fact_name_selected").val(data[index].inst_id);
				$("#update_fact_name_selected").html(data[index].inst_name.toUpperCase());
				$("#update_course_name").append("<option value='"+data[index].course_id+"' >"+data[index].course_name.toUpperCase()+"</option>");
				$("#update_level").val(data[index].el_id);
				$("#update_level_selected").html(data[index].el_name.toUpperCase());
				$("#update_year").val(data[index].ei_graduation_year);
				$("#id").val(data[index].id);
			});
			
		}
	});
}

//getUserEducation