$(function () {
	// Age categories

	$('#searchInput').on("change",function()
	{
		if($(this).val() == "Course")
		{
			$("#nmaFact").removeAttr("style");
			$("#to").removeAttr("style");
			$("#from").removeAttr("style");
		}
		else if($(this).val() == "Negeri")
		{
			$("#nmaFact").css("display","none");
			$("#to").css("display","none");
			$("#from").css("display","none");
		}
		else if($(this).val() == "Jantina" || $(this).val() == "work")
		{
			//$("#to").removeAttr("style");
			$("#from").removeAttr("style");
			$("#nmaFact").css("display","none");

		}
		else
		{
			$("#to").removeAttr("style");
			$("#from").removeAttr("style");
			$("#nmaFact").css("display","none");
		}
	});

	$("#yearTo").on("change",function(){
		var startYear = $("#yearFrom").val();
		var endYear = $(this).val();

			if(endYear <= startYear)
			{	
				//$("#validateYear").css("selected",true);
				$(this).val("0");
				$("#alertbox").removeAttr("display","none");
				$("#alertbox").empty();
				$("#alertbox").append('<div class="alert alert-danger" role="alert"><center>Select Correct Year</center></div>');

			}
			else
			{
				$("#alertbox").css("display","none");
			}
		//validateYear

	});

	$("#searchReport").on("click",function()
	{
		//var newdata = $("#updateAlumniForm").serialize();
		var url = $("#advurlgetReport").val();
		var startYear = $("#yearFrom").val();
		var endyear = $("#yearTo").val();
		var range = parseInt(endyear - startYear);
		//alert(range);

		var year = [];
		for (var i = 0; i <= range; i++) {
			var addYear = parseInt(startYear)+i;
			year.push(addYear);
		}
		
		$.ajax({
			url: url,
			datatype:"JSON",
			type:'POST',
			data: {type:$('#searchInput').val(), fact_id:$("#FactNameChoosen").val(),start:startYear,end:endyear},
			success:function(data)
			{
					//alert(between);
					var xAxis = [];
					var yAxiscurrent = []; // array for current year state
					var yAxis = [];
					var factID = [];
					var datacontent = [];
					var ImportData= [];
					

					$(data).each(function(index)
					{
						if($('#searchInput').val() == 'Negeri')
						{
							console.log(data['rangeYear']);
							for (var i = 0; i < data['rangeYear'].length; i++) {
								var xAxisData = data['rangeYear'][i].s_name;
								var yAxiscurrentData = 0;
								yAxis[i] = data['rangeYear'][i].totalstudent;
								xAxis.push(xAxisData);
								//yAxis.push(yAxisData);
								if(data['currentYear'].length > 0)
								{
									yAxiscurrentData = data['currentYear'][i].totalstudent;
								}
								yAxiscurrent.push(yAxiscurrentData);
							}

							//xAxis[index] = data['rangeYear'][index].s_name;
							//yAxis[index] = data[index].totalstudent;
							//console.log(yAxis[index]);
						}
						else if($('#searchInput').val() == 'Course')
						{
							//xAxis[index] = data[index].course_code;
								
								var bil = 0;
									//xAxis = [];
								for (var i = 1; i <= data[1].size; i++) {
									//data[i]
									var xAxisData = data[i].courseCode;
									xAxis.push(xAxisData);
									var dataDetail = data[i].count;
									//console.log(dataDetail[0]["2007"]);
									//datacontent.push(dataDetail[0]);
									console.log(dataDetail[0]);
									var datayear = [];
									for (var x = 0; x < year.length; x++) {

											var content = "";
											if(dataDetail[0][year[x]] != undefined)
											{
												//alert(year[x]);
												//console.log(dataDetail[0][year[x]]);
												content = dataDetail[0][year[x]];

											}
											else
											{
												//console.log("xde data");
												content = 0;
											}
											//console.log(dataDetail[0][year[x]]);
											datayear.push(content);
										}

										//console.log(datayear);
										//for (var i = 0; i < xAxis.length; i++) {
											var CurrentImportData = {};
											CurrentImportData.name = xAxis[bil];

											
											CurrentImportData.data = datayear;
											ImportData.push(CurrentImportData);
										//}
										console.log(ImportData);
										bil++;

							}
						}
						else if($('#searchInput').val() == 'Faculty')
						{
							
							var bil = 0;

							for (var i = 1; i < 7; i++) {
								//data[i]
								var xAxisData = data[i].facultyCode;
								xAxis.push(xAxisData);
								var dataDetail = data[i].count;
								//console.log(dataDetail[0]["2007"]);
								//datacontent.push(dataDetail[0]);
								var datayear = [];
								for (var x = 0; x < year.length; x++) {

										var content = "";
										if(dataDetail[0][year[x]] != undefined)
										{
											//alert(year[x]);
											//console.log(dataDetail[0][year[x]]);
											content = dataDetail[0][year[x]];

										}
										else
										{
											//console.log("xde data");
											content = 0;
										}
										//console.log(dataDetail[0][year[x]]);
										datayear.push(content);
									}

									
									//for (var i = 0; i < xAxis.length; i++) {
										var CurrentImportData = {};
										CurrentImportData.name = xAxis[bil];

										
										CurrentImportData.data = datayear;
										ImportData.push(CurrentImportData);
									//}
									//console.log(ImportData);
									bil++;

						}

						}
						else if($('#searchInput').val() == 'Jantina')
						{
							

								var CurrentImportData = {};
								CurrentImportData.name = "";

								if(data[index].pi_gender == 1)
								{
									CurrentImportData.name = "Male";
								}
								else
								{
									CurrentImportData.name = "Female";
								}
								

								
								CurrentImportData.y = parseInt(data[index].totalstudent);
								ImportData.push(CurrentImportData);
							//}
							//console.log(ImportData);
						}
						else if($('#searchInput').val() == 'work')
						{
								var CurrentImportData = {};
								CurrentImportData.name = "";

								if(data[index].working_status == 0)
								{
									CurrentImportData.name = "Unemployed";
								}
								else if(data[index].working_status == 1)
								{
									CurrentImportData.name = "Further Study";
								}
								else
								{
									CurrentImportData.name = "Employed";
								}
								

								
								CurrentImportData.y = parseInt(data[index].totalstudent);
								ImportData.push(CurrentImportData);
							//}
							//console.log(ImportData);
						}
					
					});


					if($('#searchInput').val() == "Faculty" || $('#searchInput').val() == "Course")
					{
					//console.log(datayear);

					//console.log(ImportData);
					$('#graphReportState').empty();
					$('#graphReport').empty();
					$('#graphReport').highcharts({
					    chart: {
					        type: 'column'
					    },
					    title: {
					        text: 'Alumni Report'
					    },
					    subtitle: {
					        text: 'by '+$('#searchInput').val()+'.'
					    },
					    xAxis: {
					        categories: year,
					        crosshair: true
					    },
					    yAxis: {
					        min: 0,
					        title: {
					            text: 'total'
					        }
					    },
					    tooltip: {
					        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					                     '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
					        footerFormat: '</table>',
					        shared: true,
					        useHTML: true
					    },
					    plotOptions: {
					        column: {
					            pointPadding: 0.2,
					            borderWidth: 0,
					            dataLabels: {
					                enabled: true
					            }
					        }
					    },
					    series: ImportData
					});
					$("text:contains('Highcharts.com')").css("display","none");
				}
				else if($('#searchInput').val() == "Jantina")
				{
					
					//console.log(ImportData);
					$('#graphReportState').empty();
					$('#graphReport').empty();

					// Make monochrome colors and set them as default for all pies
					    Highcharts.getOptions().plotOptions.pie.colors = (function () {
					        var colors = [],
					            base = Highcharts.getOptions().colors[0],
					            i;

					        for (i = 0; i < 10; i += 1) {
					            // Start out with a darkened base color (negative brighten), and end
					            // up with a much brighter color
					            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
					        }
					        return colors;
					    }());

					    // Build the chart
					    $('#graphReport').highcharts({
					        chart: {
					            plotBackgroundColor: null,
					            plotBorderWidth: null,
					            plotShadow: false,
					            size: "50%",
					            type: 'pie'
					        },
					        title: {
					            text: 'Report of Alumni Based On Gender, '+$("#yearFrom").val()+' '
					        },
					        tooltip: {
					            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					        },
					        plotOptions: {
					            pie: {
					                allowPointSelect: true,
					                cursor: 'pointer',
					                dataLabels: {
					                    enabled: true,
					                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					                    style: {
					                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					                    }
					                }
					            }
					        },
					        series: [{
					            name: "Gender",
					            data: ImportData
					        }]
					    });
					$("text:contains('Highcharts.com')").css("display","none");
				}
				else if($('#searchInput').val() == "work")
				{
					
					$('#graphReportState').empty();
					$('#graphReport').empty();
					$('#graphReport').highcharts({
					    chart: {
					        plotBackgroundColor: null,
					        plotBorderWidth: null,
					        plotShadow: false,
					        type: 'pie'
					    },
					    title: {
					        text: 'Report Alumni Based On Working Status'
					    },
					    tooltip: {
					        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					    },
					    plotOptions: {
					        pie: {
					            allowPointSelect: true,
					            cursor: 'pointer',
					            dataLabels: {
					                enabled: false
					            },
					            showInLegend: true
					        }
					    },
					    series: [{
					        name: "Work Status",
					        data: ImportData
					    }]
					});
					$("text:contains('Highcharts.com')").css("display","none");
				}

				else if($('#searchInput').val() == "Negeri")
				{
					//console.log(yAxis[0]);
					
					var StateData = [];
					var currentStateData = [];
					for (var i = 0; i < xAxis.length; i++) {
						var addData = parseInt(yAxis[i]);
						var currentaddData = parseInt(yAxiscurrent[i]);
						StateData.push(addData);
						currentStateData.push(currentaddData);
					}
					//console.log(StateData);
				var currentYear = (new Date).getFullYear() - 1;
				var startYear = currentYear - 5;
				$('#graphReportState').empty();	
				$('#graphReport').empty();
		
			$('#graphReport').highcharts({
				    chart: {
				        type: 'column',
				    },
				    title: {
				        text: 'Report Alumni Based On State'
				    },
				    subtitle: {
				        text: 'for '+currentYear
				    },
				    xAxis: {
				        categories: xAxis,
				        title: {
				            text: null
				        }
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: 'Total',
				            align: 'high'
				        },
				        labels: {
				            overflow: 'justify'
				        }
				    },
				    plotOptions: {
				        bar: {
				            dataLabels: {
				                enabled: true
				            }
				        }
				    },
				    legend: {
				        layout: 'vertical',
				        align: 'right',
				        verticalAlign: 'top',
				        x: -40,
				        y: 80,
				        floating: true,
				        borderWidth: 1,
				        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				        shadow: false
				    },
				    series: [{
				        name: 'Total Student',
				        data: currentStateData,
				    }]
				});

				$('#graphReportState').highcharts({
				    chart: {
				        type: 'column',
				    },
				    title: {
				        text: 'Report Alumni Based On State'
				    },
				    subtitle: {
				        text: 'for '+startYear+ '-'+currentYear
				    },
				    xAxis: {
				        categories: xAxis,
				        title: {
				            text: null
				        }
				    },
				    yAxis: {
				        min: 0,
				        title: {
				            text: 'Total',
				            align: 'high'
				        },
				        labels: {
				            overflow: 'justify'
				        }
				    },
				    plotOptions: {
				        bar: {
				            dataLabels: {
				                enabled: true
				            }
				        }
				    },
				    legend: {
				        layout: 'vertical',
				        align: 'right',
				        verticalAlign: 'top',
				        x: -40,
				        y: 80,
				        floating: true,
				        borderWidth: 1,
				        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				        shadow: false
				    },
				    series: [{
				        name: 'Total Student',
				        data: StateData,
				    }]
				});
					$("text:contains('Highcharts.com')").css("display","none");
				}
				
			}//tutup success
		});//tutup ajax


	});

    
});