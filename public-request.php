<?php
include 'header-home.php';
if ( (isset($_GET['pal'])) )
{
    $pal_request = $_GET['pal'];
}
elseif ( (isset($_POST['pal'])) )
{
    $pal_request = $_POST['pal'];
}
?>

<div class="jumbotron e-color" id="single-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php
                $query = "select username, ueser_id from users where user_id = $pal_request";
                $pal_request_set = mysqli_query($connection, $query);

                $record = mysqli_fetch_assoc($pal_request_set);
                echo '<div class="panel-heading"><h3 class="panel-title">'  . $record["username"] . '</h3></div>';
                $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                $images = $con->query("select * from images where user_id = $pal_request");
                if(mysqli_num_rows($images) > 0) {
                    $img = $images->fetch_object();
                    echo "<img src=\"get-image.php?id=$img->ImageId\" style='width:100px;height:100px'>";
                } else {
                    echo "<img src=\"img/av1.PNG\" style='width:50px;height:50px'>";
                }
                $con->close();

                ?>
                <br><br>
                <form action="public-request.php" method="post" id="request-form">
                    <input name="pal" type="hidden" value="<?php echo $pal_request; ?>">
                    <button type="submit" class="btn btn-default">Request As Pal</button>
                </form>

                <?php
                if ($_SESSION['user_id'] == null) {
                    $current_user = null;
                } else {
                    $current_user = $_SESSION['user_id'];
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $query  = "insert into pals (pal_id, user_id) values ($current_user, $pal_request )";
                    $success = mysqli_query($connection, $query);
                    if($success) {
                        echo "you are now pals";
                        ?><script>$('#request-form').hide();</script> <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-8">
                <h4 class="panel-title">Profile</h4>
                <p>
                    "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
                </p>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pals</h3>
        </div>
        <div class="panel-body">
            <ul>
                <?php
                $query  = "select username, user_id ";
                $query .= "from users ";
                $query .= "inner join pals ";
                $query .= "using (user_id) ";
                $query .= "where pal_id = $pal_request";
                $pal_result_set = mysqli_query($connection, $query);

                if(!mysqli_affected_rows($connection)) {
                    echo 'No pals found';
                }
                while($pal = mysqli_fetch_assoc($pal_result_set)) {
                    $pal_img = $pal['user_id'];
                    $con = new mysqli('localhost:3308', 'root', 'Mojojojo1', 'movie_pal');
                    $images = $con->query("select * from images where user_id = $pal_img");
                    if(mysqli_num_rows($images) > 0) {
                        $img = $images->fetch_object();
                        echo "<li><img src=\"get-image.php?id=$img->ImageId\" style='width:50px;height:50px'></li>";
                    } else {
                        echo "<li><img src=\"img/av1.PNG\" style='width:50px;height:50px'></li>";
                    }
                    $con->close();
                    ?>
                    <li class="profile">
                        <a href="public.php?pal=<?php echo urlencode($pal["user_id"]); ?>">
                            <?php echo $pal['username']; ?>
                        </a>
                    </li>
                    <hr>
                <?php } ?>
            </ul>
            </div>
        </div>
        </div>
        <div class="col-md-4">
            <h3>Watchlist</h3>
            <ul>
                <?php
                $q  = "select user_id, watchlist_title, watchlist_description ";
                $q .= "from watchlist ";
                $q .= "where user_id = $pal_request";
                $watchlist_result_set = mysqli_query($connection, $q);
                if($watchlist_result_set) {
                    $check = mysqli_affected_rows($connection);
                    if($check < 1) {
                        echo 'No watchlist to display';
                    }
                }
                while ($watchlist = mysqli_fetch_assoc($watchlist_result_set)) {
                    ?>
                    <li>
                        <?php echo $watchlist['watchlist_title']; ?>
                    </li>
                    <li>
                        <?php echo $watchlist['watchlist_description']; ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-md-4">
            <h3>Reviews</h3>
            <?php
            $query = "select username, review, review_title ";
            $query .= "from users ";
            $query .= "inner join reviews ";
            $query .= "using (user_id) ";
            $query .= "where user_id = $pal_request";
            //echo $current_user;
            $pal_result_set = mysqli_query($connection, $query);
            //confirm_query($breed_set);
            $pal = mysqli_fetch_assoc($pal_result_set);

            if (!$pal['review_title']) {
                echo 'no reviews found for this user';

            } else
            {
                echo '<h1>' . $pal['review_title'] . '</h1>
                    <p>' . $pal['review'] . '</p>';
            }
            ?>
        </div>
</div>

<?php include 'inc/footer.php';