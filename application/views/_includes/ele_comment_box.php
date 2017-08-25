<li data-id='<?=$value_comment->id;?>' class='ele_comment' id="">
    <div class='avatar'><img src='<?=PATH_AVATAR . $value_comment->user_avatar;?>' class='avatar_comment'></div>
    <div class="content">
        <div class="username"><b><?=$value_comment->username;?></b></div>
        <div class="comment_create">
            <small><?=$value_comment->comment_create;?></small>
        </div>
        <div class="comment_content"><?=$value_comment->comment_content;?></div>
    </div>
</li>