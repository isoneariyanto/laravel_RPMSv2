$(document).ready(function(){
	// User Manage Search Function
	$('#heartbeatSrcButton').on('keyup',function(){
		$('#data').load('/heartbeatCensor/search?value=' + $('#srcUsrMng').val());
		//console.log("hai");
	});
	
});