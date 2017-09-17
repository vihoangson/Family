/**
 * Xử lý load modal khi truyền ngày vào
 *
 * @param date_search
 */
function load_data_ajax(date_search) {
    $.get("/api/kyniem/get_in_date", {d: date_search}, function (e) {
        if (e) {
            handle_put_data_to_modal_box(date_search, e);
            // Show modal
            $("#modal-general").modal("show");
        }
    })
}

/**
 * Handel put data to model box
 *
 * @param date_search
 * @param e
 */
function handle_put_data_to_modal_box(date_search, e) {
    if(!$("div.content_kyniem").length){
        $("<div class='content_kyniem'></div>").appendTo($('#modal-general .modal-body'));
    }else{
        $(box_kyniem).html("");
    }
    box_kyniem = "#modal-general .modal-body .content_kyniem";
    // Set title mặc định cho modal
    $("#modal-general .modal-title").html("Nhật ký gia đình ngày: " + date_search);

    // Rửa html cho body modal
    $(box_kyniem).html("");

    // Duyệt các tin trong 1 ngày
    $.each(e, function (k, v) {

        // Nếu có title thì gắn không thì để mặc định
        if (v.kyniem_title) {
            $(box_kyniem).append("<h3>" + v.kyniem_title + "</h3><br>");
        }

        // Gán nội dung cho từng mục tin
        $(box_kyniem).append("" + v.kyniem_content + "<hr>");
    });
}

// Action cho ô date trong history wrote blog
$('.has').click(function () {
    // Gọi hàm chuẩn bị nội dung modal
    load_data_ajax($(this).attr("title"));
});