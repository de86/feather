<?php

require_once($_SERVER["DOCUMENT_ROOT"].'feather/db_connect.php');

// Table Of Contents:
//
// o function switch for ajax calls
// o appendLog()
// o get_post_info()
// o get_post()
// o submit_post()
// o includeJSScripts()


// Function switch allowing ajax calls to specific functions in this file.
// This switch checks the _POST array for a string that will represent the name
// of a function. This is then passed through a switch and the relevant function
// is executed if allowed.
// An error message is logged if no function exists or is not permitted to be run
if(isset($_POST['action']) && !empty($_POST['action'])) {
	$action = $_POST['action'];
	appendLog(true, $action. "() Function Requested from functions.php");

	switch($action) {
		case 'submit_post': 
			submit_post(); 
			break;
		default: 
			appendLog('Function ' . $action . ' does not exist');
			break; 
	};
};


function appendLog($success, $text){
// Takes a boolean and a string. Appends given string to the file php_log.txt. 
// If true is given as the first argument "[INFO]" is pre-fixed. If false is
// given "[ERROR]" is pre-fixed. If the file php_log.txt does not exist the
// file is created.

	$prefix = "";

	if($success){
		$prefix = "[INFO]";
	} else {
		$prefix ="[ERROR]";
	};

	$file = $_SERVER["DOCUMENT_ROOT"]."feather/php_log.txt";
	$time = date('m-d-y H:i:s');
	$textToLog = $prefix. "[" .$time. "] " .$text. ";\r\n"; 
	file_put_contents($file, $textToLog, FILE_APPEND | LOCK_EX);
};


function get_post_info(){
// Retrieves all posts from the database and returns them as an array.
// If there is no response from the database, returns false and logs
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
		appendLog(false, "Could not connect to database - " . mysqli_error($db_connection)); 
		return false;
	};
};



function get_post(){
// Retrieves the post details using the given post ID in the GET array.
// If there is no response from the database, returns false and logs
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
		appendLog(false, "Could not connect to database - " .
		     mysqli_error($db_connection));
		return false;
	};
};



function submit_post(){
// Inserts a new post into the database. logs result. Returns false if there
// is a problem.

	appendLog(true, "submitting post...");
	if((isset($_POST["post_title"]) && isset($_POST["post_content"])) &&
	   (!empty($_POST["post_title"]) && !empty($_POST["post_content"]))){

		global $db_connection;
		$post_title = $_POST["post_title"];
		$post_content = $_POST["post_content"];

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
			appendLog(true, "Post Created! Title: " .$post_title);
		} else {
			appendLog(false, "Could not save post to database - " .
			     mysqli_error($db_connection));
		};
	} else {
		appendLog(false, "title and content must not be empty");
	};

};


function includeJSScripts(){
// Takes paths to Javascript files as strings that you wish to include in the page
// and echoes out the html to link the scripts on the page.

	$scripts = func_get_args();
	foreach($scripts as $script){
		echo "<script rel=\"javascript\" src=\"" . $script . "\"></script>\n";
	};
};

?>