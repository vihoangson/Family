
/**
 * Load animate date wrote blog
 *
 * # https://github.com/vihoangson/Family/issues/19
 */
if($(".date.has").length){
	$(".date.has").addClass("cover_date");
	var m = $(".date.has");
	var max_box = m.length
	i=0;
	kk = window.setInterval(function(){
		if(i < max_box){
			m.eq(i).removeClass("cover_date");
			i++;
		}else{
			clearInterval(kk);
			return;
		}
	},10);
}



$(".save-button").click(function(){
	var input_data = $(this).parent().parent().find("input");
	value_data = input_data.val();
	key_data = input_data.attr("name");
	$.post("/api/ajax_action/change_value_options",{key:key_data,value:value_data},function(result){
		if(result.status=="error"){
			alert(result.status);
		}else{
			notify("Đã thay đổi !");
		}
	})
});

/**
 *
 * @url: /setting
 *
 */
if($("#change_max_size_img").length){

	$.get("/api/ajax_action/get_value_option",{key:"max_size_img"},function(e){
		var value_max_size_img = e.option_content;
		$("#show_max_size_img").html(value_max_size_img+"px");
	});


	$("#change_max_size_img").hide();
	$("#change_max_size_img").after("<button id='show_input'>Change</button>");
	$("#show_input").click(function(){
		$("#change_max_size_img").show();
		$("#show_input").hide();
	});
	$("#change_max_size_img").keyup(function(e){
		/**
		 * Bấm enter
		 */
		if(e.which==13){
			$.post("/api/ajax_action/change_max_size_img",{value:$("#change_max_size_img").val()},function(result){
				if(result.status=="error"){
					alert(result.status);
				}else{
					notify("Đã thay đổi !");
					$("#show_input").show();
					$("#change_max_size_img").hide();
					$("#change_max_size_img").val(result.value);
					$("#show_max_size_img").html(result.value+"px");
				}
			})
		}
	});
}


$('[data-toggle="tooltip"]').tooltip();

// Action cho nút backup db tại navbar
$("#sync_db").click(function(){
	$.post("/api/ajax_action/sync_db",function(e){
		if(e.status == "success"){
			alert("Sync done");
			window.reload();
		}else{
			alert("Sync have trouble");
		}
	});
});

$(document).on("click",".nav-tabs li",function(){
	var name_tab = $(this).find("a").attr("href");
	$(name_tab+" img").each(function(index, el) {
		var src = $(this).data("original");
		$(this).attr("src",src);
	});
});

// Action cho ô date trong history wrote blog
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

$(".media-box a.thumbnail").hover(function(){
    $(this).children("img").attr('src',$(this).attr('href'));
});

$('.add-media-button').click(function(){
	alert(123123);
});