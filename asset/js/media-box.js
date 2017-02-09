	/**
	 * Modal upload model
	 *
	 * @param opt
	 */
	$.fn.open_media = function(opt){
		opt.callbackevent_before(this);
		this.click(function(event) {
			$.boximg();
			opt.callbackfn($(this));
		});
	}

	/**
	 * Action open modal-upload-model
	 */
	$.boximg= function(){
		$("#modal-upload-media .modal-body").load("/ajax/do_ajax/load_media",null,function(){
			$.reload_media();
		});
		
		$("#modal-upload-media").modal("show");
	}


	/**
	 * Event click upload button
	 */
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
			console.log("load_img");
			$.each(dataxx, function(index, val) {

				var ele_img = $("\
					<div class='col-sm-3 thumbnail text-center list-media-ele'>\
						<img data-src='"+val.files_path+val.files_name+"' src='/asset/data/icon/happy/851581_150916191762636_963523626_n.png'>\
					</div>\
				")
				ele_img.appendTo(".list-media");
			});
			console.log("end_load_img");
			$('.list-media > div').autoheight();
		});

	}

	$(document).on("click",".button_load_more_img",function(){
		$(".list-media-ele img").map(function(){
			$(this).attr("src",$(this).data("src"))
		});
	})

