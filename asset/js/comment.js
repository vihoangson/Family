	// Thêm vào tất cả các comment dấu delete
	$(".box-comment li").append("<span class='del-c'>x</span>");

	// Sự kiện cho nút xóa comment
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

	// Bấm enter để gửi comment
	$(".input-comment").keydown(function(event){
		if(event.which==13){
			send_comment($(this));
		}
	});
	// Bấm vào nút send để gửi comment
	$(".send-button").click(function(event) {
		send_comment($(this).parents(".row-tail").find(".input-comment:first"));
	});

	//============ ============  ============  ============ 
	//  Hàm xử lý send comment tới server
	// homepage/ajax_post_comment
	//
		function send_comment(this_s){
			id = this_s.data("id");
			value = this_s.val();
			if(!value)
				return;
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
				notify("Thank you !");
				$(".box-comment li").append("<span class='del-c'> </span>");
			});
		}
	//
	//============ ============  ============  ============ 

