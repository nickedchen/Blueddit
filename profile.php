<!-- Profile Settings -->

<!DOCTYPE html>
<html lang="en" class="home">

<head>
    <?php include 'include/head.php'; ?>
    <?php include 'include/login.php'; ?>
    <title>Profile Settings</title>
</head>

<body>

    <form action="profileProcess.php" method="POST">
        <!-- Navbar for profile -->
        <?php include 'include/backNavbar.php'; ?>

        <!-- Sidebar -->
        <?php include 'include/profileSidebar.php'; ?>

        <!-- Main Content -->
        <div class="col-md-5">

            <!-- Create form for user to edit their profile info -->

            <div id="profile-container">

                <h2 class="mb-4 text-dark mb-5">Account Settings</h2>
                <?php
                // Start the session and check for a logged-in user
                session_start();
                if (!isset($_SESSION['userid'])) {
                    header('Location: login.php');
                    exit();
                }

                // Get the user ID from the session variable
                $userid = $_SESSION['userid'];

                // Connect to the database and handle errors
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (mysqli_connect_errno()) {
                    $output = "<p>Unable to connect to the database: " . mysqli_connect_error() . "</p>";
                    exit($output);
                }

                // Get the user data from the database
                $sql = "SELECT username, email, password, about, country, totalUpvotes, isadmin, profilepath FROM users WHERE userid = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $userid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $username, $email, $password, $about, $country, $totalUpvotes, $isadmin, $profilepath);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                // Create an array of user data
                $user = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'about' => $about,
                    'country' => $country,
                    'totalUpvotes' => $totalUpvotes,
                    'isadmin' => $isadmin,
                    'profilepath' => $profilepath
                );

                // Close the database connection
                mysqli_close($conn);
                ?>

                <!-- Create form for user to edit their profile info -->

                <div class="mb-3 pb-2">
                    <label for="profile" class="form-label h6 text-dark pb-2">Display Name</label>
                    <input type="text" class="form-control border-2" id="profile" name="username"
                        value="<?php echo $user['username'] ?>" />
                </div>

                <div class="mb-3 pb-2">
                    <label for="about" class="form-label h6 text-dark pb-2">About me</label>
                    <textarea class="form-control border-2" id="about" name="about"
                        rows="3"><?php echo htmlspecialchars($user['about'], ENT_QUOTES); ?></textarea>
                </div>

                <div class="mb-3 pb-2">
                    <label for="email" class="form-label h6 text-dark pb-2">Email</label>
                    <input type="email" class="form-control border-2" id="email" name="email"
                        placeholder="<?php echo $user['email']; ?>" value="<?php echo $user['email']; ?>" />
                </div>

                <div class="mb-3 pb-2">
                    <label for="password" class="form-label h6 text-dark pb-2">Password</label>
                    <input type="password" class="form-control border-2" id="password" name="password"
                        placeholder="***" />
                </div>

                <!-- Country -->

                <div class="mb-3 pb-2">
                    <label for="country" class="form-label h6 text-dark pb-2">Country</label>
                    <select class="form-select w-50 border-2" aria-label="Default select example" name="country">
                        <?php
                        $selected_country = $user['country'];
                        $countries = array(
                            "United States",
                            "Canada",
                            "Mexico",
                            "Germany",
                            "France",
                            "Spain",
                            "Italy",
                            "United Kingdom"
                        );
                        foreach ($countries as $country) {
                            $selected = "";
                            if ($selected_country == $country) {
                                $selected = "selected";
                            }
                            echo "<option value='$country' $selected>$country</option>";
                        }
                        ?>
                    </select>
                </div>

                <!--Save button to submit-->
                <div class="align-items-center">
                    <div class="align-self-baseline mb-4">
                        <button type="submit" name="submit"
                            class="btn btn-outline-dark fw-bold w-75 text-dark align-items-center mb-2 mb-md-0 text-decoration-none">
                            Update Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 d-flex flex-column align-items-center">
            <div class="mb-3 pb-2">
                <h3 class="mb-4 text-dark mb-5">Profile Picture</h3>
                <img src="<?php echo $user['profilepath']; ?>" class="rounded-circle" alt="profile picture" width="100"
                    height="100">
            </div>
            <div class="mb-3 pb-2">
                <input type="text" class="form-control border-2" id="profile" name="profilepath"
                    value="<?php echo $user['profilepath'] ?>" />
            </div>
        </div>
        </div>
    </form>
</body>

</html>