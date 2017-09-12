<?php
$title_page = 'Background manager';

$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Admin" => "",
    ],
    "custom_js"   => '',
    "custom_html" => "<h1> <i class=\"fa fa-sticky-note\"></i> $title_page </h1>",
];
$this->load->view('_includes/header_admin', $data_header);

echo "<h3>$title_page </h3>";

    ?>
        <label for="input_upload" class="btn btn-primary">Upload file</label>
        <input id="input_upload" class="hidden" type="file">
    <?php

$this->load->view('_includes/footer_admin');
