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
            <form method="POST" class="form-signin" role="form" action="/login">
                <h2 class="form-siging-heading">Please sign in</h2>
                <span><?php echo strlen($this->errormsg) > 0 ? $this->errormsg : ''; ?></span>
                <input type="text" name="username" class="form-control" placeholder="Username" value="demo" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" value="password" required>
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </body>
</html>