<?php

include_once("../Database/connection.php");
session_start();  

$name = $lastname = $email = $pass = $confirmpass = $usertype = "";
$namerror = $lastnameerror =  $emailerror = $passworderror = $passnotmatch = "";
$dberror = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["btn-create"])) {


    $name = trim($_POST['name'] ?? '');

    $lastname = trim($_POST['lastname'] ?? '');

    $email = trim($_POST['email'] ?? '');

    $pass = $_POST['pass'] ?? '';

    $confirmpass = $_POST['confirmpass'] ?? '';

    $usertype = $_POST['usertype'] ?? '';

    $hasError = false;





    if ($name === '') {
        $namerror = 'Empty name';
        $hasError = true;
    }

    if ($lastname === '') {
        $lastnameerror = 'Empty last name';
        $hasError = true;
    }

    if ($email === '') {
        $emailerror = 'Empty email';
        $hasError = true;
    } 
    
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror = 'Invalid email format';
        $hasError = true;
    }

    if ($pass === '') {
        $passworderror = 'Empty password';
        $hasError = true;
    } 
    
    
    elseif (strlen($pass) < 4) {
        $passworderror = 'Password must be at least 4 characters';
        $hasError = true;
    }


    if ($confirmpass === '') {
        $passnotmatch = 'Confirm password is required';
        $hasError = true;
    }





    if (!$hasError) {
        if ($pass === $confirmpass) {
            $_SESSION['name'] = $name;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;
            $_SESSION['createpassword'] = $pass;
            $_SESSION['confirmpassword'] = $confirmpass;
            $_SESSION['usertype'] = $usertype;


            

            try {
                $stmt = mysqli_prepare($con, "INSERT INTO dbschool (names, lastname, email, pass, confirmpass, usertype) VALUES (?, ?, ?, ?, ?, ?)");
                if (!$stmt) {
                    throw new Exception('Prepare failed: ' . mysqli_error($con));
                }


                mysqli_stmt_bind_param($stmt, 'sssssi', $name, $lastname, $email, $pass, $confirmpass, $usertype);
                $ok = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($ok) {
                    header('Location: logn.php');
                    exit();
                } 

                else {
                    $dberror = 'Unable to register user. Please try again.';
                }
            } 
            
            

            catch (Exception $e) {
                $msg = $e->getMessage();
                $errno = mysqli_errno($con);

                if (stripos($msg, "doesn't exist") !== false || $errno === 1146) {
                    $createSql = "CREATE TABLE IF NOT EXISTS dbschool (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        names VARCHAR(191) NOT NULL,
                        lastname VARCHAR(191) NOT NULL,
                        email VARCHAR(255) NOT NULL UNIQUE,
                        pass VARCHAR(255) NOT NULL,
                        confirmpass VARCHAR(255) NOT NULL,
                        usertype TINYINT(1) NOT NULL DEFAULT 0,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";


                    try {
                        mysqli_query($con, $createSql);
                        $stmt = mysqli_prepare($con, "INSERT INTO dbschool (names, lastname, email, pass, confirmpass, usertype) VALUES (?, ?, ?, ?, ?, ?)");
                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, 'sssssi', $name, $lastname, $email, $pass, $confirmpass, $usertype);
                            $ok = mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            if ($ok) {
                                header('Location: logn.php');
                                exit();
                            } else {
                                $dberror = 'Unable to register user after creating table.';
                            }
                        } 
                        
                        else {
                            $dberror = 'Unable to prepare insert after creating table: ' . mysqli_error($con);
                        }

                    }
                     catch (Exception $ce) {
                        $dberror = 'Failed to create required table: ' . $ce->getMessage();
                    }

                } 
                else {
                  
                    $dberror = 'Database error: ' . htmlspecialchars($msg);
                }
            }
        } else {
            $passnotmatch = 'Passwords do not match';
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
         #confirmpass{
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
      <img src="../Images/logo.jpg" alt="logo">
        <h6>Sign Up</h6>
        <?php if (!empty($dberror)): ?>
            <div style="margin:10px 20px;padding:10px;border-radius:6px;background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;"> <?= htmlspecialchars($dberror) ?> </div>
        <?php endif; ?>


        <form action="signup.php" method="post">



        <label for="name">Name</label> <br>
        <input class="border border-2 border-black" type="text" name="name" id="name" value="<?=htmlspecialchars($name)?>" placeholder="Enter Your Name">  
         <span class="err"><?=htmlspecialchars($namerror)?></span><br>
       


         <label for="lastname">Last Name</label> <br>
        <input class="border border-2 border-black" type="text" name="lastname" id="lastname" value="<?=htmlspecialchars($lastname)?>" placeholder="Enter Your Last Name"> 
        <span class="err"><?=htmlspecialchars($lastnameerror)?></span>    <br>



        <label for="email">Username</label> <br>
        <input class="border border-2 border-black" type="email" name="email" id="email" value="<?=htmlspecialchars($email)?>" placeholder="Enter Email"> 
        <span class="err"><?=htmlspecialchars($emailerror)?></span><br>



        <label for="pass">Password</label> <br>
        <input class="border border-2 border-black" type="password" name="pass" id="pass" placeholder="Enter Password"> <br>
        <span class="err"><?=htmlspecialchars($passworderror)?></span>



        <label for="confirmpass">Confirm Password</label> <br>
        <input class="border border-2 border-black" type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password"> <br> 
        <span class="err"><?=htmlspecialchars($passnotmatch)?></span>

          <label>User Type:
            <select name="usertype" required>
                <option value="1">Admin</option>
                <option value="0">User</option>
            </select>
      
        <br>
  
        <button class="btn btn-create" type="submit" name="btn-create">Create Account</button>
        

         <p>Already have an account? <a href="logn.php"> Click Login!</a></p>
            </form>
     </div>
     </div>


</body>
    <script src="script.js"></script>
</html>