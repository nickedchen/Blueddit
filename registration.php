<!-- Authentication -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <title>Blueddit Registration</title>
  <?php session_start(); ?>

  <!-- Bootstrap core CSS -->
  <link href="res/bootstrap/bootstrap.min.css" rel="stylesheet" />

  <!-- Favicons -->
  <link rel="icon" href="res/favicon/Logo.svg" sizes="32x32" type="image/svg" />

  <!-- Custom styles for this template -->
  <link href="res/css/auth.css" rel="stylesheet" />
  <script src="res/js/auth.js"></script>
</head>


<body>
  <?php
    if (isset($_SESSION['registered']) && $_SESSION['registered'] == false) {
      unset($_SESSION['registered']);
      echo "<script>window.addEventListener(\"DOMContentLoaded\", (event) => {alert('Account could not be created.');});</script>";
    }
    if (isset($_SESSION['emailIssue']) && $_SESSION['emailIssue'] == true) {
      unset($_SESSION['emailIssue']);
      echo "<script>window.addEventListener(\"DOMContentLoaded\", (event) => {alert('Email already in use.');});</script>";
    }
    if (isset($_SESSION['userIssue']) && $_SESSION['userIssue'] == true) {
      unset($_SESSION['userIssue']);
      echo "<script>window.addEventListener(\"DOMContentLoaded\", (event) => {alert('Username already in use.');});</script>";
    }
  ?>
  <section class="vh-full">
    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form method="post" action="registrationProcess.php" id="regis-form">

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h2 fw-bold mb-0">Register for Blueddit</span>
                    </div>

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h5 text-muted">We're glad you could make it</span>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example17">Email address</label>
                      <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                      <div class="invalid-feedback">
                        Please provide a valid email address.
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example17">Username</label>
                      <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                      <div class="invalid-feedback">
                        Please provide a valid email address.
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example27">Password</label>
                      <input type="password" id="pass" name="pass" class="form-control form-control-lg" required />
                      <div class="invalid-feedback">
                        Please provide a valid password.
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example27">Confirm Password</label>
                      <input type="password" id="pass2" name="pass2" class="form-control form-control-lg" required />
                      <div class="invalid-feedback">
                        Please provide a valid password.
                      </div>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-circle" type="submit">
                        <span class="fs-4">&rarr;</span>
                      </button>
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2">Already have an account? <a href="auth.php">Sign in here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>