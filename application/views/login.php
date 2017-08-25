<?php $this->load->view('_includes/header', ["css" => [base_url() . "asset/css/login.css"]]); ?>
<?php
define("RECAPTCHA", false);
if (RECAPTCHA) {
    ?>
    <script src='https://www.google.com/recaptcha/api.js'></script><?php
}
?>

    <div class="container">
        <div class="row">
            <div class='col-md-3'></div>
            <div class="col-md-6">
                <div class="login-box well">
                    <form action="" method="post">
                        <legend>Sign In</legend>
                        <div class="form-group">
                            <label for="username-email">E-mail or Username</label>
                            <input value='' name="username" id="username-email" placeholder="E-mail or Username" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" name="password" value='' placeholder="Password" type="password" class="form-control"/>
                        </div>
                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-default btn-login-submit btn-block m-t-md" value="Login"/>
                        </div>
                        <span class='text-center hidden'><a href="/resetting/request" class="text-sm">Forgot Password?</a></span>
                        <div class="form-group hidden">
                            <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                            <a href="/register/" class="btn btn-default btn-block m-t-md">Create an account</a>
                        </div>
                    </form>
                    <?php
                    // Nếu không có app id thì ko được đăng nhập qua facebook
                    if (defined("APP_ID")) {
                        ?>
                        <p class="text-center">
                            <a href="<?=$url_fb;?>"><img style="max-width:100%" src="/asset/data/login_w_facebook.png"></a>
                        </p>
                        <?php
                    } ?>
                    <p class="text-center">
                        <a href='/friends' class="btn btn-primary btn-lgn"><i class="fa fa-user"></i> My Friends</a>
                        <a href='/blog' class="btn btn-primary btn-lgn"><i class="fa fa-book"></i> Blog</a>
                        <a href='/friends/faces' class="btn btn-primary btn-lgn"><i class="fa fa-smile-o"></i> Face</a>
                    </p>
                    <?php
                    //recapcha
                    if (RECAPTCHA) {
                        ?>
                        <div class="g-recaptcha" data-sitekey="6LfycxoTAAAAALXMmet9_axitVj5lObK5BXC9x9r"></div><?php
                    }
                    ?>

                </div>
            </div>
            <div class='col-md-3'></div>
        </div>
    </div>
<?php $this->load->view('_includes/footer'); ?>