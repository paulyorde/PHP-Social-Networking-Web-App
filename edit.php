<?php
include 'functions.php';

include 'header-home.php';

//check for id
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) )
{
    $id = $_GET['id'];
}
elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) )
{
    $id = $_POST['id'];
}
else
{

    echo "404";
    include 'inc/footer.php';
    exit();
}

require_once 'connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $title = $_POST['review_title'];
    $review_title = $_POST['review'];

    $q = "SELECT * FROM reviews WHERE review_id=$id";
    $r = @mysqli_query($connection, $q);
    if (mysqli_affected_rows($connection) == 1)
    {

        // Make the query:
        $q = "UPDATE reviews SET review_title='$title', review='$review_title' WHERE review_id=$id LIMIT 1";
        $r = @mysqli_query ($connection, $q);
        if (mysqli_affected_rows($connection) == 1)
        { // If it ran OK.

            // Print a message:

            echo 'review has been updated';



        }
        else
        { // If it did not run OK.
            echo '<p class="error">The review could not be edited.</p>'; // Public message.

        }

    }
    else
    { // Already registered.
        echo '<p class="error">review already is.</p>';
    }
}


$q = "SELECT * FROM reviews WHERE review_id=$id";
$r = @mysqli_query ($connection, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

    // Get the user's information:
    $row = mysqli_fetch_assoc ($r);

    // Create the form:
    echo '
<div class="jumbotron e-color" id="single-page-content">
    <div class="container">
    <h3>Edit Review</h3>
<form action="edit.php" method="post">
Title <input type="text" name="review_title" />
Review <input type="text" name="review">
<input type="submit" name="submit" value="Submit" />
<input type="hidden" name="id" value="' . $id . '" />
</form></div></div>';

} else { // Not a valid user ID.
    echo '<p class="error">This page has been accessed in error.</p>';
}
?>

<?php

mysqli_close($connection);

include 'inc/footer.php';