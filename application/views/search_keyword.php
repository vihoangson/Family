<?php $this->load->view('_includes/header', [
    "css" => [base_url() . "asset/css/login.css"],
    "js"  => [base_url() . "/asset/js/jquery.lazyload.js"]
]); ?>
    <script>
        $(document).ready(function () {
            $("img.lazy").lazyload({
                threshold: 200
            });
        });
    </script>
<?php

if ($rs) {
    echo "
        <h2>Kết quả tìm kiếm</h2>
        <hr>
        ";
} else {
    echo "
        <h2>Không tìm thấy</h2>
        ";
}

foreach ($rs as $key => $value) {
    ?>
    <div class="message-item" id="m16">
        <div class="options_icon"><span></span>
            <ul>
                <li>
                    <a href="<?=base_url();?>homepage/edit_new/<?=md5($this->config->config["encryption_key"] . "__" . $value->id);?>/<?=$value->id;?>">Edit</a>
                </li>
                <li>
                    <a class="delete_b" href="<?=base_url();?>homepage/delete_kyniem/<?=md5($this->config->config["encryption_key"] . "__" . $value->id);?>/<?=$value->id;?>">Delete</a>
                </li>
            </ul>
        </div>
        <div class="message-inner">
            <div class="message-head clearfix">
                <div class="avatar pull-left">
                    <?php switch ($value->kyniem_auth) {
                        case "Bố":
                            ?> <a href="#"><img src="<?=base_url();?>asset/data/BoSon.jpg"></a> <?php
                        break;
                        case "Mẹ":
                            ?> <a href="#"><img src="<?=base_url();?>asset/data/MeSu.jpg"></a> <?php
                        break;
                    } ?>
                </div>
                <div class="user-detail">
                    <h5 class="handle"><?=$value->kyniem_title;?></h5>
                    <div class="post-meta">
                        <div class="asker-meta">
                            <span class="qa-message-what"></span>
                            <span class="qa-message-when">
                                            <span class="qa-message-when-data"><?=date("d-m-Y H:i:s", strtotime($value->kyniem_create));?></span>
                                        </span>
                            <span class="qa-message-who">
                                            <span class="qa-message-who-pad">by </span>
                                            <span class="qa-message-who-data"><a href="#"><?=$value->kyniem_auth;?></a></span>
                                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="qa-message-content">
                <div><?=h($value->kyniem_content);?></div>
                <?php
                if ($value->kyniem_images) {
                    $images = json_decode($value->kyniem_images, true);
                    echo "<div class='image-link'>";
                    foreach ((array) $images as $key2 => $value2) {
                        if (file_exists(FCPATH . "asset/images/thumb/" . get_thumb_file_name($value2))) {
                            $value2_c = "thumb/" . get_thumb_file_name($value2);
                        } else {
                            $value2_c = $value2;
                        }
                        echo '<a href="' . base_url() . 'asset/images/' . $value2 . '"  class=""><img class="lazy"  data-original="' . base_url() . 'asset/images/' . $value2_c . '"  src=""></a>';
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} ?>
<?php $this->load->view('_includes/footer'); ?>