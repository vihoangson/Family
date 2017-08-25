<style>    <?=$custom_css?></style>
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=base_url();?>"><img style="margin-top:-6px;display:inline;" src="/favicon.ico">
            My Family
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?=base_url();?>">Trang chủ</a></li>
            <?=($this->Options_model->get_option("popup_flag")->option_content == 1 ?
                '<li><a href="#" id="button_popup">Popup</a></li>' : '')?>
        </ul>
        <?php
        if ($this->session->userdata('user')) {
            //============ ============  ============  ============ 
            // There's session
            //============ ============  ============  ============ 
            ?>
            <form action="/homepage/search_keyword" class="navbar-form navbar-left" role="search" method="post">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm">
                </div>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:void(0)" data-toggle="tooltip" id="sync_db" title="Sync db from server">
                        <div class="glyphicon glyphicon-refresh"></div>
                    </a></li>
                <li>
                    <a href="<?=base_url();?>calendar" id="button_calendar" data-toggle="tooltip" title="Xem lịch của gia đình nha">Lịch gia đình</a>
                </li>
                <li><a href="#" data-toggle="tooltip" title="Đếm tuổi của Kem">Bé Kem ( <?=get_var_countdown();?> )</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url();?>admin"><i class="fa fa-user"></i> Admin page</a></li>
                        <li><a href="<?=base_url();?>blog"><i class="fa fa-book"></i> Blog</a></li>
                        <li><a href="<?=base_url();?>timeline"><i class="fa fa-image"></i> Time line</a></li>
                        <li><a href="<?=base_url();?>homepage/slide"><i class="fa fa-image"></i> Ageing picture</a></li>
                        <li><a href="<?=base_url();?>idear"><i class="fa fa-eye"></i> Idear</a></li>
                        <li>
                            <a href="<?=base_url();?>homepage/custom/tool"><i class="fa fa-facebook"></i> Các công cụ liên quan</a>
                        </li>
                        <li><a href="<?=base_url();?>admin/admin_page/custom_css"><i class="fa fa-gear"></i> Custom Css</a>
                        </li>
                        <li><a href="<?=base_url();?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <?php
        } else {
            //============ ============  ============  ============ 
            //	Don't have session
            //============ ============  ============  ============ 
            ?>
            <ul class="nav navbar-nav ">
                <li><a href="/homepage/login">Login</a></li>
            </ul>
            <?php
        } ?>
    </div><!-- /.navbar-collapse -->
</nav>
<?php custom_banner("top"); ?>

<?php echo $history_wrote_blog; ?>
