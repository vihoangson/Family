<?php $this->load->view('_includes/header',["css"=>[base_url()."asset/css/login.css"]]); ?>
<div class="container">
    <div class="row">
        <div class='col-md-3'></div>
        <div class="col-md-6">
            <div class="login-box well">
                    <form action="" method="post">
                        <legend>Sign In</legend>
                        <div class="form-group">
                            <label for="username-email">E-mail or Username</label>
                            <input value='' name="username" id="username-email" placeholder="E-mail or Username" type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password"  name="password" value='' placeholder="Password" type="password" class="form-control" />
                        </div>
                        <div class="input-group">
                          <div class="checkbox">
                            <label>
                              <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-default btn-login-submit btn-block m-t-md" value="Login" />
                        </div>
                        <span class='text-center'><a href="/resetting/request" class="text-sm">Forgot Password?</a></span>
                        <div class="form-group">
                            <p class="text-center m-t-xs text-sm">Do not have an account?</p> 
                            <a href="/register/" class="btn btn-default btn-block m-t-md">Create an account</a>
                        </div>
                    </form>
                    <p class="text-center"><a href="<?= $url_fb; ?>"><img style="max-width:100%" src="/asset/data/login_w_facebook.png"></a></p>
            </div>
        </div>
        <div class='col-md-3'></div>
    </div>
</div>
<?php $this->load->view('_includes/footer'); ?>