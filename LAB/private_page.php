<?php

session_start();
if(!isset($_SESSION['username']))
{
    header("Location:login.php");
}
?>

<html>
 <head>
  <title>Private page</title>
  <script src="jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="validate.js"></script>
  <script type="text/javascript" src="apikey.js"></script>
  <link rel="stylesheet" type="text/css" href="validate.css">
  <!--Bootstrap file-->
  <!--js-->
  <script type="text/javascript" src="bootsrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="bootsrap/js/bootstrap.min.js"></script>


  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
  <link rel="stylesheet" type="text/css" href="bootstrapp/css/bootstrap-theme.css.map">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">

  </head>
  <body>
  <p>This is a private page</p>
  <p>We want to protect it</p>
  <p><a href="logout.php">Logout</a></p>
  <hr>
  <h3>Here,we will create an API that will allow Users/Developers to order items from external systems</h3>
  <hr>
  <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

  <button class="btn btn-primary" id="api-key-btn">Genereate API key</button><br><br>
  <!---This text area will hold the API key--->
  <strong>Your API Key:</strong>(Note that if your API key is already in use y already in use by already running applications,generating a new key will stop the application from functioning)<br>
  <textarea cols="100" row="2" id="api_key" name="api_key" readonly><?php echo fetchUserApiKey();?></textarea>

  <h3>Service description:</h3>
  We have a service/API that allows external applications to order food and also pull all order status by using order status by using order id. Let's do it.
  <hr>

  </body>
  </html>

  <?php
  include_once 'DBConnector.php';
  if($_SERVER['REQUEST_METHOD'] !=='POST')
  {
      //We don't allow users to visit this page via url
      header('HTTP/1.0 403 Forbidden');
      echo 'You are forbidden!';
  }
  else{
      $api_key=null;
      $api_key=generateApiKey(64);/*We generate a key 64 characters long*/
      header('Content-type: application/json');
      /*our response if a json one*/
      echo generateResponse($api_key);
  }
  /*this is how we generate a key. But you can device your own method the parameter str_lenght determines the length of the key you want. In our case we have chosen 64 characters.*/
  function generateApiKey($str_length)
  {
      //base 62 map
      $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    //get enough random bits for base 64 encoding(and prevent '=' padding)
    //not:+1 is faster than ceil()
    $bytes=openssl_random_pseudo_bytes(3*$str_length/4+1);
    //convert base 64 to base 62 by mapping + and / to sth from the base 62 map
    $repl=unpack('C2',$bytes);
    $first=$chars[$repl[1]%62];
    $second=$chars[$repl[2]%62];
    return strtr(substr(base64_encode($bytes),0,$str_length),'+/',"$first$second");
  }

  function saveApiKey()
  {

  }

  function generateResponse($api_key)
  {
      if(saveApiKey())

    {
      $res=['success'=>1,'message'=>$api_key];
    }
    else{
        $res=['success'=>0,'message'=>'Something went wrong please regenerate API key'];
    }
    return json_encode($res);
  }
  ?>
<?php
  include_once 'DBconnector.php';
  session_start();
  
  if(!isset($_SESSION['username']))
  {
   header("Location: login.php");
  }

  function fetchUserApiKey()
  {
   
	$dbcon = new DBconnector();
	$user = $_SESSION['username'];
	$myquery = mysqli_query($dbcon->conn, "SELECT * FROM users WHERE username='$user'");
	$user_array = mysqli_fetch_assoc($myquery);
	$uid = $user_array['id'];
	$good = mysqli_query($dbcon->conn, "SELECT * FROM api_keys WHERE user_id = '$uid' ORDER BY `api_keys`.`id` DESC") or die(mysqli_error($dbcon->conn));
  $key =  mysqli_fetch_assoc($good);
  
	return $key['api_key'];

  }
?>

<html>

    <head>
       <title>IAP-Lab 1</title>
       <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
       <script type="text/javascript" src="validate.js"></script>
       <link rel="stylesheet" type="text/css" href="validate.css">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="apikey.js"></script>


    </head>

    <body>
        <p align='right'><a href="logout.php">Logout</a></p>
        <hr>
      
        <button class="btn btn-primary" id="api-key-btn">Generate APi key</button> <br> <br>

        <strong>Your API key:</strong><br>

        <textarea name="api_key" id="api_key" cols="100" rows="2" readonly> <?php echo fetchUserApiKey(); ?> </textarea>
        <hr>

    </body>

</html>