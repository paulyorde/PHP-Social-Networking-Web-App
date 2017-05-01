<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require 'connect.php'; // Connect to the db.

    $errors = array(); // Initialize an error array.

    // Check for a user name:
    if (empty($_POST['username'])) {
        $errors[] = 'You forgot to enter your user name.';
    } else {
        $un = mysqli_real_escape_string($connection, trim($_POST['username']));
    }

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
    }

    // Check for a password and match against the confirmed password:
    if (!empty($_POST['password'])) {
        if ($_POST['password'] != $_POST['passwordConfirm']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $p = mysqli_real_escape_string($connection, trim($_POST['password']));
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }

    if (empty($errors)) {

        $q = "INSERT INTO users (username, email, password, registration_date) VALUES ('$un', '$e', SHA1('$p'), NOW() )";
        $r = @mysqli_query ($connection, $q);
        if ($r) {
            include 'functions.php';
            redirect_user('login-page.php');
        } else {

            echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';


        }

        mysqli_close($connection);

        exit();

    } else {

        echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    }

    mysqli_close($connection);
}
?>