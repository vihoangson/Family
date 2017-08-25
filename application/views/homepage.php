<?php $this->load->view('_includes/header', ["js" => []]); ?>
    <div class="row">
        <h2>Time Line</h2>
    </div>
    <!-- #List Year -->
    <select class="form-control change-year" style="width:100px;">
        <?php
        for ($i = 2015; $i <= date("Y"); $i++) {
            ?>
            <option value="<?=$i;?>" <?=((int) $this->session->userdata("year") == $i ? "selected" :
                "");?> > <?=$i;?> </option>
            <?php
        }
        ?>
    </select>
    <div class="text-right">
        <button type="button" id="button_add" class="btn btn-primary">Thêm kỷ niệm</button>
    </div>
    <hr>
    <div class="qa-message-list" id="wallmessages">
        <?php

        foreach ($kn as $key => $value) {
            $this->load->view("_includes/ele_kyniem", compact("value", "comment", "key"));
        }// end foreach

        ?>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-default loadmore">Load more »</button>
    </div>
    <!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hạnh phúc là một quá trình không phải là đích đến</h4>
                </div>
                <div class="modal-body">
                    <?php $this->load->view('ajax_add_new', ["list_tag" => $tags]); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<?php

//============ ============  ============  ============ 
//  Show tất cả tác tag trong source
//  20160705152744
//  
if ($tags) {
    ?>
    <div id="tags_list">
        <h3>Tags</h3>
        <?php
        foreach ((array) $tags as $key => $value) {
            echo "<span><a href='/homepage/tags/$value'> #" . $value . " </a></span>";
        }
        ?>
    </div>
    <?php
}
//
//============ ============  ============  ============ 
?>
    <script>

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                loadKyniem();
            }
        });

        $(".loadmore").click(function (event) {
            loadKyniem();
        });

        var loadKyniem = function () {
            var step = $(".message-item").last().data("step") + 1;
            if ($(".fa-spin").length == 0) {
                $("#wallmessages").append('<div class="text-center"><i style="color:#828282;" class="fa fa-refresh fa-spin fa-3x"></i></div>');
                $.get('/homepage/ajax_autoload/' + step, function (data) {
                    $(".fa-spin").remove();
                    if (data) {
                        $("#wallmessages").append(data);
                    } else {
                        alert("Hết rồi!");
                    }
                });
            }
        }

    </script>

    <!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<?php $this->load->view('_includes/footer'); ?>