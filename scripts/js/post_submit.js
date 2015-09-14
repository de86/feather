$(document).ready(function(){

	var $btnSubmit = $('#submit_post');
	var post_title = $('#post_title').val();
	var post_content = $('#post_content').val();

	$btnSubmit.on('click', function(){
		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: 'scripts/php/functions.php',
			data: {action: 'submit_post',
				   post_title :  $('#post_title').val(),
				   post_content : $('#post_content').val()},

			success: function(success){
						console.log(success);
					},

			error: function(successs){
						console.log(success);
					}
		});
	});
});