<?php
$data_header = [
    "css"         => [base_url() . "asset/bower_components/jquery-ui/themes/base/jquery-ui.min.css"],
    "js"          => [base_url() . "asset/bower_components/jquery-ui/jquery-ui.min.js"],
    "breadcrumb"  => [
        "List time line" => "/timeline",
        "Edit time line" => ""
    ],
    "custom_html" => '<p>custom_html</p>',
];
$this->load->view('_includes/header', $data_header); ?>
<?php $this->load->view('template_bs3'); ?>
<?php $this->load->view('_includes/footer'); ?>
