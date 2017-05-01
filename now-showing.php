<?php
$page_title = 'now-showing';
include 'header-home.php';

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    require ('functions.php');
    redirect_user('index.php');
}
?>

<div class="jumbotron" id="single-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">NOW PLAYING</h3>
                    </div>
                    <div class="panel-body">
                        <div id="movie-title"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';