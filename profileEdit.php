<?php
session_start();
require 'db.php';
if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page !!!";
    header("Location: ./error.php");
}
$user = $_SESSION['Username'];

if ($_SESSION['Category'] != 1) {

    $sql = "SELECT * FROM buyer WHERE busername='$user'";

    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows != 0) {
        $User = $result->fetch_assoc();

        $current_name = $User["bname"];
        $current_username = $User["busername"];
        $current_email = $User["bemail"];
        $current_mobile = $User["bmobile"];
        $current_address = $User["baddress"];
    }
} else if ($_SESSION['Category'] == 1) {

    $sql = "SELECT * FROM farmer WHERE fusername='$user'";

    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows != 0) {
        $User = $result->fetch_assoc();

        $current_name = $User["fname"];
        $current_username = $User["fusername"];
        $current_email = $User["femail"];
        $current_mobile = $User["fmobile"];
        $current_address = $User["faddress"];
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($_SESSION['Category'] != 1) {

        $sql = "SELECT * FROM buyer WHERE busername='$user'";

        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 0) {
            $_SESSION['message'] = "Invalid User Credentials!";
            header("location: ../error.php");
        } else {

            $User = $result->fetch_assoc();


            $sql = "UPDATE buyer SET bpassword='$retype_new_password', bhash='$newHash' WHERE bhash='$currHash';";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['message'] = "Password changed Successfully!";
                header("location: .././success.php");
            } else {
                $_SESSION['message'] = "Error occurred while changing password<br>Please try again!";
                header("location: ../error.php");
            }
        }
    } else {

        $sql = "SELECT * FROM farmer WHERE fusername='$user'";

        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 0) {
            $_SESSION['message'] = "Invalid User Credentials!";
            header("location: ../error.php");
        } else {

            $User = $result->fetch_assoc();

            $sql = "UPDATE farmer SET fpassword='$retype_new_password', fhash='$newHash' WHERE fhash='$currHash';";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['message'] = "Password changed Successfully!";
                header("location: ../success.php");
            } else {
                $_SESSION['message'] = "Error occurred while changing password<br>Please try again!";
                header("location: ../error.php");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap\js\bootstrap.min.js"></script>
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <link rel="stylesheet" href="Blog/commentBox.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <noscript>
        <link rel="stylesheet" href="./skel.css" />
        <link rel="stylesheet" href="./style.css" />
        <link rel="stylesheet" href="./style-xlarge.css" />
    </noscript>
</head>

<body>
    <?php
    require "menu.php"
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Edit Profile</h3>
                    </div>
                    <div class="card-body">

                        <!-- Edit Profile Form -->
                        <form action="profileEdit.php" method="POST" enctype="multipart/form-data">

                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $User['name']; ?>" required>
                            </div>

                            <!-- Username Field -->
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $User['username']; ?>" required>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $User['email']; ?>" required>
                            </div>


                            <!-- Address Field -->
                            <div class="form-group">
                                <label for="addres">Address</label>
                                <input type="text" class="form-control" id="addres" name="address" value="<?php echo $User['address']; ?>" required>
                            </div>



                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>