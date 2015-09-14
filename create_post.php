<!DOCTYPE html>
<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'feather/scripts/php/functions.php'); 
	appendLog(true, "Navigated to create_post.php");
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<div class="container">
	<?php require_once('header.php'); ?>
		<form class="create-post" method="POST">
			<label for="title">Post Title:</label>
			<input type="text" id="post_title" name="title" />
			<label for="post_content">Post Content:</label>
			<textarea name="content" id="post_content" cols="30" rows="25"></textarea>
			<input type="submit" value="Save Post" id="submit_post" />
		</form>
	</div>

<?php
	includeJSScripts('scripts/js/jquery-2.1.4.min.js',
					 'scripts/js/post_submit.js');
?>
</body>
</html>