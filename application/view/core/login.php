<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>

        <link rel="stylesheet" type="text/css" href="<?php echo $this->templatedir; ?>/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->templatedir; ?>/style/login.css">
    </head>
    <body>
        <div class="container">
            <form class="form-signin" role="form">
                <h2 class="form-siging-heading">Please sign in</h2>
                <input type="text" class="form-control" placeholder="Username" required autofocus>
                <input type="password" class="form-control" placeholder="Password" required>
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </body>
</html>