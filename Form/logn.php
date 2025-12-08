<?php
session_start();
include_once("../Database/connection.php");

$email = $password = "";
$emailerror = $passerror = "";
$emailnotregister = $passnotregister = $invalid = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $useremail = trim($_POST['email'] ?? '');
    $userpassword = $_POST['password'] ?? '';


    if ($useremail === '') {
        $emailerror = 'Empty Email';
    }

    if ($userpassword === '') {
        $passerror = 'Empty password';
    }

  
    if (empty($emailerror) && empty($passerror)) {
        $stmt = mysqli_prepare($con, 'SELECT id, names, lastname, email, pass, usertype FROM dbschool WHERE email = ? LIMIT 1');
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $useremail);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $row = $res ? mysqli_fetch_assoc($res) : null;
            mysqli_stmt_close($stmt);

          
            if (!$row) {
                $emailnotregister = 'No user registered';
            } else {
                $dbPass = $row['pass'];
                $dbUserType = (int)$row['usertype'];

                // support hashed and plain passwords: try password_verify first
                $passwordMatches = false;
                if (password_verify($userpassword, $dbPass)) {
                    $passwordMatches = true;
                } elseif ($userpassword === $dbPass) {
                    $passwordMatches = true;
                }

                if ($passwordMatches) {
                    // set session and redirect
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['names'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['usertype'] = $dbUserType;

                    if ($dbUserType === 0) {
                        header('Location: ../Home.php');
                        exit();
                    } else {
                        header('Location: ../admin/index.php');
                        exit();
                    }
                } else {
                    $invalid = 'Username or password invalid';
                }
            }
        } else {
            $emailnotregister = 'Database error: unable to check credentials.';
        }
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
         <img src="../Images/logo.jpg" alt="logo">
        <h6>Integrated School Management System</h6>
        <form action="logn.php" method="post">

        <label for="email">Email</label> <br>
        <input class="border border-2 border-black" type="email" name="email" id="email" value="<?=htmlspecialchars($useremail ?? '')?>" placeholder="Enter Email">
        <br><span class="err" style="color:#b02a37"><?=htmlspecialchars($emailerror ?? '')?></span>

        <br>

        <label for="pass">Password</label> <br>
        <input class="border border-2 border-black" type="password" name="password" id="pass" placeholder="Enter Password">
        <br><span class="err" style="color:#b02a37"><?=htmlspecialchars($passerror ?? '')?></span>

       <br>

        <?php if (!empty($emailnotregister)): ?>
            <div style="margin-bottom:10px;color:#b02a37"><?=htmlspecialchars($emailnotregister)?></div>
        <?php endif; ?>
        <?php if (!empty($invalid)): ?>
            <div style="margin-bottom:10px;color:#b02a37"><?=htmlspecialchars($invalid)?></div>
        <?php endif; ?>

        <button class="btn" type="submit" name="login">Login</button>
        

         <p>Don't have an account? <a href="signup.php">Sign Up!</a></p>
            </form>
     </div>
     </div>


</body>
    <script src="script.js"></script>
</html>