$(".smile-button").click(function(){
	id = $(this).parents(".row-tail").find("input").data("id");
	$("#modal-general .modal-body").data("id",id);
	$("#modal-general .modal-body").load('/ajax/do_ajax/index');
	$("#modal-general").modal("show");
});

$(document).on("click",".avatar_element",function(){
	id = ($("#modal-general .modal-body").data("id"));
	$(".row-tail input[data-id='"+id+"']").val("![]("+$(this).attr("src")+")");
	$("#modal-general").modal("hide");
	$(".row-tail input[data-id='"+id+"']").parents(".row-tail").find('button').trigger("click");
});
