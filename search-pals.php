<?php
$page_title = 'search-pals';
include 'header-home.php';
?>
<div class="jumbotron e-color" id="single-page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <h4>Search movie pals</h4>
                <form action="search-pals.php" method="post" role="search" name="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." onkeyup="showHint(this.value)">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </form>
                <br>
                <p id="txtHint"></p>
                <br>
                <?php
                if ($_SESSION['user_id'] == null) {
                    $current_user = null;
                } else {
                    $current_user = $_SESSION['user_id'];
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $query  = "select username, user_id ";
                    $query .= "from users ";
                    $pal_result_set = mysqli_query($connection, $query);
                    echo '<ul>';
                    $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                    while ($pal = mysqli_fetch_assoc($pal_result_set)) {
                        $palid = $pal['user_id'];

                        $images = $con->query("select * from images where user_id = $palid");
                        if(mysqli_num_rows($images) > 0) {
                            $img = $images->fetch_object();
                            echo "<li><img src=\"get-image.php?id=$img->ImageId\" style='width:50px;height:50px'></li>";
                        } else {
                            echo "<li><img src=\"img/av1.PNG\" style='width:50px;height:50px'></li>";
                        }
                        echo '<li class="profile"><a href="public-request.php?pal=' . $pal['user_id']  . '">' . $pal["username"] . '</a><hr>';
                    }
                    echo '</ul>';
                    $con->close();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';