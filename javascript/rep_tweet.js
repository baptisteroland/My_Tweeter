$(document).ready(function(){

	$('#repTweet').hide();
	$('#comment').on("click", function(){
		$('#repTweet').slideToggle();
	});
});