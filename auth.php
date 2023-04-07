<!-- Authentication -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <title>Sign in to Blueddit</title>
  <?php session_start(); ?>

  <!-- Bootstrap core CSS -->
  <link href="res/bootstrap/bootstrap.min.css" rel="stylesheet" />

  <!-- Favicons -->
  <link rel="icon" href="res/favicon/Logo.svg" sizes="32x32" type="image/svg" />

  <!-- Custom styles for this template -->
  <link href="res/css/auth.css" rel="stylesheet" />
</head>


<body>
  <?php

  //Check if user just registered
  if (isset($_SESSION['registered']) && $_SESSION['registered'] == true) {
    unset($_SESSION['registered']);
    echo "<script>window.addEventListener(\"DOMContentLoaded\", (event) => {alert('Account successfully created.');});</script>";
  }

  ?>
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="res/img/banner.svg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post" action="login.php">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h2 fw-bold mb-0">Welcome to Blueddit</span>
                  </div>

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h6 text-muted">The frontpage of everything.</span>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Email address</label>
                    <input type="email" id="user" name="user" class="form-control form-control-lg" required />
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

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-circle" type="submit">
                      <span class="fs-4">&rarr;</span>
                    </button>
                  </div>
                  </form>
                  
                  <!-- for visitors login -->
                  <div class="mb-4">
                    <form method="POST" action="login.php">
                      <input type="hidden" name="user" value="guest@example.com">
                      <input type="hidden" name="pass" value="guest">
                      <button class="btn btn-outline-dark btn-md" type="submit">
                        <span class="fs-5">Continute as a visitor</span>
                      </button>
                    </form>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2">Don't have an account? <a href="registration.php">Register here</a></p>

                  <!-- copy right -->
                  <a class="small text-muted" href="#!">© 2023 Blueddit, Inc.</a>
          

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>