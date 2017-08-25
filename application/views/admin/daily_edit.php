<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Setting"    => "/setting",
        "Daily"      => "/admin/daily_controller",
        "Edit daily" => ""
    ],
    "custom_js"   => '
		<script src="/asset/bower_components/tinymce/tinymce.min.js"></script>
		<script>
			$(document).ready(function() {
				
				tinymce.init({ selector:\'.tinymce_box\' ,
        plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
        ],
			});
			});
		</script>
	',
    "custom_html" => '<h1> <i class="fa fa-sticky-note"></i> Note </h1>',
];
$this->load->view('_includes/header', $data_header); ?>

    <form action="<?=($markdown ? "edit_markdown" : "edit");?>" method="post">
        <?php
        $content = file_get_contents($file);
        if ($markdown == true) {
            $class_tinymce = "";
        } else {
            $class_tinymce = "tinymce_box";
        }
        echo "<textarea name='html' style='height:400px' class='" . $class_tinymce . " form-control'>" . htmlspecialchars($content) . "</textarea>";
        ?>
        <button type="submit" class="btn btn-primary btn-lg btn-block top-buffer">Save note</button>
    </form>

<?php $this->load->view('_includes/footer'); ?>