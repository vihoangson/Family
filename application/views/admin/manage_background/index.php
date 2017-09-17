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
        <label for="fileupload" class="btn btn-primary">Upload file</label>
    <input class="hidden" id="fileupload" type="file" name="userfile" multiple="" data-url="/ajax_up_files/background" accept="image/x-png,image/gif,image/jpeg">
    <?php

$this->load->view('_includes/footer_admin');
