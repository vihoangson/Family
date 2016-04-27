	$.boximg= function(){
		$("#modal-upload-media .modal-body").load("/ajax/do_ajax/load_media");
		$.reload_media();
		$("#modal-upload-media").modal("show");
	}
	$(".insert-img").click(function(event) {
		$.boximg();
	});


	$(document).on("click",".upload-btn",function(){
		$("#upload_form input[type='file']").trigger("click");
		$("#upload_form input[type='file']").unbind('change');
		$("#upload_form input[type='file']").change(function(event) {
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
					$.reload_media();
				}
			}).submit();
		});
	});

	$.reload_media = function (){
		$.post('/ajax/do_ajax/load_img_media', null, function(data, textStatus, xhr) {
			dataxx = JSON.parse(data);
			if(dataxx.status == "error"){
				alert("Error");
				return;
			}
			$(".list-media").html('');
			$.each(dataxx, function(index, val) {
				$("<div class='col-sm-3 thumbnail text-center'><img src='"+val.files_path+val.files_name+"'></div>").appendTo(".list-media")
			});
		});
	}

	$(document).on("click","#modal-upload-media .modal-body img",function(){
		src = $(this).attr("src");
		$("#modal-upload-media").modal("hide");
		$("#content").val(src);
	})