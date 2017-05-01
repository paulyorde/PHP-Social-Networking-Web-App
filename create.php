<?php

include 'header-home.php';

$id = $_SESSION['user_id'];
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for a first name:
    if (empty($_POST['review_title'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $review_title = mysqli_real_escape_string($connection, trim($_POST['review_title']));
    }

    // Check for a last name:
    if (empty($_POST['review'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $review = mysqli_real_escape_string($connection, trim($_POST['review']));
    }

    if (empty($errors)) { // If everything's OK.

        // Register the user in the database...

        // Make the query:
        $q = "INSERT INTO reviews (user_id, review_title, review) VALUES ($id, '$review_title', '$review' )";
        $r = @mysqli_query ($connection, $q); // Run the query.
        if ($r) { // If it ran OK.
            echo '<h3 style="padding-top:50px">review added</h3>';
        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
			<p class="error">System error.</p>';
        }

        mysqli_close($connection); // Close the database connection.

        // Include the footer and quit the script:
        include 'inc/footer.php';
        exit();

    } else { // Report the errors.

        echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    } // End of if (empty($errors)) IF.

    mysqli_close($connection); // Close the database connection.

} // End of the main Submit conditional.
?>
<div class="jumbotron">
    <div class="container" style="padding-top:50px">
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <h3>Write a review</h3>
                <form action="create.php" method="post">
                    Review Title <input type="text" name="review_title" class="form-control" required value="<?php if (isset($_POST['review_title'])) echo $_POST['review_title']; ?>" />
                    Review <input type="text" name="review" class="form-control" required value="<?php if (isset($_POST['review'])) echo $_POST['review']; ?>" />
                    <button class="btn btn-lg btn-block" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';