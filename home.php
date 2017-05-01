<?php
$page_title = 'home';
include 'header-home.php';
include 'functions.php';

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
    require ('functions.php');
    redirect_user('sign-up.php');
}
?>

    <div class="jumbotron" id="single-page-content">
        <div class="background-img">
        </div>
    </div>

    <div class="container">
        <div class="header-padding">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h3>Pals</h3>
                <p>Look for pals you know or find new ones to add to your pals list. click now</p>
                <p><a class="btn btn-default" href="search-pals.php?id=<?php echo $_SESSION['user_id']; ?>" role="button">Add Pals &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h3>Watchlist</h3>
                <p>Add more to your watchlist so you don't miss another great movie</p>
                <p><a class="btn btn-default" href="watchlist-update.php?id=<?php echo $_SESSION['user_id']; ?>" role="button">Add Watchlist &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h3>Reviews</h3>
                <p>Add more reviews so others can see your personal taste. This could be good or bad for you!</p>
                <p><a class="btn btn-default" href="create.php" role="button">Add reviews &raquo;</a></p>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php';