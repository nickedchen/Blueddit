<! newSubluedditExt.php !>

    <?php
    include 'include/connection.php';
    session_start();

    // For sublueddits
    
    //get name and description
    $name = $_POST['name'];
    $description = $_POST['description'];

    //check if sublueddit already exists
    $sql = "SELECT * FROM sublueddits WHERE title = '$name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['subluedditError'] = "Sublueddit already exists";
        header("Location: newSublueddit.php");
    } else {
        //insert into sublueddits
        $sql = "INSERT INTO sublueddits (title, description) VALUES ('$name', '$description')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $_SESSION['subluedditError'] = "Error creating sublueddit";
        } else{
            $sql = "INSERT INTO usageTracking (type, sid, entryDate)
            Values ('NEWSUB', ".$post['sid'].", CURDATE())";
            mysqli_query($conn, $sql);
        }
        //redirect to sublueddit page
        //get new sublueddit id
        $sql = "SELECT sid FROM sublueddits WHERE title = '$name'";
        $result = mysqli_query($conn, $sql);    
        $sid = mysqli_fetch_assoc($result)['sid'];

        header("Location: sublueddit.php?sid=$sid");
    }
