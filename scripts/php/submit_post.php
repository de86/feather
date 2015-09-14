<?php 

require_once($_SERVER["DOCUMENT_ROOT"]."feather/scripts/php/functions.php");


if(isset($_POST["post_title"]) && isset($_POST["post_content"])){
	global $db_connection;
	$post_title = $_POST["post_title"];
	$post_content = $_POST["post_content"];

	echo "test\n";
	echo $post_title;
	echo $post_content;

	$query = "INSERT INTO posts VALUES (
			  '$post_title' ,
			  NOW(),
			  '$post_content' ,
			  'path/to/image',
			  '$post_content',
			  null,
			  1);";

	$response = @mysqli_query($db_connection, $query);

	if($response){
		mysqli_close($db_connection);
		print('success');
		return true;
	} else {
		echo 'Could not save post to database<br />' .
		     mysqli_error($db_connection);
		return false;
	};
} else {

};

?>