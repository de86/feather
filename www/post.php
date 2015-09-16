<?php 
	require_once($_SERVER["DOCUMENT_ROOT"].'feather/www/scripts/php/functions.php'); 
	appendLog(true, "Navigated to post.php");
	require_once("html_head.php");
?>
<body>
	
	<div class="container">
	<?php require_once('header.php'); ?>
	
			<?php

			$post = get_post();

			if($post){
				echo '<div class="post">' .
					 	'<h2> '. $post['title'] . '</h2>' .
				     	'<span class="publish-date">' . $post['publish_date'] . '</span>' .
				     	'<p class="post-content">' . $post['content'] . '</p>' .
				     '</div>';
			};

			?>
		</div>
	</div>

</body>
</html>

