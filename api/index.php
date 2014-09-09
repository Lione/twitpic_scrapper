

<!-- Form to collect screen_Name !-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
	<link href="css/style.css" rel="stylesheet"/>
    

       <title>TwitPic Scrapper</title>
</head>
<body>
       <div id="header">
		<div>
			
			<div id="navigation">
				<div>
					<ul>
					<li class="current"><a href="index.php">Home</a></li>
						<li><a href="about.php">About us</a></li>
						<li><a href="testPicture.php">User-Photos</a></li>
						<li><a href="gallery.php">Gallery</a></li>
						
					</ul>
				</div>
				
			</div>
			
			
		</div>
		</div>
		
	
			
			<div>
				
				<div id="connect">

  <center>
                <h3> Check if user is registered on Twitpic/Twitter</h3><br/>

 
  <form action="index.php" method="post">
 <center> <h2>Twitpic/Twitter screen_name</h2><br/><input type"text" required="required" name="screenName" size="50"></input><br/><br/>
  <input type="submit" name="submit" value="Get Pics" size="50"> </input></center><br/><br/>
  
  <p>Please be patient for validation and photo check after submitting</p>
  </form>
</center>
</div>
</div>


<div id="contact">
<?php

/*
get username
fetch image list for username
save list of short_id per user

*/
//collect username from form
if(!empty($_POST)){




			$username = $_POST['screenName'];
		
             $date=date('y-m-d');
     
      //check if user is SignedUp or not
      // call twitpic api and fetch all user details in json format
      $url="http://api.twitpic.com/2/users/show.json?username=$username";
            //  Initiate curl
      $ch = curl_init();
      // Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false its print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
      // Execute
      $jsonResult=curl_exec($ch);
      // Closing
      curl_close($ch);
	  // Will dump a beauty and converted to an array

      $jsonResponseArray =json_decode($jsonResult, true);
	   if(isset($jsonResponseArray['errors'])){
                
                  //determine whether request was successful or not
                   echo "Sorry, you need to sign up on Twitpic/Twitter";
				   
				   //if brace
                }
				
				
				 //check if user has images
                else if(!isset($jsonResponseArray['images'])){
                     echo "No images in array";
                     die();
				//else brace	 
                }
				
					else
					{
					       //save to users db and obtain primary key
							  include('database.php');
							   $pdo = Database::connect();
			
								  //search username
							   $sql= "SELECT * FROM user WHERE user='".$username."'"; 
							   $stmt = $pdo->prepare($sql);
							   $stmt->execute();
							   $total = $stmt->rowCount();
							   
							   if($total>0){
                      					//if user exists get image details
										//handle images
                          				$imagesArray = $jsonResponseArray['images'];
										for($i=0;$i<count($imagesArray);$i++){
                                        //get short id,get userid,date created,file type
										
												if (isset($imagesArray[$i]['short_id'])&& isset($imagesArray[$i]['user_id'])&& isset($imagesArray[$i]['timestamp'])){
												
												
												$shortID=$imagesArray[$i]['short_id'];
                                                $userID=$imagesArray[$i]['user_id'];
                                                $imageType=$imagesArray[$i]['type'];
                                                    //set date format
												$dateCreated=date($imagesArray[$i]['timestamp']);
												$dateCreated=date("y-m-d");
												$dateFormated=date("y-m-d");
												 //save details (shortID, userID) to userImageDetails table
                     
								  $pdo = Database::connect();
								  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								  $sql = "INSERT INTO userImageDetails (id,shortID,userID,imageType,dateCreated,dateModified,userName) values(?,?,?, ?,?,?,?)";
								  $q = $pdo->prepare($sql);
								  $q->execute(array(" ",$shortID,$userID,$imageType,$dateCreated,$dateFormated,$username));
								  Database::disconnect();


									//download to images folder	  
                                  set_time_limit(0);
								  $img_file = file_get_contents("http://twitpic.com/show/large/$shortID");
							      file_put_contents("images/$shortID.jpg", $img_file);
                                             
												
												
												//if within for brace
												}
									//response
									echo "<center><h3>Awesome! $username is an active member!!<br/></h3></center>";
									echo '<center><h3><a href="gallery.php">Get pictures belonging to '.$username.'</a></h3></center>';
										//for brace
										}
										
					                  //total brace
					                 }
							  else 
							  {
							   
							    
										 //handle images
										 $imagesArray = $jsonResponseArray['images'];
										 //loop through the images object in the array (has multiple image details)
                  							for($i=0;$i<count($imagesArray);$i++){
														 //get short id,get userid,date created,file type
                         if (isset($imagesArray[$i]['short_id'])&& isset($imagesArray[$i]['user_id'])&& isset($imagesArray[$i]['timestamp'])){
						 
									  		$shortID=$imagesArray[$i]['short_id'];
											$userID=$imagesArray[$i]['user_id'];
											$imageType=$imagesArray[$i]['type'];
                                            //set date format
										   $dateCreated=date($imagesArray[$i]['timestamp']);
										   $dateCreated=date("y-m-d");
										   $dateFormated=date("y-m-d");
											//save details (shortID, userID) to userImageDetails table
                     
            								$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sql = "INSERT INTO userImageDetails (id,shortID,userID,imageType,dateCreated,dateModified,userName) values(?,?,?,?,?,?,?)";
											$q = $pdo->prepare($sql);
											$q->execute(array(" ",$shortID,$userID,$imageType,$dateCreated,$dateFormated,$username));
											
											
											
								            //download to images folder	  
                                  set_time_limit(0);
								  $img_file = file_get_contents("http://twitpic.com/show/large/$shortID");
							      file_put_contents("images/$shortID.jpg", $img_file);
										
										
												//if loop within for
												 }
										//response
									echo "<center><h3>Awesome! $username is an active member!!<br/></h3></center>";
									echo '<center><h3><a href="gallery.php">Get pictures belonging to '.$username.'</a></h3></center>';
									 
											//for brace
											}
											
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$sql = "INSERT INTO user (id,user,userID,dateSaved) values(?,?, ?, ?)";
										$q = $pdo->prepare($sql);
										$q->execute(array(" ",$username,$userID,$date));
										Database::disconnect();
							  //else if total
							  }
							   
							   
					//else brace
					}

//first if
}

?>
</div>


<div id="footer">
<div>
<center><p>Beta Twitpic Scrapper -Alushula Lione</p></center>
</div>
</div>
</body>


</html>


