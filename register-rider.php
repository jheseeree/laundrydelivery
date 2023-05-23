<?php

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "laundry_delivery";

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

$registerSuccess = false;
$existingUser = false;
$existingEmail = false;
$existingContact = false;
$fieldsRequired = false;
$invalidUsername = false;
$invalidContact = false;
$invalidEmail = false;

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];

    if (empty($username) || empty($password) || empty($contact) || empty($email) || empty($fname) || empty($lname) || empty($address)) {
        echo "All fields are required.";
    } else {
        if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
            $invalidUsername = true;
        } elseif (!preg_match("/^[0-9]{10}$/", $contact)) {
            $invalidContact = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $invalidEmail = true;
        } else {
            // Check if the username already exists
            $checkUsernameQuery = "SELECT * FROM user WHERE username = '$username'";
            $checkUsernameResult = $conn->query($checkUsernameQuery);

            if ($checkUsernameResult->num_rows > 0) {
                $existingUser = true;
            } else {
                // Check if the email address already exists
                $checkEmailQuery = "SELECT * FROM user WHERE email = '$email'";
                $checkEmailResult = $conn->query($checkEmailQuery);

                if ($checkEmailResult->num_rows > 0) {
                    $existingEmail = true;
                } else {
                    // Check if the contact number already exists
                    $checkContactQuery = "SELECT * FROM user WHERE contact = '$contact'";
                    $checkContactResult = $conn->query($checkContactQuery);

                    if ($checkContactResult->num_rows > 0) {
                        $existingContact = true;
                    } else {
                        // Proceed with the registration
                        $insertQuery = "INSERT INTO user (role, username, password, contact, email, fname, lname, address) 
                                        VALUES ('rider', '$username', '$password', '$contact', '$email', '$fname', '$lname', '$address')";

                        if ($conn->query($insertQuery) === TRUE) {
                            $registerSuccess = true;
                            $_POST['username'] = null;
                            $_POST['password'] = null;
                            $_POST['contact'] = null;
                            $_POST['email'] = null;
                            $_POST['fname'] = null;
                            $_POST['lname'] = null;
                            $_POST['address'] = null;
                        } else {
                            echo "Error: " . $insertQuery . "<br>" . $conn->error;
                        }
                    }
                }
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>UWU Wash Delivery</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<img class="navbar-logo" src="assets/bLogo.png" alt="logo">

  <a class="navbar-brand font-weight-bold custom-green" href="index.php">UWU Wash Delivery</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item">
            <a href="register-rider.php" class="btn btn-sm rounded-pill bg-m-green text-light font-weight-bold px-3 py-1 mr-2">
                Are you a Rider?
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="register.php">Sign Up</a>
        </li>
    </ul>
  </div>
</nav>

<div class="position-relative overflow-hidden bg-light hero-background">
    <div class="hero-bg-trans p-3 p-md-5 h-100">
        <div class="h-100 d-flex flex-column align-items-end justify-content-center">
            <div class="card sign-up-card px-5 py-5"> 
                <?php
                    if($registerSuccess) { ?>
                        <div class="alert alert-success" role="alert">
                            Registration Success!
                        </div>
                    <?php }

                    if($existingUser) { ?>
                        <div class="alert alert-danger" role="alert">
                            Username already exists. Please choose a different username.
                        </div>
                    <?php }

                    if($existingEmail) { ?>
                        <div class="alert alert-danger" role="alert">
                            Email already exists. Please check your inbox for your credentials.
                        </div>
                    <?php }

                    if($existingContact) { ?>
                        <div class="alert alert-danger" role="alert">
                            Contact number already exists. Please check your email inbox for your credentials.
                        </div>
                    <?php }

                    if($fieldsRequired) { ?>
                        <div class="alert alert-danger" role="alert">
                            All fields are required.
                        </div>
                    <?php }

                    if($invalidUsername) { ?>
                        <div class="alert alert-danger" role="alert">
                            Username must be 3-20 characters long and can only contain letters, numbers, and underscores.
                        </div>
                    <?php }

                    if($invalidContact) { ?>
                        <div class="alert alert-danger" role="alert">
                            Contact must be a 10-digit number.
                        </div>
                    <?php }

                    if($invalidEmail) { ?>
                        <div class="alert alert-danger" role="alert">
                            Invalid email format.
                        </div>
                    <?php } ?>

                <div class="mb-1">
                    <!-- <h3 class="text-center mb-0">Join the UWUWash</h3> -->
                    <h3 class="text-center">Become a Rider</h3>
                    <!-- <h5 class="text-center">Faster transactions, better deals.</h5> -->
                </div>
                <form class="pt-3" method="POST">
                    <div class="form-group">    
                        <input type="username" class="form-control" name="username" placeholder="Username" pattern="^[a-zA-Z0-9_]{3,20}$" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
                    </div>
                    <div class="form-group">    
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">    
                        <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>" required>
                    </div>
                    <div class="form-group">    
                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>" required>
                    </div>
                    <div class="form-group">    
                        <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                    </div>
                    <div class="form-group">    
                        <input type="text" class="form-control" name="contact" placeholder="Contact Number" pattern="^[0-9]{10}$" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>" required>
                    </div>
                    <div class="form-group">    
                        <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required>
                    </div>
                    <div class="d-flex flex-column align-items-center mt-3">
                        <button type="submit" name="submit" class="btn btn-lg bg-m-green text-light font-weight-bold px-4 py-2 rounded-pill">
                            Sign Up
                        </button>
                    </div>
                </form>
                <div class="d-flex flex-column align-items-center py-3">
                    <span>Already part of the team?</span>
                    <span><a href="login.php"><u>Sign in</u></a> here</span>
                </div>
                <div class="d-flex flex-column align-items-center mt-3">
                    <small>By signing up, you agree to the</small>
                    <small><u>Terms of Service</u> and <u>Privacy Policy</u></small>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>