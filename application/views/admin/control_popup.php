<?php
$data_header = [
    "css"         => [],
    "js"          => [],
    "breadcrumb"  => [
        "Admin"         => "/admin",
        "Control popup" => ""
    ],
    "custom_js"   => '',
    "custom_html" => '<h1> <i class="fa fa-image"></i> Control popup </h1>',
];
$this->load->view('_includes/header_admin', $data_header);
?>
    <form action="" method="POST" role="form" id='form_popup'>
        <legend>Controll popup</legend>
        <div class="form-group">
            <label for="">Bật/Tắt Popup</label>
            <div class="material-switch">
                <input id="someSwitchOptionPrimary" name="flag_toggle" value="1" type="checkbox" <?=($flag->option_content == 1 ?
                    "checked" : "");?>/>
                <label for="someSwitchOptionPrimary" class="label-primary"></label>
            </div>
        </div>
        <div class="form-group detail_popup" <?=($flag->option_content == 1 ? "" : 'style="display:none;"');?> >

            <label for="">Bật/Tắt mở 1 lần đầu </label>
            <div class="material-switch">
                <input id="someSwitchOptionPrimary_session" name="popup_session" value="1" type="checkbox" <?=($popup_session->option_content == 1 ?
                    "checked" : "");?>/>
                <label for="someSwitchOptionPrimary_session" class="label-info"></label>
            </div>
            <p>
                <small><i class="fa fa-warning"></i> Bật xanh là chỉ mở 1 lần duy nhất khi vào</small>
            </p>

            <label for="">Nội dung popup</label>
            <div class="thumbnail"><?=check_popup($rs->option_content);?></div>
            <div class="input-group">
                <input type="text" name="content" value="<?=$rs->option_content;?>" class="form-control" placeholder="Content popup">
                <span class="input-group-btn">
						<button class="btn btn-default brower-img" type="button">Browser!</button>
					</span>
            </div><!-- /input-group -->

        </div>
        <button type="submit" class="btn btn-primary pull-right">Lưu popup »</button>
    </form>

    <div class="modal fade" id="modal-id-browser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Chọn hình ảnh</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script>
        $.checkFlag = function () {
            if ($("[name='flag_toggle']:checked").val() == 1) {
                $(".detail_popup").fadeIn(500);
            } else {
                $(".detail_popup").fadeOut(500);
            }
        }
        $.checkFlag();

        $("#someSwitchOptionPrimary").change(function () {
            $.checkFlag();
            $(this).parents("form").submit();
        });

        $("#someSwitchOptionPrimary_session").change(function () {
            $(this).parents("form").submit();
        });

        $.load_brower = function () {
            $("#modal-id-browser .modal-body").load("/ajax/files_ajax");
            $("#modal-id-browser").modal("show");
        }

        $(document).on("click", ".thumbnail", function () {
            $("[name='content']").val($(this).find("img").attr("src"));
            $("#modal-id-browser").modal("hide");
        });

        $(".brower-img").click(function () {
            $.load_brower();
        });

    </script>
<?php
$this->load->view('_includes/footer_admin');
