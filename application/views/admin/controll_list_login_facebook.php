<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Admin"               => "/admin",
        "List login Facebook" => ""
    ],
    "custom_js"   => '',
    "custom_html" => '<h1> <i class="fa fa-sticky-note"></i> List login Facebook </h1>',
];

$this->load->view('_includes/header_admin', $data_header);
?>
    <form action="" method="POST" role="form">
        <legend>List login facbook</legend>

        <div class="form-group">
            <label for="">Email</label>
            <textarea name="email" class="form-control" id="" placeholder="Input field" rows="10"><?=implode("\n", json_decode($rs->archive_content, true));?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php
$this->load->view('_includes/footer_admin');
