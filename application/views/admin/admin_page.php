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

echo "<h3>Admin page </h3>";

?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Satus</h3>
        </div>
        <div class="panel-body">
            <?=$content;?>
            <button class="btn btn-default load_status">Load status</button>
        </div>
    </div>
    <script>
        $(".load_status").click(function (event) {
            if ($(".fa-spin").length > 0) return;
            $(".load_status").prepend('<i class="fa fa-refresh fa-spin"></i> ')
            $.get('/ajax/do_ajax/get_status', function (data) {
                $(".load_status").after(data);
                $(".load_status").fadeOut(300);
            });
        });
    </script>
<?php
$this->load->view('_includes/footer_admin');
