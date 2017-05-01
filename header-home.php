<?php
session_start();

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
    require ('functions.php');
    redirect_user('index.php');
}

require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="stuff about movies">
    <meta name="author" content="various">

    <title>Movie Pal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <?php
        if($page_title == 'now-showing') {echo '<script src="js/movies.js"></script>';}
        if($page_title == 'search-pals') {echo '<script src="js/hint.js"></script>';}
    ?>
</head>
<body>

<!--NAV-->
<nav class="navbar navbar-default navbar-style navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">movie pal</a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <?php if($page_title != 'home') { ?>
            <ul class="nav navbar-nav">
                <li><a href="home.php"><span class="glyphicon glyphicon-home"> </span> </a></li>
            </ul>
            <?php } ?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Pals<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        if ($_SESSION['user_id'] == null) {
                            $current_user = null;
                        } else {
                            $current_user = $_SESSION['user_id'];
                            $username = $_SESSION['username'];
                        }

                        $query  = "select username, user_id ";
                        $query .= "from users ";
                        $query .= "inner join pals ";
                        $query .= "using (user_id) ";
                        $query .= "where pal_id = $current_user";

                        $pal_result_set = mysqli_query($connection, $query);

                        while($pal = mysqli_fetch_assoc($pal_result_set)) { ?>
                            <li>
                                <a href="public.php?pal=<?php echo urlencode($pal["user_id"]); ?>">
                                    <?php echo $pal["username"]; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Watchlist<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $query  = "select username, user_id, watchlist_title, watchlist_id ";
                        $query .= "from watchlist ";
                        $query .= "inner join users ";
                        $query .= "using (user_id) ";
                        $query .= "where user_id = $current_user";

                        $r = mysqli_query($connection, $query);

                        while ($record = mysqli_fetch_assoc($r)) {
                            ?>
                            <li>
                                <a href="watchlist.php?watchlist=<?php echo $record['watchlist_id']; ?>"><?php echo $record['watchlist_title']; ?></a>
                            </li>
                            <?php
                        }
                        ?>
                        </ul>
                    </li>
                <li><a href="review.php">My Reviews</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">In Theaters <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="now-showing.php">Now Playing</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <?php if($page_title != 'admin') { ?>
                    <li><a href="password.php">admin</a> </li>
                <?php } else { ?>
                    <li><a href="logout.php">logout</a> </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<span style="float: right;padding-right: 20px;padding-top;10px;">signed in as <?php echo $username ?></span>