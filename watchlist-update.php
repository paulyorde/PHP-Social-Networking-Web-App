<?php
include 'header-home.php';

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
    require ('functions.php');
    redirect_user('index.php');
}
if(isset($_SESSION['user_id']))
{
    $id = $_SESSION['user_id'];
}

if(isset($_POST['id'])) {
    $id = $_POST['id'];
}
if(isset($_POST['title'])) {
    $title = $_POST['title'];
} else {
    $title = null;
}
if(isset($_POST['description'])) {
    $des = $_POST['description'];
} else {
    $des= null;
}

if(isset($_POST['showdate'])) {
    $show = $_POST['showdate'];
} else {
    $show = null;
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $q = "insert into watchlist (user_id, watchlist_title, watchlist_description, show_date) values
    ($id, '$title', '$des', $show";
    mysqli_query($connection, $q);
    if(mysqli_affected_rows($connection)) {
        echo 'watchlist updated';
    } else {
        echo"watchlist not updated";
    }
}
?>
    <div class="jumbotron" id="single-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-3">
                    <form action="" method="post">
                        Movie Title
                        <input type="text" class="form-control" name="title">
                        Movie Description
                        <textarea name="description" class="form-control"></textarea>
                        <input type="date" class="form-control" name="showdate">
                        <button class="btn btn-lg btn-block" type="submit">Watchlist +</button>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';
