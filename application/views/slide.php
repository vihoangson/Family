<?php $this->load->view('_includes/header', ["js" => []]); ?>
<style>
    #slide img{
        width:25%;
    }
</style>
<div id="slide">

</div>
<input id="speed" value="500">
<button id="run_script">click</button>
    <script>

        $(window).load(function(){
            $("#slide .hidden").removeClass("hidden");
        })

    $.get("/api/options_control/get_all_picture_slide",function(value){

        $.each(value,function(k,v){
            $("#slide").append('<div id="'+k+'" class="hidden"><img src="/asset/img_slide/_thumb'+v+'"><p>'+v+'</p></div>');
        });

        $("button#run_script").click(function(){
            if (typeof myVar != 'undefined'){
                clearInterval(myVar);
            }
            i=1;
            if(!$("#speed").val()){
                speed=500;
            }else{
                speed=$("#speed").val();
            }
            if(speed<100)speed=500;
            myVar = setInterval(function () {
                $("#slide div").hide();
                $("#"+(i++)).show();
                if(i>=value.length){
                    i=1;
                }
            }, speed);
        });

        $("button#run_script").trigger("click");
        $("#speed").keyup(function(){
            $("button#run_script").trigger("click");
        })
    });

    </script>
<?php $this->load->view('_includes/footer'); ?>