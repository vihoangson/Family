<?php
$data_header = [
    "breadcrumb"  => [
        "Blog" => "",
    ],
    "custom_html" => '',
];
$this->load->view('_includes/header', $data_header); ?>
<?php
if ($this->session->userdata('user')) {
    ?><p><a href="/blog/input" class="btn btn-info"><i class="fa fa-plus"></i> Create blog</a></p><?php
}
?>
    <br>
<?php
if ($rs) {
    foreach ($rs as $key => $value) {
        ?><h4><a href='/blog/detail/<?=$value->id;?>-<?=createSlug($value->blog_title);?>'><?=$value->blog_title;?></a>
        </h4><?php
        echo substr(filter_string($value->blog_content), 0, 200);
        ?>
        <div class="text-right">
        <a href='/blog/detail/<?=$value->id;?>-<?=createSlug($value->blog_title);?>' class="btn btn-info">Read more »</a>
        </div>
        <?php
        if ($this->session->userdata('user')) {
            ?><p><a href="/blog/input/<?=$value->id;?>"><i class="fa fa-pencil"></i></a></p><?php
        }
        ?>

        <hr>
        <?php
    }
} else {
    echo "<h2>No data</h2>";
}
?>

<?php $this->load->view('_includes/footer');
?>