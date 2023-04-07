<!-- new sublueddit form for admin to add new sublueddit -->

<html lang="en" class="home">

<head>
    <?php include 'include/head.php'; ?>
    <title>New Sublueddit</title>
</head>

<body>

    <!-- Navigation bar -->
    <?php include 'include/navBar.php'; ?>

    <!-- Content -->
    <div class="container-fluid">
        <div class="row pt-4">

            <?php include 'include/sidebar.php'; ?>

            <!-- New sublueddit form -->

            <div class="col-md-6 overflow-auto ">

                <!-- Arrow to go back to Home -->
                <a href="javascript:history.back()" role="button"
                    class="btn-block text-dark col-md-1 mb-1 text-dark text-decoration-none fs-6">
                    &LeftArrow; Back
                </a>

                <div class="my-4 card bg-transparent text-dark border-0" style="border-radius: 1.5rem;">
                    <div class="card-body">
                        <h4 class="card-title">New Sublueddit</h4>
                        <form action="newSubluedditExt.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control text-dark bg-transparent" id="name" name="name"
                                    style="border-radius: 0.5rem;">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control text-dark bg-transparent" id="description"
                                    name="description" style="border-radius: 0.5rem;">
                            </div>
                            <button type="submit" class="btn btn-info rounded-pill text-white">Submit</button>
                        </form>
                    </div>


                </div>

            </div>
            <div class="col-md-3">
                <!-- panel -->
                <?php
                include 'include/panel.php';
                ?>

            </div>
        </div>
    </div>

</body>