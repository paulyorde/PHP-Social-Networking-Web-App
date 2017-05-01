<?php
$page_title = 'admin';
include 'header-home.php';

if($_SESSION['loggedin'] === false) {
    require 'functions.php';
    redirect_user();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require 'connect.php'; // Connect to the db.

    $errors = array(); // Initialize an error array.

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = mysqli_real_escape_string($connection, trim($_POST['email']));
    }

    // Check for the current password:
    if (empty($_POST['pass'])) {
        $errors[] = 'You forgot to enter your current password.';
    } else {
        $p = mysqli_real_escape_string($connection, trim($_POST['pass']));
    }

    // Check for a new password and match
    // against the confirmed password:
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your new password did not match the confirmed password.';
        } else {
            $np = mysqli_real_escape_string($connection, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'You forgot to enter your new password.';
    }

    if (empty($errors)) { // If everything's OK.

        // Check that they've entered the right email address/password combination:
        $q = "SELECT user_id FROM users WHERE (email='$e' AND password=SHA1('$p') )";
        $r = @mysqli_query($connection, $q);
        $num = @mysqli_num_rows($r);
        if ($num == 1) { // Match was made.

            // Get the user_id:
            $row = mysqli_fetch_array($r, MYSQLI_NUM);

            // Make the UPDATE query:
            $q = "UPDATE users SET password=SHA1('$np') WHERE user_id=$row[0]";
            $r = @mysqli_query($connection, $q);

            if (mysqli_affected_rows($connection) == 1) { // If it ran OK.

                // Print a message.
                echo '<h1>Thank you!</h1>
				<p>Your password has been updated.</p><p><br /></p>';

            } else { // If it did not run OK.

                // Public message:
                echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';

                // Debugging message:
                echo '<p>' . mysqli_error($connection) . '<br /><br />Query: ' . $q . '</p>';

            }

            mysqli_close($connection); // Close the database connection.

            exit();

        } else { // Invalid email address/password combination.
            echo '<h1>Error!</h1>
			<p class="error">The email address and password do not match those on file.</p>';
        }

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
    <div class="container">
        <h2>Admin</h2>
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <?php
                    echo '<div class="panel-heading"><h3 class="panel-title">' . $_SESSION['username'] . '</h3></div>';
                    $id = $_SESSION['user_id'];
                    $con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
                    $images = $con->query("select * from images where user_id = $id");
                    echo '<div class="panel-body">';
                    if(mysqli_num_rows($images) > 0) {
                        $img = $images->fetch_object();
                        echo "<img src=\"get-image.php?id=$img->ImageId\" style='width:100px;height:100px'>";
                    } else {
                        echo "<li><img src=\"img/av1.PNG\" style='width:50px;height:50px'></li>";
                    }
                    echo '</div>';
                    ?>
            </div>
        </div>
            <div class="col-md-5 col-md-offset-1">
                <form action="" method="post">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    <label for="inputPassword" class="sr-only">Current Password</label>
                    <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">

                    <label for="newPassword" class="sr-only">New Password</label>
                    <input type="password" name="pass1" id="newPassword" class="form-control" placeholder="new Password" required value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">

                    <label for="conNewPassword" class="sr-only">Confirm New Password</label>
                    <input type="password" name="pass2" id="conNewPassword" class="form-control" placeholder="confirm new Password" required value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">

                    <button class="btn btn-lg btn-block" type="submit">Change Password</button>
                </form>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <form action="images.php" method="post" enctype="multipart/form-data" id="avatar">
                    <label for="avatar" class="sr-only">avatar</label>
                    <input type="file" name="my_upload" id="avatar" class="form-control" placeholder="avatar"  value="<?php if (isset($_POST['my_upload'])) echo $_POST['my_upload']; ?>">

                    <button class="btn btn-lg btn-block" type="submit">Upload avatar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';
