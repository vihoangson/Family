<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Setting"         => "/setting",
        "File list"       => "/admin/files_controller/show",
        "Upload hình ảnh" => ""
    ],
    "custom_html" => '<h1> Nơi up hình ảnh cần thiết </h1>',
];
$this->load->view('_includes/header_admin', $data_header); ?>
<form action="/admin/files_controller/do_upload" method="POST" role="form" enctype="multipart/form-data">
    <legend>Upload file</legend>
    <div class="form-group">
        <label for="">Tiêu đề</label>
        <input type="text" name="file_title" class="form-control" id="" placeholder="Input field">
    </div>
    <div class="form-group">
        <label for="">File</label>
        <input type="file" name="userfile" class="form-control" id="" placeholder="Input field">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
</form>

<?php $this->load->view('_includes/footer_admin'); ?>
