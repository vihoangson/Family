	$.boximg= function(){
		$("#modal-upload-media .modal-body").load("/ajax/do_ajax/load_media");
		$("#modal-upload-media").modal("show");
		$.reload_media();
	}

	$(".insert-img").click(function(event) {
		$.boximg();
	});

	$(document).on("click",".upload-btn",function(){
		$("#upload_form input[type='file']").trigger("click");
	});

	$(document).on("change","#upload_form input[type='file']",function(){
		$("#upload_form").ajaxForm({
			url:"/ajax/do_ajax/save_img_box",
			beforeSend: function(xhr) {
				$("progress").attr( "value",0);
				$("progress").removeClass('hidden');
			},
			uploadProgress: function(event, position, total, percentComplete) {
				$("progress").attr( "value",percentComplete);
			},
			complete: function (hr){
				$("progress").addClass('hidden');
				if($("#upload_form").data("reload")==true){
					location.reload();
				}else{
					$.reload_media();
				}
			}
		}).submit();
	});

	$.reload_media = function (){
		$.post('/ajax/do_ajax/load_img_media', null, function(data, textStatus, xhr) {
			dataxx = JSON.parse(data);
			if(dataxx.status == "error"){
				alert("Error");
				return;
			}
			$(".list-media").html('');
			console.log(dataxx);
			$.each(dataxx, function(index, val) {
				var ele_img = $("\
					<div class='col-sm-3 thumbnail text-center'>\
						<img src='"+val.files_path+val.files_name+"'>\
					</div>\
				")
				ele_img.appendTo(".list-media");
			});
		});
	}

	$(document).on("click","#modal-upload-media .modal-body img",function(){
		src = "![]("+$(this).attr("src")+")";
		$("#modal-upload-media").modal("hide");
		val_text = $("#content").val();
		$("#content").val(val_text+src);
	})