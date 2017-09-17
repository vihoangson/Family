<?php custom_banner("bottom"); ?>
<!-- Block in footer -->
<div class="text-center center-block">
    <p class="txt-railway">- Sweet house -</p>
    <img src="/asset/data/Sweet_House.gif">
    <br/>
    <a href="https://www.facebook.com/conduonghanhphuc/" target="_blank"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
    <a href="http://youtube.com/vihoangson/" target="_blank"><i id="social-tw" class="fa fa-youtube-square fa-3x social"></i></a>
    <a href="https://picasaweb.google.com/106931759947217084754" target="_blank"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
    <a href="mailto:vihoangson@gmail.com" target="_blank"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
</div>
<!-- End block in footer -->
</div>

<?php
//============ ============ ============  ============  ============  ============ 
// Blazy - Lazy load image
//
?>
<script src="/asset/bower_components/bLazy/blazy.min.js"></script>
<script>
    $(document).ready(function () {
        var blazy = new Blazy({
            selector: "img"
        });
    });
</script>
<?php
//
//============ ============ ============  ============  ============  ============ 
?>
<script>
    //============ ============  ============ ============
    //  Gắn hình mặt cười trong phần nhập liệu
    //============ ============  ============ ============
    jQuery.fn.extend({
        insertAtCaret: function (myValue) {
            return this.each(function (i) {
                if (document.selection) {
                    //For browsers like Internet Explorer
                    this.focus();
                    sel = document.selection.createRange();
                    sel.text = myValue;
                    this.focus();
                }
                else if (this.selectionStart || this.selectionStart == '0') {
                    //For browsers like Firefox and Webkit based
                    var startPos = this.selectionStart;
                    var endPos = this.selectionEnd;
                    var scrollTop = this.scrollTop;
                    this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos, this.value.length);
                    this.focus();
                    this.selectionStart = startPos + myValue.length;
                    this.selectionEnd = startPos + myValue.length;
                    this.scrollTop = scrollTop;
                } else {
                    this.value += myValue;
                    this.focus();
                }
            })
        }
    });

    $(".emotion_icon").click(function () {
        rg = $("#content").val().match(/(\([a-z]*\)|\:\))/g);
        $("#content").insertAtCaret(" " + $(this).attr("alt") + " ");
        $(".icon_box").hide();
    });
    //============ ============  ============ ============
    // END Gắn hình mặt cười trong phần nhập liệu
    //============ ============  ============ ============

    //============ ============  ============ ============
    // Tagit trong phần nhập liệu
    //============ ============  ============ ============
    $(".tag_ele").click(function () {
        rg = $("#content").val().match(/(\([a-z]*\)|\:\))/g);
        $("#content").insertAtCaret(" " + $(this).attr("alt") + " ");
    });
    //============ ============  ============ ============
    // END Tagit trong phần nhập liệu
    //============ ============  ============ ============

    //============ ============  ============ ============
    // img click
    //============ ============  ============ ============
    $('.image-link').magnificPopup({
        gallery: {enabled: true},
        type: 'image',
        delegate: 'a'
    });
    //============ ============  ============ ============
    // END img click
    //============ ============  ============ ============

</script>

<script src="<?=base_url();?>asset/js/comment.js"></script>
<script src="<?=base_url();?>asset/js/script.js"></script>
<script src="<?=base_url();?>asset/js/box_ky_niem_date.js"></script>

<?php
//============ ============  ============  ============ 
//  Phần popup đầu tiên
if ($this->Options_model->get_option("popup_flag")->option_content == 1) {
    // option popup
    if ($this->Options_model->get_option("popup")->option_content) {

        ?>
        <div class="modal fade popup" id="modal-general">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

        <div class="modal fade popup" id="modal-id-popup">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <!-- <h4 class="modal-title">Modal title</h4> -->
                    </div>
                    <div class="modal-body"><?=check_popup($this->Options_model->get_option("popup")->option_content);?></div>
                </div>
            </div>
        </div>
        <script>
            <?php
            if($this->Options_model->get_option("popup_session")->option_content == 1 && $this->session->userdata('popup') != 1){
            ?>
            $("#modal-id-popup").modal("show");
            <?php
            $this->session->set_userdata(['popup' => 1]);
            }else{
            ?>
            $("#button_popup").click(function () {
                $("#modal-id-popup").modal("show");
                return false;
            });
            <?php
            }
            ?>
        </script>
        <?php
    }
}
// End popup
//============ ============  ============  ============ 
?>
<script>
    // ============ ============  ============  ============ 
    // [Start]
    // Swal: Sweet Alert (bootstrap Sweet Alert)
    // Type: Input
    // ============ ============  ============  ============ 
    if (false) {
        swal({
            title: "An input!",
            text: "Write something interesting:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Write something"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
            $.post('/api/options_control/changeuser', {name: inputValue}, function (data, textStatus, xhr) {

            });
            swal("Nice!", "You wrote: " + inputValue, "success");
        });
    }
    // ============ ============  ============  ============ 
    // [Stop]
    // Swal: Sweet Alert (bootstrap Sweet Alert)
    // Type: Input
    // ============ ============  ============  ============ 
</script>

<?php
//============ ============  ============  ============ 
// Modal calendar family
// @since: 20160715132103
// 
?>
<script>
    $("#button_calendar").click(function (event) {
        $("#modal-id-popup .modal-title").html("Lịch gia đình");
        $("#modal-id-popup .modal-body").html($(".box_calendar").html());
        $("#modal-id-popup").modal();
        return false;
    });
</script>
<div class="hidden box_calendar">
    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=atpk1cqfhu1daimocnnosmv9eo%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=Asia%2FSaigon" style="border-width:0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
</div>
<?php
//
//============ ============  ============  ============ 
?>
</body>
</html>
