<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<div class="container">
	<?php require_once('header.php'); ?>
	
			<?php

			require_once('scripts/functions.php');
			$posts = get_post_info();

			if($posts){
				foreach($posts as $post){
					echo '<div class="post">' .
						 	'<h2><a href="post.php?post_id=' . $post['post_id'] . '">' . $post['title'] . '</a></h2>' .
					     	'<span class="publish-date">' . $post['publish_date'] . '</span>' .
					     	'<p class="post-content">' . $post['summary'] . '</p>' .
					     '</div>';
				};
			};
			
			?>
		</div>
	</div>

</body>
</html>

