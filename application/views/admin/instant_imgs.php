<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Admin"        => "/admin",
        "Instant imgs" => "",
    ],
    "custom_html" => '<h1> Nơi up ảnh nhanh </h1>',
];
$this->load->view('_includes/header_admin', $data_header); ?>
<div class="row autoheight">
    <?php
    foreach ((array) $data as $key => $value) {
        ?>
        <div class='col-sm-3'>
            <a data-id="<?=$key;?>" href="javascript:void(0)" class="thumbnail open-modal"><img src="<?=($value ?
                    $value : "/asset/data/no_image.png");?>"></a>
        </div>
        <?php
    }
    ?>
    <div class='col-sm-3 add-more'>
        <a data-id="" href="javascript:void(0)" class="thumbnail "><img src="/asset/data/no_image.png"></a>
    </div>
</div>
<?php show_modal_media("instant_img"); ?>

<script>
    $(".add-more").click(function (event) {
        var cln = $(this).clone().removeClass('.add-more');
        $(this).before(cln);
        $.post('/ajax/do_ajax/save_img_instant', {
            id: $(".open-modal").length + 1,
            src: ""
        }, function (data, textStatus, xhr) {
            location.reload();
        });
    });
    $(".open-modal").open_media({
        open_style: "fast",
        callbackfn: function (selector_this) {
            $(".current_img").removeClass('current_img');
            selector_this.addClass('current_img');
        },
        callbackevent_before: function (selector_this) {
            $(document).on("click", "#modal-upload-media .modal-body img", function () {
                console.log($(".current_img").data('id'));
                $.post('/ajax/do_ajax/save_img_instant', {
                    id: $(".current_img").data('id'),
                    src: $(this).attr("src")
                }, function (data, textStatus, xhr) {
                    console.log(data);
                });
                $(".current_img").find("img").attr("src", $(this).attr("src"));
                $(".current_img").removeClass('current_img')
                $("#modal-upload-media").modal("hide");
            });
        },
    });
</script>
<?php $this->load->view('_includes/footer_admin'); ?>
