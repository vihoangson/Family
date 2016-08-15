$(document).on("click",".nav-tabs li",function(){
	var name_tab = $(this).find("a").attr("href");
	$(name_tab+" img").each(function(index, el) {
		var src = $(this).data("original");
		$(this).attr("src",src);
	});
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
	$("#modal-general .modal-body").html('<form action="/ajax/do_ajax/upload_img" method="post" id="change-banner" enctype="multipart/form-data"><input type="file" name="file_x" class="form-control" id="fileToUpload"> </form>');;
	$("#modal-general").modal("show");
});

$(document).on("change","#change-banner",function(){
	$("#change-banner").submit();
});
