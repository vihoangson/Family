$(document).on("click",".nav-tabs li",function(){
	var name_tab = $(this).find("a").attr("href");
	$(name_tab+" img").each(function(index, el) {
		var src = $(this).data("original");
		$(this).attr("src",src);
	});
});

$('.has').click(function(){
	var date_search = $(this).attr("title");
	$.get("/api/kyniem/get_in_date",{d:$(this).attr("title")},function(e){
		var v2 = "";

		$("#modal-general .modal-title").html("Nhật ký gia đình ngày: "+date_search);
		$("#modal-general .modal-body").html("");
		$.each(e,function(k,v){
			if(v.kyniem_title){
				$("#modal-general .modal-body").append("<h3>" + v.kyniem_title + "</h3><br>");
			}
			$("#modal-general .modal-body").append("" + v.kyniem_content + "<hr>");
		});
		$("#modal-general").modal("show");
	})
});

$(document).on("click",".avatar_element",function(){
	id = ($("#modal-general .modal-body").data("id"));
	$(".row-tail input[data-id='"+id+"']").val("![]("+$(this).attr("src")+")");
	$("#modal-general").modal("hide");
	$(".row-tail input[data-id='"+id+"']").parents(".row-tail").find('button').trigger("click");
});

$.fn.autoheight = function (){
	this.find("img").css({maxHeight: 100 })
}

$('.row.autoheight > div').autoheight();

//============ ============  ============  ============ 
//

	// Button add kỷ niệm
	$("#button_add").click(function(event) {
		$("#modal-id").modal();
	});

	// Button delete kỷ niệm
	$(".delete_b").click(function() {
		return confirm("Bạn có muốn xóa ?");
	});

//
//============ ============  ============  ============ 

//============ ============  ============  ============ 
//  Thay đổi năm trong combo box trong trang kỷ niệm
	$(".change-year").change(function(event) {
		location.href = "/homepage/chang_year/"+$(this).val();
	});
//
//============ ============  ============  ============ 

//============ ============  ============  ============ 
// Nút thêm smile
//

	$(document).on('click', '.smile-button', function(event) {
		id = $(this).parents(".row-tail").find("input").data("id");
		$("#modal-general .modal-body").data("id",id);
		$("#modal-general .modal-body").load('/ajax/do_ajax/index',function(){
			$("#home img").each(function(index, el) {
				var src = $(this).data("original");
				$(this).attr("src",src);
			});	
		});
		$("#modal-general").modal("show");
	});
//
//============ ============  ============  ============ 

$(".change_banner").click(function(){
	$("#modal-general .modal-title").html("Change banner");
	$("#modal-general .modal-body").html('<form action="/ajax/do_ajax/upload_img" method="post" id="change-banner" enctype="multipart/form-data"><input type="hidden" name="position" value="'+$(this).data("position")+'"><input type="file" name="file_x" class="form-control" id="fileToUpload"> </form>');;
	$("#modal-general").modal("show");
});

$(document).on("change","#change-banner",function(){
	$("#change-banner").submit();
});
