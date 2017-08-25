<?php $this->load->view('_includes/header_admin'); ?>
<div class="list-group">
    <a href="/homepage/custom/sample_markdown" class="list-group-item">Mark down</a>
    <a href="/asset/data/preview_markdown.png" class="list-group-item" target="_blank">IMG Mark down</a>
</div>


<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Panel title</h3>
    </div>
    <div class="panel-body">
        <div class="list-group">
            <a href="/admin/users/index" class="list-group-item"><i class="fa fa-user"></i> Manager user</a>
            <a href="/admin/users/change_password" class="list-group-item"><i class="fa fa-paw"></i> Change password</a>
            <a href="/admin/files_controller/show" class="list-group-item"><i class="fa fa-list"></i> List img</a>
            <a href="/admin/files_controller/do_upload" class="list-group-item"><i class="fa fa-upload"></i> Upload img</a>
            <a href="<?=base_url();?>admin/daily_controller/show_markdown" class="list-group-item"><i class="fa fa-sticky-note"></i> Take note</a>
            <a href="/admin/status" class="list-group-item"><i class="fa fa-flag"></i> Trạng thái</a>
            <a href="/admin" class="list-group-item"><i class="fa fa-flag"></i> Admin page</a>
        </div>
    </div>
</div>

<h1>Params</h1>

<hr>


<h2>Size video</h2>
<div class="input-group">
    <input type="text" class="form-control option-value" name="size-video" aria-label="..." value="<?=$options["size-video"]->option_content?>">
    <div class="input-group-btn">
        <button class="btn btn-default save-button">Save</button>
    </div>
</div>

<hr>

<h2>Max size img</h2>
<div class="input-group">
    <input type="text" class="form-control option-value" name="max_size_img" aria-label="..." value="<?=$options["max_size_img"]->option_content?>">
    <div class="input-group-btn">
        <button class="btn btn-default save-button">Save</button>
    </div>
</div>


<hr>

<div class="well">
    <h2>Cron tab</h2>
    <a href="/homepage/cron" class="btn btn-default" target="_blank">
        <i class="fa fa-send"></i> Default - 6h
    </a>
    <a href="/homepage/cron/backup_db_family" class="btn btn-default" target="_blank">
        <i class="fa fa-send"></i> Sent mail back up DB - 24h
    </a>
    <a href="/homepage/cron/backup_file_images_family" class="btn btn-default" target="_blank">
        <i class="fa fa-send"></i> Sent mail back up file images - 7d
    </a>
</div>

<h1> Backup </h1>
<h4><a href="/api/ajax_action/backup_all/file_upload">Folder: file_upload</a></h4>
<h4><a href="/api/ajax_action/backup_all/images">Folder: images</a></h4>
<h4><a href="/api/ajax_action/backup_all/db">Backup db</a></h4>

<?php show_social(); ?>

<?php $this->load->view('_includes/footer_admin'); ?>
