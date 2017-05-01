<?php
include 'header-home.php';
if(isset($_SESSION['user_id']))
{
    $id = $_SESSION['user_id'];
}
?>
<div class="jumbotron" id="single-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 review-edit ">
                    <?php
                    $query = "Select * from reviews WHERE user_id = $id";
                    $query_result = mysqli_query($connection, $query);
                    // count number of rows selected
                    $num = mysqli_num_rows($query_result);
                    if($num > 0)
                    {
                    echo "<h2>$num reviews total</h2>";
                    while ($result_record = mysqli_fetch_array($query_result, MYSQLI_ASSOC))
                    {
                        echo '<div class="panel panel-default"><div class="panel-heading">
                    <h3 class="panel-title">' . $result_record['review_title'] . '</h3></div><br>' .
                        '<div class="panel-body">
                    <p>' . $result_record['review'] .'</p></div>' .
                            '<a href="edit.php?id=' . $result_record['review_id'] . '">Edit </a>
                        <a href="delete.php?id=' . $result_record['review_id'] . '">Delete </a></div><hr>';
                    }
                    mysqli_free_result($query_result);
                    }
                    else
                    {
                        echo "<p>no reviews found</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
mysqli_close($connection);

include 'inc/footer.php';