<?php

session_start();  

$name = $email = $createpassword = $confirmpassword = $usertype = "";
$namerror = $emailerror = $passworderror = $passnotmatch = "";

if(isset($_POST["register"])){


    if(empty($_POST["name"])) {     
        $namerror = " Empty  name";      
       
    }
    elseif(empty($_POST["email"])){
        $emailerror = " Empty  Email";  
    }
    elseif (empty($_POST["createpassword"])){
        $passworderror = "incomplete Empty password";
    }

    elseif(empty($_POST["confirmpassword"])){
        $passworderror = "incomplete Empty password";
    }
    elseif(!empty($_POST["name"]) &&  !empty($_POST["email"]) &&  !empty($_POST["createpassword"]) && !empty($_POST["confirmpassword"])){
       

        if($_POST["createpassword"] == $_POST["confirmpassword"]){

        $name =   $_POST["name"];
        $email = $_POST["email"];
        $createpassword =  $_POST["createpassword"];
        $confirmpassword =   $_POST["confirmpassword"];
        $usertype = $_POST["usertype"];

        
        $_SESSION['name']= $name;
        $_SESSION['email']= $email;
        $_SESSION['createpassword']= $createpassword;
        $_SESSION['confirmpassword']= $confirmpassword;
        $_SESSION['usertype']= $usertype;

        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "catbadb";
        $con = "";


        $con = mysqli_connect($server, $username, $password, $db_name);

      
        $quary = "INSERT INTO catba (names,email, createpassword, confirmpassword, usertype)VALUE('$name','$email', '$createpassword', '$confirmpassword',  '$usertype')";
        $quary_run = mysqli_query($con, $quary);

        if($quary_run){
            header("location: loginForm.php");
        }
        else{
            echo"Not Register Not inserted to database";
        }
      
        }
        else{
            $passnotmatch = " password not same";
        }

       }
       
      
      
      
    
   
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
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
            width: 410px;
            height: 720px;
            border: 1px solid black;
            margin-top: 90px;
            border-radius: 20px;
            box-shadow: 10px 19px 10px;
             background-color: rgb(226, 240, 243);
      } 

     
        
        p{
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }
          #name{
            border-radius: 10px;
            padding: 5px;
            width: 240px;
        }
          #lastname{
            border-radius: 10px;
            padding: 5px;
            width: 240px;
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
         #confirmpasss{
            border-radius: 10px;
            padding: 5px;
            width: 240px;
            
         }
       .btn{
            margin-left: 20px;
            width: 200px;
            background-color: rgb(46, 14, 206);
            color: white;
            margin-top: 10px;
        }
        .btn:hover{
            background-color: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
        }
        label{
          margin-top: 10px;
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
        select{
          padding: 5px;
          border-radius: 10px;
          margin-left: 10px;
          margin-bottom: 10px;
        }
        option{
          border-radius: 10px;
        }
    </style>

</head>

<body>

   <div class="flex">

     <div class="form-container">
      <img src="/Images/logo.jpg" alt="logo">
        <h6>Sign Up</h6>

        <form action="signup.php" method="post">

        <label for="name">Name</label> <br>
        <input class="border border-2 border-black" type="text" name="name" id="name" placeholder="Enter Your Name" required>    <br>

         <label for="lastname">Last Name</label> <br>
        <input class="border border-2 border-black" type="text" name="lastname" id="lastname" placeholder="Enter Your Last Name" required>    <br>


        <label for="email">Username</label> <br>
        <input class="border border-2 border-black" type="email" name="email" id="email" placeholder="Enter Email" required>

        <br>

        <label for="pass">Password</label> <br>
        <input class="border border-2 border-black" type="password" name="pass" id="pass" placeholder="Enter Password" required>

        <br>

        <label for="confirmpass">Confirm Password</label> <br>
        <input class="border border-2 border-black" type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" required> <br> <br>  


          <label>User Type:
            <select name="usertype" required>
                <option value="1">Admin</option>
                <option value="0">User</option>
            </select>
      
        <br>
  
        <button class="btn-create">Create Account</button>
        

         <p>Already have an account? <a href="logn.html"> Click Login!</p></a>
            </form>
     </div>
     </div>


</body>
    <script src="script.js"></script>
</html>