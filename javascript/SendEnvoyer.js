$(document).ready(function (){

	$('#msgsend').hide();

	$('#buttSend').on("click", function(){
		$('#msgsend').slideDown();
		$('#msgreceive').hide();
	});

	$('#buttReceive').on("click", function(){
		$('#msgreceive').slideDown();
		$('#msgsend').hide();
	});
});