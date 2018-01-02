$("document").ready(function(){
	$("#car_number").change(function(){
		
		$.ajax({
			type: "POST",
			url: "http://localhost/bus_booking/server/car_availability.php",
			data: {'carNum': $(this).val()},
			dataType: "json",
			success: function(res){
				if(res.success == 1){
					$("#already-booked-slots").html(res.output);
					$(".booked-infos").removeClass("hidden");
				}else{
					$(".booked-infos").addClass("hidden");
				}
			},
			error: function(){
				alert("Errors occurd");
			}
		});
	});
});