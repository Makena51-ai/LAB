<html>
   <?php

   include_once 'user.php';

   if(isset($_POST['btn-save']))
   {
       $first_name=$_POST['first_name'];
       $last_name=$POST['last_name'];
       $city=$_POST['city_name'];
     

       $user=new User($first_name,$last_name,$city);
       $res= $user->save();

       if($res)
       {
           echo"Save operation was successful";
       }
       else
       {
           echo "An error occured!";
       }

   }
   
 ?>
   
   
   <head>
        <title>Lab One</title>
    </head>
    <body>
        <center>
        <form action="lab1.php" method="POST">
        <input type="text" name="first_name" placeholder="First Name" required/><br/><br>
                <input type="text" name="last_name" placeholder="Last Name" required/><br/><br>
                <input type="text" name="city_name" placeholder="City" required/><br/><br>
                <button type="submit" name="btn-save">SAVE</button>
            </form>
        </center>
    </body>
</html>
