<?php
session_start();

require '../db.php';

if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == 0) {
    $_SESSION['message'] = "You need to first login to access this page !!!";
    header("Location: ./error.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_SESSION['Username'];
    $old_password = filter_var($_POST['old_password']);
    $new_password = filter_var($_POST['new_password']);
    $retype_new_password = filter_var($_POST['retype_new_password']);
    $newHash = md5(rand(0, 1000));


    if (strlen($old_password) <= 0) {
        $_SESSION['message'] = "Please Enter Old Password";
        header("location: ../error.php");
        return;
    }

    if (strlen($new_password) <= 5) {
        $_SESSION['message'] = "Password Should have at least 6 characters!";
        header("location: ../error.php");
        return;
    }

    if ($new_password != $retype_new_password) {
        $_SESSION['message'] = "New Password and Retype new Password Does Not match!";
        header("location: ../error.php");
        return;
    }

    if ($_SESSION['Category'] != 1) {

        $sql = "SELECT * FROM buyer WHERE busername='$user'";

        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 0) {
            $_SESSION['message'] = "Invalid User Credentials!";
            header("location: ../error.php");
        } else {

            $User = $result->fetch_assoc();

            if (password_verify($old_password, $User['bpassword'])) {

                if ($new_password == $retype_new_password) {

                    $retype_new_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $currHash = $_SESSION['Hash'];

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
                $_SESSION['message'] = "Invalid current User Credentials!";
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

            if (password_verify($old_password, $User['fpassword'])) {

                if ($new_password == $retype_new_password) {

                    $retype_new_password = password_hash($new_password, PASSWORD_BCRYPT);

                    $currHash = $_SESSION['Hash'];

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
            } else {
                $_SESSION['message'] = "Invalid current User Credentials!";
                header("location: ../error.php");
            }
        }
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>


    <title>Profile:
        <?php echo $_SESSION['Username']; ?>
    </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="../css/skel.css" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />


    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/style-xlarge.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<?php
require "../Login/menu.php";
?>

<body>
    <div class="container w-100 ">
        <p class="my-4" style="font-size:35px;">Change Password</p>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="old_password">Old Password:</label>
                <input type="password" class="form-control" name="old_password" id="old_password">
            </div>

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" name="new_password" id="new_password">
            </div>


            <div class="form-group">
                <label for="retype_new_password">Retype New Password:</label>
                <input type="password" class="form-control" name="retype_new_password" id="retype_new_password">
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</body>

</html>