

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-image: url('bg1.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-attachment: fixed;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-links {
            margin-top: 10px;
        }
        .form-links a {
            text-decoration: none;
            color: #007bff;
        }
        .logo{
            display:block;
            align-items: center;
            margin-left: 65px;
        }
    </style>
</head>
<body>
<div class="login-container">
<?php
    $email = $password = "";
    $emailErr = $passwordErr = "";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(empty($_POST["email"])){
            $emailErr = "Email is required";
        } else {
            $email = $_POST["email"];
        }

        if(empty($_POST["password"])){
            $passwordErr = "Password is required";
        } else {
            $password = $_POST["password"];
        }

        if($email && $password){
            include("connect.php");
            $check_email = mysqli_query($connect, "SELECT * FROM login_tbl WHERE email = '$email'");
            $check_email_row = mysqli_num_rows($check_email);
            if($check_email_row > 0){
                while($row = mysqli_fetch_assoc($check_email)){
                    $db_password = $row["password"];
                    $db_account_type = $row["account_type"];
                    if($db_password === $password){
                        if($db_account_type == "1"){
                            echo "<script src='sweetalert2.all.min.js'></script>";
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login Successful!',
                                        text: 'Logging in as Admin...',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(() => {
                                        window.location.href = 'admin';
                                    });
                                  </script>";
                        } else {
                            echo "<script src='sweetalert2.all.min.js'></script>";
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login Successful!',
                                        text: 'Logging in as User...',
                                        showConfirmButton: false,
                                        timer: 3000
                                    }).then(() => {
                                        window.location.href = 'user';
                                    });
                                  </script>";
                        }
                    } else {
                        $passwordErr = "Password is incorrect";
                    }
                }
            } else {
                $emailErr = "Email is not registered";
            }
        }
    }
?>
<img src="bomba.png" height="150" class="logo">
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control">
            <span class="text-danger"><?php echo $emailErr; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control">
            <span class="text-danger"><?php echo $passwordErr; ?></span>
        </div> 
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary btn-block">
        </div>
    </form>
    <div class="form-links text-center">
        <a href="register.php">No account yet? Register</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="bootstrap.bundle.min.js"></script> 
</body>
</html>
