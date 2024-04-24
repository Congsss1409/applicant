<?php
$fullname = $email = $password = $cpassword = "";
$fullnameErr = $emailErr = $passwordErr = $cpasswordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullname"])) {
        $fullnameErr = "Fullname is required";
    } else {
        $fullname = ($_POST["fullname"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = ($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = ($_POST["password"]);
    }

    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required";
    } else {
        $cpassword = ($_POST["cpassword"]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .registration-container {
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
    </style>
</head>
<body>
<div class="registration-container">
    <h2 class="text-center mb-4">Registration</h2>
    <form method="POST" action="<?php htmlspecialchars("PHP_SELF");?>">
        <div class="form-group">
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo $fullname; ?>" >
            <span class="text-danger"><?php echo $fullnameErr; ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" >
            <span class="text-danger"><?php echo $emailErr; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" >
            <span class="text-danger"><?php echo $passwordErr; ?></span>
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" id="cpassword" name="cpassword" class="form-control" >
            <span class="text-danger"><?php echo $cpasswordErr; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Register" class="btn btn-primary btn-block">
        </div>
    </form>
    <div class="form-links text-center">
        <a href="index.php">Already have an account? Login</a>
    </div>
</div>
<script src="bootstrap.bundle.min.js"></script>
</body>
</html>

