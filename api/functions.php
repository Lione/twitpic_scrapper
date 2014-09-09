<?php

//include db
include('database.php');

//checks for name from the user database
function get_ScreenName($find)
{
 
    $pdo = Database::connect();
    $sql= "SELECT * FROM userimagedetails"; 

    global $nameArray;
		foreach($pdo->query($sql) as $row)
		{
		
		  $nameArray= array( $row['userName']=>$row['shortID']);
		
		}
		
		Database::disconnect();
   //get a return
   foreach($nameArray as $name =>$userID)
   {
       if($name==$find)
	   {
	     return $userID;
		 break;
	   
	   }
   }
}


?>