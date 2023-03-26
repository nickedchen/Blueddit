<!-- Profile Settings -->

<!DOCTYPE html>
<html lang="en" class="home">

<head>
    <?php include 'include/head.php'; ?>
    <?php include 'include/login.php'; ?>
    <title>Profile Settings</title>
</head>

<body>

    <!-- Navbar for profile -->
    <?php include 'include/backNavbar.php'; ?>

    <!-- Sidebar -->
    <?php include 'include/profileSidebar.php'; ?>

    <!-- Main Content -->

    <div class="col-md-5">

        <!-- Create form for user to edit their profile info -->

        <div id="profile-container">

            <h2 class="mb-4 text-dark mb-5">Account Settings</h2>

            <!-- Form for user to edit their profile info -->
            <form action="validateProfile.php" method="post" name="profile-form" enctype="multipart/form-data">

                <?php
                session_start();

                if (!isset($_SESSION['userid'])) {
                    header('Location: login.php');
                    exit();
                }

                $userid = $_SESSION['userid'];

                $conn = mysqli_connect($servername, $username, $password, $dbname);
                $error = mysqli_connect_error();

                if ($error != null) {
                    $output = "<p>Unable to reach the database!</p>";
                    exit($output);
                } else {
                    //good connection
                    $sql = "SELECT username, email, password, about, country, totalUpvotes, isadmin, profilepath FROM users WHERE userid = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $userid);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $username, $email, $password, $about, $country, $totalUpvotes, $isadmin, $profilepath);

                    mysqli_stmt_fetch($stmt);

                    $user = array(
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'about' => $about,
                        'country' => $country,
                        'totalUpvotes' => $totalUpvotes,
                        'isadmin' => $isadmin,
                        'profilepath' => $profilepath,

                    );

                    mysqli_stmt_close($stmt);
                }
                ?>


                <div class="mb-3 pb-2">
                    <label for="profile" class="form-label h6 text-dark pb-2">Display Name</label>
                    <input type="text" class="form-control border-2" id="profile" name="username"
                        placeholder="<?php echo $user['username'] ?>" value="<?php echo $user['username'] ?>" />
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
                        placeholder="<?php echo $user['password']; ?>" />
                </div>

                <!-- Country -->

                <div class="mb-3 pb-2">
                    <label for="country" class="form-label h6 text-dark pb-2">Country</label>
                    <select class="form-select w-50 border-2" aria-label="Default select example">
                        <?php
                        if ($user['country'] == "United States") {
                            echo '<option selected value="1">United States</option>';
                        } else if ($user['country'] == "Canada") {
                            echo '<option selected value="2">Canada</option>';
                        } else if ($user['country'] == "Mexico") {
                            echo '<option selected value="3">Mexico</option>';
                        } else {
                            echo '<option selected value="0">Select a country</option>';
                        }
                        ?>
                        <option value="1">United States</option>
                        <option value="2">Canada</option>
                        <option value="3">Mexico</option>
                    </select>
                </div>

                <!--Save button to sumbit-->

                <div class="align-items-center">
                    <div class="align-self-baseline mb-4">
                        <a type="submit" role="button" method="post" name="submit"
                            class="btn btn-outline-dark fw-bold w-75 text-dark align-items-center mb-2 mb-md-0 text-decoration-none">
                            Update Account
                        </a>
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
            <label for="avatar" class="form-label h6 text-dark pb-2">
                <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.3696 2.52668C10.6952 2.52663 10.0276 2.66158 9.40619 2.92359C8.78479 3.1856 8.22212 3.56936 7.75136 4.05225C7.28059 4.53513 6.91127 5.10738 6.66514 5.73524C6.41902 6.36311 6.30108 7.0339 6.31827 7.70807C6.32503 7.99321 6.23508 8.27224 6.06307 8.49976C5.89106 8.72727 5.64711 8.88987 5.37092 8.9611C4.48045 9.19435 3.70523 9.74356 3.18986 10.5063C2.67449 11.269 2.45417 12.1931 2.56998 13.1063C2.68579 14.0195 3.12983 14.8594 3.81928 15.4694C4.50873 16.0793 5.3965 16.4176 6.31701 16.4212H7.58015C7.91515 16.4212 8.23644 16.5543 8.47332 16.7911C8.7102 17.028 8.84328 17.3493 8.84328 17.6843C8.84328 18.0193 8.7102 18.3406 8.47332 18.5775C8.23644 18.8144 7.91515 18.9475 7.58015 18.9475H6.31701C4.86227 18.9478 3.45202 18.4459 2.32456 17.5265C1.19711 16.6072 0.421583 15.3269 0.129034 13.9019C-0.163515 12.4768 0.0448492 10.9945 0.718919 9.70534C1.39299 8.41619 2.49143 7.39926 3.82863 6.8264C3.98792 5.22988 4.64977 3.7251 5.71888 2.52875C6.78798 1.3324 8.20918 0.50621 9.77781 0.169141C11.3464 -0.167929 12.9816 0.00151948 14.4478 0.653085C15.914 1.30465 17.1355 2.40471 17.9366 3.79487C19.9193 3.86703 21.7947 4.71382 23.16 6.15342C24.5253 7.59301 25.2717 9.5106 25.2388 11.4944C25.2058 13.4782 24.3963 15.3699 22.984 16.7635C21.5717 18.157 19.6693 18.9411 17.6852 18.9475C17.3502 18.9475 17.029 18.8144 16.7921 18.5775C16.5552 18.3406 16.4221 18.0193 16.4221 17.6843C16.4221 17.3493 16.5552 17.028 16.7921 16.7911C17.029 16.5543 17.3502 16.4212 17.6852 16.4212C18.3656 16.4202 19.0387 16.2818 19.6643 16.0143C20.2898 15.7469 20.8549 15.3558 21.3257 14.8646C21.7964 14.3734 22.1631 13.7922 22.4038 13.1559C22.6444 12.5195 22.7541 11.8411 22.7262 11.1613C22.6983 10.4816 22.5333 9.81442 22.2413 9.19994C21.9493 8.58545 21.5362 8.03628 21.0267 7.58534C20.5173 7.13441 19.9221 6.791 19.2767 6.57572C18.6313 6.36044 17.9491 6.27771 17.2709 6.33251C17.0078 6.35391 16.7445 6.29231 16.5182 6.15637C16.2919 6.02043 16.1138 5.81699 16.0091 5.57463C15.6176 4.66925 14.9697 3.89823 14.1453 3.35663C13.3208 2.81503 12.356 2.52652 11.3696 2.52668ZM11.7397 9.21246C11.9765 8.97566 12.2978 8.84263 12.6327 8.84263C12.9676 8.84263 13.2889 8.97566 13.5257 9.21246L16.052 11.7387C16.2821 11.977 16.4094 12.296 16.4065 12.6272C16.4037 12.9584 16.2708 13.2752 16.0366 13.5094C15.8024 13.7436 15.4856 13.8765 15.1544 13.8793C14.8232 13.8822 14.5042 13.7549 14.2659 13.5248L13.8958 13.1547V22.7369C13.8958 23.0719 13.7628 23.3932 13.5259 23.63C13.289 23.8669 12.9677 24 12.6327 24C12.2977 24 11.9764 23.8669 11.7395 23.63C11.5026 23.3932 11.3696 23.0719 11.3696 22.7369V13.1547L10.9995 13.5248C10.7612 13.7549 10.4422 13.8822 10.111 13.8793C9.77978 13.8765 9.46297 13.7436 9.22877 13.5094C8.99457 13.2752 8.86173 12.9584 8.85885 12.6272C8.85598 12.296 8.98329 11.977 9.21338 11.7387L11.7397 9.21246Z"
                        fill="#666666" />
                </svg>
                Upload new avatar
            </label>
            <input type="file" name="avatar" id="avatar" accept="image/*" onchange="loadFile(event)"
                style="display: none" />
        </div>
    </div>
    </div>
</body>

</html>