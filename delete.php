<?php

include 'header-home.php';

// check for id
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
    include "inc/footer.php";
    exit();
}

require_once 'connect.php';

// handle the postback
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if ($_POST['sure'] == 'Yes')
    { // Delete the record.

        // Make the query:
        $q = "DELETE FROM reviews WHERE review_id=$id LIMIT 1";
        $r = @mysqli_query ($connection, $q);
        if (mysqli_affected_rows($connection) == 1)
        { // If it ran OK.

            // Print a message:
            echo '<p>The review has been deleted.</p>';

        }
        else
        { // If the query did not run OK.
            echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.

        }

    }
    else
    { // No confirmation of deletion.
        echo '<p>The review has NOT been deleted.</p>';
    }

}
else
{


    $q = "SELECT * FROM reviews WHERE review_id=$id";
    $r = @mysqli_query ($connection, $q);

    if (mysqli_num_rows($r) == 1)
    {


        $row = mysqli_fetch_assoc ($r);
        $title = $row['review_title'];

        echo "<h3>Title: $title</h3>
		Are you sure you want to delete this Review?";


        echo '<form action="delete.php" method="post">
	<input type="radio" name="sure" value="Yes" /> Yes
	<input type="radio" name="sure" value="No" checked="checked" /> No
	<input type="submit" name="submit" value="Submit" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';

    }
    else
    {
        echo '<p class="error">This page has been accessed in error.</p>';
    }

}

mysqli_close($connection);

include 'inc/footer.php';