<?php
header("Content-Type:application/json");
include('functions.php');
//process client request


if(!empty($_GET['name']))
{

   $name=$_GET['name'];
   $userID=get_ScreenName($name);
   
   //if user id not found
   if(empty($userID))
   {
     deliver_response(200,"No image found", null);
   
   }
   
   else
   {
   
       deliver_response(200,"Images found", $userID.".jpg");
   }
   
   /*
   //get shortID from imageUserDetails then loop to echo photos
   $pdo = Database::connect();
   $sqlID= "SELECT * FROM userimagedetails";
   global $stringIDarray;
   foreach($pdo->query($sqlID) as $row)
		{
		
		  $stringIDarray=array($row['userID'] =>$row['shortID']);
		
		}
		
		foreach($stringIDarray as $myID =>$setID)
		{
		    $path="\"api/images/".$setID.".jpg\"";
		    // echo '<img src="images/'.$setID.'.jpg"/>';
			echo '<img src="images/ebbekp.jpg"/>';
		}
   
   Database::disconnect();*/
   
}


else

{
//throw invalid request

}


//delivery resonse for json
function deliver_response($status, $statusMessage,$data)
{
       header("HTTP/1.1 $status $statusMessage $data");
	   
	   $response ['status']=$status;
	   $response['statusMessage']=$statusMessage;
	   $response['data']=$data;
	   
	   $json_response=json_encode($response);
	   
	   echo  $json_response;
}

?>
