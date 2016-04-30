	$(".box-comment li").append("<span class='del-c'>x</span>");
	$(document).on("click",".del-c",function(){
		if(!confirm("Bạn có muốn xóa ?")){
			return;
		}
		id = $(this).parent().data("id");		
		this_c = $(this);
		$.post('homepage/ajax_delete_comment', {id:id}, function(data, textStatus, xhr) {
			if(data == "1"){
				this_c.parent().remove();
			}
		});
	});

	$(".input-comment").keydown(function(event){
		//return false;
		if(event.which==13){
			send_comment($(this));
		}
	});

	$(".send-button").click(function(event) {
		send_comment($(this).parents(".row-tail").find(".input-comment:first"));
	});

	function send_comment(this_s){
		id = this_s.data("id");
		value = this_s.val();
		this_c = this_s;
		$.post('homepage/ajax_post_comment', {id:id,value:value}, function(data, textStatus, xhr) {
			this_c.val("");
			rs = JSON.parse(data);
			this_ul = this_c.parents(".box-comment").find("ul");
			this_ul.text("");
			$.each(rs,function(index,val){
				var tmp_ele = $(".ele_comment:first").clone();
				tmp_ele.find("li").data("id",val.id);
				tmp_ele.find("img").attr("src","/asset/images/"+val.user_avatar+"");
				tmp_ele.find(".username b").text(val.username);
				tmp_ele.find(".comment_create small").text(val.comment_create);
				tmp_ele.find(".comment_content").html(val.comment_content);
				this_ul.prepend(tmp_ele);
			});
			$(".del-c").remove();
			$(".box-comment li").append("<span class='del-c'> </span>");
		});
	}

	$("#button_add").click(function(event) {
			$("#modal-id").modal();
	});

	$(".delete_b").click(function() {
		return confirm("Bạn có muốn xóa ?");		
	});