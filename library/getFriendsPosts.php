<?php
	include './opendb.php';
	session_start();

	$currID = $_SESSION['curr_id'];

	$db_socket = initSocket();

	$query = "select * from ".$configValue['DB_FRIENDS_LIST']." where id_A ='".$currID."'";
	$statement = $db_socket->prepare($query);
	$statement->execute();

	$allPosts = array();
	$arrayCols = $statement->fetchAll();
	for($i = 0; $i < count($arrayCols); $i++)
	{
		//now we get the friends
		$friendID = $arrayCols[$i][1];

		$friend_query = "SELECT * from ".$configValue['DB_POST_TABLE']." WHERE userid ='".$friendID."'";
		$friend_statement = $db_socket->prepare($friend_query);
		$friend_statement->execute();

		//we got friend posts now
		//concat them into an array
		//with the id
		//assumption that the post message 
		$posts = $friend_statement->fetchAll();
	
		//add everything in posts to array
		//NEED TO QUERY FRIEND NAME TOO
		for($j = 0; $j < count($posts); $j++)
		{
			$allPosts[] = array();
			$allPosts[$j][0] = $friendID;
			$allPosts[$j][1] = $posts[$j][2];
			$allPosts[$j][2] = $posts[$j][3];
			
		}		
	
	}
	echo json_encode($allPosts);
	
	include './closedb.php';
?>
