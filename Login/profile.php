<?php
session_start();

if ($_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
} else {

    $email =  $_SESSION['Email'];
    $name =  $_SESSION['Name'];
    $user =  $_SESSION['Username'];
    $mobile = $_SESSION['Mobile'];
    $active = $_SESSION['Active'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>AgroCulture</title>
    <meta charset="utf-8" />

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../login.css" />

    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/skel-layers.min.js"></script>
    <script src="../js/init.js"></script>
    <!-- <noscript> -->
    <link rel="stylesheet" href="../css/skel.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/style-xlarge.css" />
    <!-- </noscript> -->

    <link rel="stylesheet" href="../indexfooter.css" />



</head>
<?php
include 'menu.php';
?>

<body>

    <section id="banner" class="wrapper">
        <div class="container">
            <header class="major">
                <h2>Welcome</h2>
            </header>
            <p>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </p>

            <!-- <?php
                    if (!$active) {
                        echo
                        "<div>
                            Account is not verified! Please confirm your email by clicking
                            on the email link!
                        </div>";
                    }
                    ?> -->
            <h2><?php echo $name; ?></h2>
            <p><?= $email ?></p>

            <?php if ($_SESSION['Category'] == 1) : ?>
                <div class="row uniform">
                    <div class="6u 12u$(xsmall)">
                        <a href=../profileView.php class="button special">My Profile</a>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <a href="logout.php" class="button special">LOG OUT</a>
                    </div>
                </div>
            <?php else : ?>
                <div class="row uniform">
                    <div class="6u 12u$(xsmall)">
                        <a href=../market.php class="button special">Digital Market</a>
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <a href="logout.php" class="button special">LOG OUT</a>
                    </div>
                </div>

            <?php endif; ?>


</body>

</html>