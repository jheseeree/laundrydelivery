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
                <div class="mb-1">
                    <h3 class="text-center">Login as Rider</h3>
                </div>
                <form class="pt-3" action="">
                    <div class="form-group">    
                        <input type="username" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">    
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="d-flex flex-column align-items-center mt-3">
                        <button class="btn btn-lg bg-m-green text-light font-weight-bold px-4 py-2 rounded-pill">
                            Sign Up
                        </button>
                    </div>
                </form>
                <div class="d-flex flex-column align-items-center py-3">
                    <span>Want to be part of the team?</span>
                    <span><a href="register-rider.php"><u>Sign Up</u></a> here</span>
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