<?php
$page_title = 'Login';
include 'inc/header-splash.php';
?>
<div class="jumbotron e-color" id="single-page-content">
    <div class="container">
        <div class="col-md-6 col-md-offset-2">
            <h1>Movie Pal</h1>
            <p>Use this app to follow movies and invite friends to watch them with you!</p>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <form action="login.php" method="post">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
                <button class="btn btn-lg btn-block" type="submit" style="background:#cccccc">Login</button>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';