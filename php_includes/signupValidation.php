<?php
  error_reporting(E_ALL);
  ini_set( 'display_errors','1');
	   
  if(isset($_SESSION['username'])){
    header("location: index.php");
  }
 
  global $fnameErr, $lnameErr, $emailErr, $email2Err, $unameErr, $pwErr, $top5Err;
  $fname = $lname = $email = $game1 = $game2 = $game3 = $game4 = $game5 = $year = $major = $uname = "";

  $emailval = '/^[A-Za-z0-9._%-]+@ku\.edu/';  

  if(isset($_POST['signupsubmit'])) {
    if (!empty($_POST)){
       $err = false;
       $year = $_POST['year'];
       $major = $_POST['major'];
       
       if(empty($_POST['fname'])) {
	 $fnameErr = "*required";
	 $err = true;
       }
       else {
	 $fname = $_POST['fname'];
       }

       if(empty($_POST['lname'])) {
         $lnameErr = "*required";
	 $err = true;
       }
       else {
         $lname = $_POST['lname'];
       }
	
       if($_POST['pw'] != $_POST['pw2']) {
	 $pwErr = "*passwords don't match";
	 $err = true;
       }
       
       if(empty($_POST['email'])) {
	 $emailErr = "*required";
	 $err = true;
       }
       else {
         $email = $_POST['email'];
	 if(!preg_match($emailval, $_POST['email'])){
	   $emailErr = "*Please enter a valid ku email";
	   $err = true;
	 }
       }
       
       if(empty($_POST['pw'])) {
         $pwErr = "*required";
	 $err = true;
       }
       
       if(empty($_POST['username'])) {
	 $unameErr = "*required";
	 $err = true;
       }
       else {
         $uname = $_POST['username'];
       }
       
       if(empty($_POST['game1']) || empty($_POST['game2']) || empty($_POST['game3']) ||
				     empty($_POST['game4']) || empty($_POST['game5'])) {
	 $top5Err = "*required";
	 $err = true;
       }
       else {
         $game1 = $_POST['game1'];
	 $game2 = $_POST['game2'];
	 $game3 = $_POST['game3'];
	 $game4 = $_POST['game4'];
	 $game5 = $_POST['game5'];
       }
       
       if($_POST['email'] != $_POST['email2']) {
	 $email2Err = "*emails don't match";
	 $err = true;
       }
  }

  if ($err == false) {
    $x = "INSERT INTO Accounts (username, 
			        email, 
				password, 
				firstName, 
				lastName,
				game1, 
				game2, 
				game3, 
				game4, 
				game5, 
				major, 
				year)
											
	                VALUES ('$_POST[username]', 
				'$_POST[email]', 
				'$_POST[pw]',
				'$_POST[fname]',
				'$_POST[lname]',
				'$_POST[game1]',
				'$_POST[game2]',
				'$_POST[game3]',
				'$_POST[game4]',
				'$_POST[game5]',
				'$_POST[major]',
				'$_POST[year]')";
							  
    if(!mysqli_query($c, $x)) {
      die('Error: ' . mysqli_error($c));
    }
	
    $_SESSION['username'] = $_POST['username'];			
    mysqli_close($c);
    $url = "./success.html";
    header("Location: $url");
 }
}

?>