<?php

require_once('db_connect.php');

function get_post_info(){
// Retrieves all posts from the database and returns them as an array.
// If the re is no response from the database, returns false and echoes
// out the error message.

	global $db_connection;

	// Define our MySQL query
	$query = 'SELECT * FROM posts';

	// Make a query Store our response from the database
	$response = @mysqli_query($db_connection, $query);

	// If we get a response from our databse
	if($response){
		$posts = array();

		while($post = mysqli_fetch_array($response)){
			array_push($posts, $post);
		};

		mysqli_close($db_connection);
		return $posts;

	// If we don't get a response
	} else {
		echo 'Could not connect to database<br />' .
		     mysqli_error($db_connection);
		return false;
	};
};


function get_post(){
// Retrieves the post details using the given post ID in the GET array.
// If the re is no response from the database, returns false and echoes
// out the error message.

	global $db_connection;
	$postID = $_GET["post_id"];

	// Define our MySQL query
	$query = 'SELECT * FROM posts WHERE post_id = ' . $postID . ' limit 1';

	// Make a query and store the response from the database
	$response = @mysqli_query($db_connection, $query);

	// If we get a response from our databse return post details in an array
	if($response){
		$post = mysqli_fetch_array($response);
		mysqli_close($db_connection);
		return $post;

	// If we don't get a response return false
	} else {
		echo 'Could not connect to database<br />' .
		     mysqli_error($db_connection);
		return false;
	};
};

?>