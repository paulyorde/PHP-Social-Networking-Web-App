<?php
include 'header-home.php'; ?>
    <div class="jumbotron" id="single-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-default>">
                            <?php
                            if (!isset($_SESSION['user_id'])) {
                                $current_user = null;
                            } else {
                                $current_user = $_SESSION['user_id'];
                            }
                            $selected_pal = null;
                            if(isset($_GET['pal']))
                            {
                                $selected_pal = $_GET['pal'];
                            }
                            if(isset($_GET['request'])) {
                                $request = $_GET['request'];
                            }
                            if($selected_pal != null) {
                                $query = "select username, pal_id, user_id ";
                                $query .= "from users ";
                                $query .= "inner join pals ";
                                $query .= "using (user_id) ";
                                $query .= "where user_id = $selected_pal";

                                $pal_result_set = mysqli_query($connection, $query);

                                $pal = mysqli_fetch_assoc($pal_result_set);
                                echo '<div class="panel-heading"><h5 class="panel-title"> Public Page for ' . $pal['username'] . '</h5></div>';

                                $con = new mysqli('localhost:3308', 'root', 'Mojojojo1', 'movie_pal');
                                $images = $con->query("select * from images where user_id = $selected_pal");
                                if(mysqli_num_rows($images) > 0) {
                                    $img = $images->fetch_object();
                                    echo "<div class='panel-body'><img src=\"get-image.php?id=$img->ImageId\" style='width:100px;height:100px'></div>";
                                } else {
                                    echo "<img src=\"img/av1.PNG\">";
                                }
                                $con->close();
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default>">
                            <div class="panel-heading">
                        <h4 class="panel-title">Profile</h4>
                            </div>
                        </div>
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
                    <?php
                        $query  = "select username, user_id ";
                        $query .= "from users ";
                        $query .= "inner join pals ";
                        $query .= "using (user_id) ";
                        $query .= "where pal_id = $selected_pal";
                        $pal_result_set = mysqli_query($connection, $query);
                        if(!mysqli_affected_rows($connection)) {
                            echo 'No pals found';
                        }
                        $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                        while($pal = mysqli_fetch_assoc($pal_result_set)) {
                        $pal_img = $pal['user_id'];
                        $images = $con->query("select * from images where user_id = $pal_img");
                        if(mysqli_num_rows($images) > 0) {
                        $img = $images->fetch_object();
                        echo "<div class=\"panel-body\">
                        <img src=\"get-image.php?id=$img->ImageId\" style='width:50px;height:50px'></div>";
                        } else {
                            echo "<div class=\"panel-body\"><img src=\"img/av1.PNG\" style='width:50px;height:50px'></div>";
                        }
                        ?>
                        <div class="profile panel-footer">
                            <a href="public.php?pal=<?php echo urlencode($pal["user_id"]); ?>">
                                <?php echo $pal['username']; ?>
                            </a>
                        </div>
                        <hr>
                    <?php }
                    $con->close();
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <h3 class="panel-title">Watchlist</h3>
                    </div>

                    <?php
                    $q  = "select user_id, watchlist_title, watchlist_description ";
                    $q .= "from watchlist ";
                    $q .= "where user_id = $selected_pal";
                    $watchlist_result_set = mysqli_query($connection, $q);
                        if($watchlist_result_set) {
                           $check = mysqli_affected_rows($connection);
                            if($check < 1) {
                                echo 'No watchlist to display';
                            }
                        }
                        while ($watchlist = mysqli_fetch_assoc($watchlist_result_set)) {
                        ?>
                            <div class="panel-body">
                                <h4>
                                    <?php echo $watchlist['watchlist_title']; ?>
                                </h4>
                                <p>
                                    <?php echo $watchlist['watchlist_description']; ?>
                                </p>
                            </div>
                            <hr>
                        <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reviews</h3>
                    </div>
                            <?php
                            $query = "select username, review, review_title ";
                            $query .= "from users ";
                            $query .= "inner join reviews ";
                            $query .= "using (user_id) ";
                            $query .= "where user_id = $selected_pal";
                            //echo $current_user;
                            $pal_result_set = mysqli_query($connection, $query);
                            //confirm_query($breed_set);
                            $pal = mysqli_fetch_assoc($pal_result_set);

                            if (!$pal['review_title']) {
                               echo 'no reviews found for this user';
                            } else
                            {
                                echo '<div class="panel-body"><h4>' . $pal['review_title'] . '
                                </h4><p>' . $pal['review'] . '</p></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>


<?php include 'inc/footer.php';