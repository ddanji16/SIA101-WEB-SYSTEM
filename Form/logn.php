<?php
session_start();

$email = $password = "";
$emailerror = $passerror = "";
$emailnotregister = $passnotregister = $invalid = "";



if(isset($_POST["login"])){

    $useremail = $_POST["email"];
    $userpassword = $_POST["password"];

    if(empty($useremail)){
        $emailerror = "Empty Email";
    }
    elseif(empty($userpassword)){
        $passerror = "Empty password";
    }
    elseif(empty($_SESSION["email"])){
        $emailnotregister =  "No email register";
    }
    elseif (empty($_SESSION["createpassword"])){
        $passnotregister = "no password register";
    }

    elseif($useremail ==  $_SESSION["email"] && $userpassword  == $_SESSION["createpassword"]) {
      
         if($_SESSION["usertype"] == 0){
            header("location: index.php");
        }
         elseif($_SESSION["usertype"] == 1){
            header("location: ./adminFolder/dashboard.php");
    }
  }
else{
    $invalid = "Username invalid ";
}

}



?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="bootstrap/bootstrap-5.3.8-dist/css/bootstrap.min.css">

    <style>
          body{
            background-image: url("/Images/bg.jpg");
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
      .flex{
            display: flex;
            justify-content: center;
        }

      .form-container{
            
            justify-items: center;
            width: 400px;
            height: 600px;
            border: 1px solid black;
            margin-top: 100px;
            border-radius: 20px;
            box-shadow: 10px 19px 10px;
            background-color: rgb(226, 240, 243);
      } 

        h6{
            margin-top: 10px;
            margin-bottom: 20px;
        }
        p{
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }
            
         #email{
            border-radius: 10px;
            padding: 5px;  
            width: 240px;
        }
        
         #pass{
            border-radius: 10px;
            padding: 5px;
            width: 240px;
     
        }
        .btn{
            margin-left: 20px;
            width: 200px;
            background-color: rgb(43, 60, 155);
            color: white;
        }
        .btn:hover{
            background-color: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
        }
        img{
            width: 120px;
            height: 100px;
            border: 1px solid black;
            border-radius: 100px;
            margin-left: 140px;
            margin-top: 20px;
            margin-bottom: 20px;
           
        }

    </style>

</head>

<body class="">

  <div class="flex">

     <div class="form-container">
         <img src="/Images/logo.jpg" alt="logo">
        <h6>Integrated School Management System</h6>
        <form action="">

        <label for="email">Email</label> <br>
        <input class="border border-2 border-black" type="email" name="email" id="email" placeholder="Enter Email" required>

        <br>

        <label for="pass">Password</label> <br>
        <input class="border border-2 border-black" type="password" name="pass" id="pass" placeholder="Enter Password" required>

       <br><br>

        <button class="btn">Login</button>
        

         <p>Don't have an account? <a href="signup.html">Sign Up!</p></a>
            </form>
     </div>
     </div>


</body>
    <script src="script.js"></script>
</html>