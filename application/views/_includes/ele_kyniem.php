<div class="message-item <?=($value->status == 1 ? "kyniem_important" : "");?>" id="m<?=$key;?>" data-step="<?=$key;?>">
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
                <a href="#"><img src="<?=PATH_AVATAR . $value->user_avatar;?>"></a>
            </div>
            <div class="user-detail">
                <h5 class="handle"><?=($value->kyniem_title ? $value->kyniem_title : "Happy Family");?></h5>
                <div class="post-meta">
                    <div class="asker-meta">
                        <span class="qa-message-what"></span>
                        <span class="qa-message-when">
									<span class="qa-message-when-data"><?=date("d-m-Y H:i:s", strtotime($value->kyniem_create));?></span>
								</span>
                        <span class="qa-message-who">
									<span class="qa-message-who-pad">by </span>
									<span class="qa-message-who-data"><a href="#"><?=$value->username;?></a></span>
								</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="qa-message-content">
            <?php
            //============ ============  ============  ============ 
            //Hiển thị nội dung bài viết
            //============ ============  ============  ============ 
            ?>
            <div class="content_main_block"><?=h($value->kyniem_content);?></div>
            <?php
            //============ ============  ============  ============ 
            // Hiển thị hình kỷ niệm
            //============ ============  ============  ============ 
            if ($value->kyniem_images && $value->kyniem_images != "[]") {
                $images = json_decode($value->kyniem_images, true);
                echo "<div class='image-link'>";
                foreach ((array) $images as $key2 => $value2) {
                    if (file_exists(FCPATH . "asset/images/thumb/" . get_thumb_file_name($value2))) {
                        $value2_c = "thumb/" . get_thumb_file_name($value2);
                    } else {
                        $value2_c = $value2;
                    }
                    echo '<a href="' . base_url() . 'asset/images/' . $value2 . '"  class=""><img class="lazy"  src="' . base_url() . 'asset/images/' . $value2_c . '"></a>';
                }
                echo "</div>";
            }

            //============ ============  ============  ============ 
            //Block comment
            //============ ============  ============  ============ 
            ?>
            <div class="box-comment">
                <div class="row-tail">
                    <div class="input-c">
                        <input class='input-comment' data-id="<?=$value->id;?>" placeholder="Write comment ...">
                        <a href="javascript:void(0)" class="smile-button"><i class="fa fa-smile-o"></i></a>
                    </div>
                    <div class="button-c">
                        <button class="btn btn-primary btn-block send-button">Send</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
                //============ ============  ============  ============ 
                //Hiển thị comment
                //============ ============  ============  ============ 
                ?>
                <ul>
                    <?php
                    foreach ((array) $comment[$value->id] as $key_comment => $value_comment) {
                        $this->load->view('_includes/ele_comment_box', compact("value_comment"));
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>