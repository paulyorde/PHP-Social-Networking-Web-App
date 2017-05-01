<?php
$page_title = 'Log in | Sign up';
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

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <form class="form-signin" action="process-sign-up.php" method="post">
                <label for="userName" class="sr-only">User Name</label>
                <input type="text" name="username" id="userName" class="form-control" placeholder="username" required autofocus <?php if (isset($_POST['username'])) echo filter_var($_POST['username'],FILTER_SANITIZE_STRING); ?>">

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="<?php if (isset($_POST['email'])) echo filter_var($_POST['email'],FILTER_SANITIZE_EMAIL); ?>">

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required value="<?php if (isset($_POST['password'])) echo filter_var($_POST['password'],FILTER_VALIDATE_INT); ?>">

                <label for="inputPasswordConfirm" class="sr-only">Confirm</label>
                <input type="password" name="passwordConfirm" id="inputPasswordConfirm" class="form-control" placeholder="Confirm" required value="<?php if (isset($_POST['passwordConfirm'])) echo filter_var($_POST['passwordConfirm'],FILTER_VALIDATE_INT); ?>">

                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>

                <button class="btn btn-lg btn-block" type="submit" style="background:#cccccc">Sign up</button>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';