<?php
$data_header = [
    "css"         => [],
    "js"          => ["/asset/js/custom_css.js"],
    "breadcrumb"  => [
        "Setting"    => "/setting",
        "Custom Css" => "",
    ],
    "custom_html" => '<h1> Custom Css </h1>',
];
$this->load->view('_includes/header_admin', $data_header); ?>
    <form action="" id="custom_css" method="post">
        <textarea style="width:100%;height:300px;" name="content_css"><?=$custom_css?></textarea>
        <div>
            <button type="submit" class="btn btn-primary">Save css</button>
        </div>

        <h3>Bảng màu gợi ý</h3>
        <a target="_blank" href="http://www.w3schools.com/colors/colors_names.asp">http://www.w3schools.com/colors/colors_names.asp</a>
    </form>

<h1>Archive custom css</h1>
<?php
    foreach ((array)$custom_css_archive as $key => $value){
        echo '<h4>At '.date('Y-m-d h:i:s',$key).'</h4>';
        echo '<textarea style="width:100%;">'.$value.'</textarea>';
        echo '<hr>';
    }
?>

<?php $this->load->view('_includes/footer_admin'); ?>