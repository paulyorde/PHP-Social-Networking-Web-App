<?php
include 'header-home.php';

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    require ('functions.php');
    redirect_user('index.php');
}
?>
<div class="jumbotron" id="single-page-content">
    <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Watchlist</h2>
                            </div>
                            <div class="panel-body">
                            <ul>
                                <?php
                                $id = null;
                                if(isset($_GET['watchlist'])) { $id = $_GET['watchlist']; }
                                $query  = "select username, user_id, watchlist_title, watchlist_description, show_date ";
                                $query .= "from watchlist ";
                                $query .= "inner join users ";
                                $query .= "using (user_id) ";
                                $query .= "where watchlist_id = $id";

                                $r = mysqli_query($connection, $query);

                                while ($record = mysqli_fetch_assoc($r)) {
                                    ?>
                                    <li class="watchlist">
                                        <b><?php echo $record['watchlist_title']; ?></b>
                                        <br><br><b><i><span class="movieData">Description: </span></i>
                                            <?php echo $record['watchlist_description']; ?></b>
                                        <br><br><b><i><span class="movieData">Show Date: </span></i>
                                            <?php echo $record['show_date']; ?></b>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
