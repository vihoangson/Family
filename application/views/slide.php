<?php $this->load->view('_includes/header', ["js" => []]); ?>
<style>
    #slide img{
        width:25%;
    }
</style>
<div id="slide">
    <div id="1" class="hidden"><img src="/asset/img_slide/20161128.jpg"></div>
    <div id="2" class="hidden"><img src="/asset/img_slide/20161129.jpg"></div>
    <div id="3" class="hidden"><img src="/asset/img_slide/20161130.jpg"></div>
    <div id="4" class="hidden"><img src="/asset/img_slide/20161202.jpg"></div>
    <div id="5" class="hidden"><img src="/asset/img_slide/20161124.jpg"></div>
    <div id="6" class="hidden"><img src="/asset/img_slide/20161125.jpg"></div>
    <div id="7" class="hidden"><img src="/asset/img_slide/20161126.jpg"></div>
    <div id="8" class="hidden"><img src="/asset/img_slide/20161127.jpg"></div>
</div>
<input id="speed" value="500">
<button id="run_script">click</button>
    <script>

$(window).load(function(){
    $("#slide .hidden").removeClass("hidden");
})

        $("button#run_script").click(function(){
            if (typeof myVar != 'undefined')
            {
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
                if(i>=4){
                    i=1;
                }
            }, speed);
        });

        $("button#run_script").trigger("click");
        $("#speed").keyup(function(){
            $("button#run_script").trigger("click");
        })
    </script>
<?php $this->load->view('_includes/footer'); ?>