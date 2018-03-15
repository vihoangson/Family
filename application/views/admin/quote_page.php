<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Admin" => "",
    ],
    "custom_js"   => '',
    "custom_html" => '<h1> <i class="fa fa-sticky-note"></i> Admin page </h1>',
];
$this->load->view('_includes/header_admin', $data_header);

echo "<h3>Quote - Kinh nghiệm của người đi trước</h3>";
if($quotes != []){
    foreach ($quotes as $key => $value){
        ?>
        <blockquote class="blockquote">
            <p class="mb-0"><?= $value->content  ?></p>
        </blockquote>
        <?php

    }
}else{
    echo "<h3>Không có dữ liệu</h3>";
}

?>
    <a class="btn btn-primary" target="_blank" href='/phpliteadmin.php?table=quotes&action=row_view'>Link update</a>
<?php
$this->load->view('_includes/footer_admin');
