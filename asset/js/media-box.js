	$.fn.open_media = function(opt){
		opt.callbackevent_before(this);
		this.click(function(event) {
			$.boximg();
			opt.callbackfn($(this));
		});
	}

	$.boximg= function(){
		$("#modal-upload-media .modal-body").load("/ajax/do_ajax/load_media");
		$("#modal-upload-media").modal("show");
		$.reload_media();
	}


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
			$(".list-media").addClass('autoheight');
			$.each(dataxx, function(index, val) {
				var ele_img = $("\
					<div class='col-sm-3 thumbnail text-center'>\
						<img src='"+val.files_path+val.files_name+"'>\
					</div>\
				")
				ele_img.appendTo(".list-media");
			});
			$('.list-media > div').autoheight();
		});

	}

