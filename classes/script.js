function getBalanceLicence(val){
		$.ajax({
			type: "POST",
			url: "get_balance_licence.php",
			data: 'num_lic='+val,
			sucess: function(data){
				$("#balance_fob").html(data);
			}
		});
	}
