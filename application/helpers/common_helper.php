<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function custom_banner($position = "top", $html = false) {
    $CI =& get_instance();
    $CI->load->model('options_model');
    if ($CI->options_model->get_option("custom_banner_" . $position) == null) {
        $CI->options_model->save_option("custom_banner_" . $position, "img.jpg");
    } else {
        $file_name = json_decode($CI->options_model->get_option("custom_banner_" . $position)->option_content, true);
        $file_name = preg_replace("/(.+)\/asset/", "/asset", $file_name["full_path"]);
    }
    $str_html = "
		<div class='custom_banner $position' >
			" . ($CI->session->userdata('user') ?
            "<button class='btn change_banner' data-position='$position'>Change banner</button>" : "") . "
			<img src='$file_name' onError='this.src=\"http://placehold.it/1000x60\"' style='width:100%;'>
		</div>";
    if ($html == true) {
        return $str_html;
    } else {
        echo $str_html;
    }
}

/**
 * Chuẩn bị status page
 *
 * @return string
 * @since  20160622112201
 */
function get_status() {

    $size_family  = FileSizeConvert(foldersize(FCPATH));
    $size_git     = FileSizeConvert(foldersize(FCPATH . ".git"));
    $size_assets  = FileSizeConvert(foldersize(FCPATH . "asset"));
    $size_db      = FileSizeConvert(foldersize(APPPATH . "models/db"));
    $access_chart = get_access_chart();

    ob_start();
    ?>
    <h3>SIZE</h3>
    <p><b>Size of family: </b><?=$size_family;?></p>
    <p><b>Size of git: </b><?=$size_git;?></p>
    <p><b>Size of assets: </b><?=$size_assets;?></p>
    <p><b>Size of db: </b><?=$size_db;?></p>

    <button class="btn btn-default ajax_button download_backup" data-href="/ajax/do_ajax/download_backup"> Download backup</button>

    <script>
        $(".ajax_button.download_backup").click(function () {
            $(this).after("<div class='loading_m'>Loading ... <i class='fa fa-spin fa-refresh'></i> </div>");
            $.post($(this).data("href"), null, function (data, textStatus, xhr) {
                $(".loading_m").remove();
                var return_data = JSON.parse(data);
                if (return_data.status == "done") {
                    $(".ajax_button.download_backup").after("<p><a href='" + return_data.url + "'>" + return_data.url + "</a></p>");
                }
            });
        });
    </script>
    <hr>
    <div class="connect">
        <h3>Lượt truy cập</h3>
        <p><b>Bố: </b>
        <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?=$access_chart[0];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$access_chart[0];?>%">
                <span class="sr-only"><?=$access_chart[0];?>% Complete (success)</span>
            </div>
        </div>
        </p>
        <p><b>Mẹ: </b>
        <div class="progress">
            <div class="progress-bar progress-bar-danger  progress-bar-striped" role="progressbar" aria-valuenow="<?=$access_chart[1];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$access_chart[1];?>%">
                <span class="sr-only"><?=$access_chart[1];?>% Complete (success)</span>
            </div>
        </div>
        </p>
    </div>
    <hr>
    <?php
    $return = ob_get_clean();

    return $return;
}

/**
 * get_access_chart
 * Lấy phần trăm access vào blog
 *
 * @return array
 * $array[0] : percent access Bố
 * $array[1] : percent access Mẹ
 */
function get_access_chart() {
    $CI    =& get_instance();
    $rs[0] = $CI->db->where("archive_key like 'login_%' and (archive_content like '%11%' or archive_content like '%vihoangson@gmail.com%') ")
                    ->order_by("id", "desc")
                    ->get('archive')
                    ->num_rows();
    $rs[1] = $CI->db->where("archive_key like 'login_%' and archive_content like '%12%' or archive_content like '%4t.nhauyen@gmail.com%' ")
                    ->order_by("id", "desc")
                    ->get('archive')
                    ->num_rows();
    $total = $rs[0] + $rs[1];
    $rs[0] = round(($rs[0] / $total) * 100);
    $rs[1] = round(($rs[1] / $total) * 100);

    return $rs;
}

/**
 * Foldersize
 * Lấy size của 1 folder
 *
 * @param  [string] $path [path to directory]
 *
 * @return [float]       [size of directory]
 */
function foldersize($path) {
    $total_size = 0;
    $files      = scandir($path);

    foreach ($files as $t) {
        if (is_dir(rtrim($path, '/') . '/' . $t)) {
            if ($t <> "." && $t <> "..") {
                $size = foldersize(rtrim($path, '/') . '/' . $t);

                $total_size += $size;
            }
        } else {
            $size       = filesize(rtrim($path, '/') . '/' . $t);
            $total_size += $size;
        }
    }

    return $total_size;
}

//============ ============  ============  ============
// Function check_folder()
// Check folder có tồn tại hay không, nếu không thì sẽ tạo mới
//
function FileSizeConvert($bytes) {
    $bytes   = floatval($bytes);
    $arBytes = [
        0 => [
            "UNIT"  => "TB",
            "VALUE" => pow(1024, 4)
        ],
        1 => [
            "UNIT"  => "GB",
            "VALUE" => pow(1024, 3)
        ],
        2 => [
            "UNIT"  => "MB",
            "VALUE" => pow(1024, 2)
        ],
        3 => [
            "UNIT"  => "KB",
            "VALUE" => 1024
        ],
        4 => [
            "UNIT"  => "B",
            "VALUE" => 1
        ],
    ];

    foreach ($arBytes as $arItem) {
        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
            break;
        }
    }

    return $result;
}

function check_folder($path) {
    $path         = str_replace(FCPATH, "", $path);
    $list_foler   = explode("/", $path);
    $current_path = "";
    foreach ($list_foler as $key => $value) {
        $current_path .= "/" . $value;

        if (!is_dir(FCPATH . $current_path)) {
            mkdir(FCPATH . $current_path);
        }
        if (!is_writable(FCPATH . $current_path)) {
            chmod(FCPATH . $current_path, 0777);
        }
    }

    return FCPATH . $current_path;
}

function check_popup($str_popup) {
    if (preg_match("/\.(jpg|gif|png)$/", $str_popup)) {
        return "<img onError=\"this.src='https://placeholdit.imgix.net/~text?txtsize=9&txt=No%20image&w=300&h=300'\" src='" . $str_popup . "'> ";
    } else {
        return "<div class='style_content_popup'>" . $str_popup . "</div>";
    }
}

function get_thumb_file_name($file_name) {
    $file_name_new = preg_replace("/(\.)(\w{3,4})/", "_thumb.$2", $file_name);

    return $file_name_new;
}
function h_class($string){
    $ci = get_instance();
    $array_render = $ci->config->config['array_render'];

    $array_class = [];
    foreach ($array_render as $value){
        if( preg_match($value['pattern'],$string)){
            $array_class[] =  $value['class'];
        }
    }

    if($array_class != []){
        return implode(' ',$array_class);
    }
    return '';

}
/**
 * [h Bộ lọc markdown sang html]
 * - Replace emotion icon
 * - Recover video youtube
 * - Convert sang markdown
 * - Gắn link vào hashtag
 *
 * @param  mardown $string
 *
 * @return html convert từ markdown sang html
 *
 * @Ex:
 * [video]j61nv9faa4c[/video]
 *
 */
function h($string) {
    $CI =& get_instance();

    // Replace emotion icon
    $key    = array_keys($CI->config->item("emotion_yahoo"));
    $value  = array_values($CI->config->item("emotion_yahoo"));
    $string = str_replace($key, $value, $string);

    // Recover video youtube
    $replace = '<p class="text-center"><iframe width="420" height="315" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></p>';
    $string  = preg_replace("/\[video\](.+)\[\/video\]/", $replace, $string);

    // Convert sang markdown
    $string = Markdown::defaultTransform($string);

    // Gắn link vào hashtag
    $string = preg_replace("/\(\#(\w+)\)/i", "<a href='/homepage/tags/$1'>#$1</a>", $string);

    return $string;
}

/**
 *Hiển thị blog html mạng xã hội
 *
 * @return html
 */
function show_social() {
    ?>
    <div class="" style="margin:20px auto; width:325px;">
        <ul class="social-network social-circle">
            <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
            <li>
                <a href="https://www.facebook.com/conduonghanhphuc/" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
                <a href="http://youtube.com/vihoangson/" class="icoTwitter" title="Twitter"><i class="fa fa-youtube"></i></a>
            </li>
            <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
            <li>
                <a href="https://github.com/vihoangson/Family" class="icoLinkedin" title="Linkedin"><i class="fa fa-github"></i></a>
            </li>
        </ul>
    </div>
    <?php
}

/**
 * Hiển thị html count down tới ngày sinh
 *
 * @return html
 */
function show_img_countdown() {
    $date1 = date_create(date("Y-m-d h:i:s", time()));
    $date2 = date_create("2016-05-20");
    $diff  = date_diff($date1, $date2);
    $days  = $diff->days;
    $weeks = round((280 - $days) / 7);
    $html  = "<p><img style='max-height:100%;max-width:100%;' src='/asset/data/27-40_tuan/" . $weeks . "_tuan.png'></p>";

    return $html;
}

/**
 * Đếm tuổi Kem
 *
 * @return html
 */
function dem_tuoi_kem() {
    return get_var_countdown();
}

/**
 * Lấy ra string đếm tuổi của Kem
 *
 * @param string $ngaydusinh
 *
 * @return html string
 */
function get_var_countdown($ngaydusinh = "2016-05-09") {
    $date1    = date_create(date("Y-m-d h:i:s", time()));
    $date2    = date_create($ngaydusinh);
    $diff_obj = $date1->diff($date2);

    //============ ============  ============  ============
    // Object date
    if ($diff_obj->invert == 1) {
        $diff    = date_diff($date1, $date2);
        $days    = $diff->days;
        $weeks   = round((280 - $days) / 7);
        $percent = 100 - round(($days / 266) * 100);
        $y       = $diff->y;
        $m       = $diff->m;
        $d       = $diff->d;
        $h       = $diff->h;
        $i       = $diff->i;
        $s       = $diff->s;
    }

    $day = $d . " Ngày ";

    if ($m > 0) {
        $month = $m . " Tháng ";
    }

    if ($y > 0) {
        $year = $y . " Năm ";
    }
    $return = $year . $month . $day;

    return $return;

}

/**
 * Nhận ngày dự sinh vào xuất ra hiển thi html
 *
 * @param string $ngaydusinh
 *
 * @return html string
 */
function get_content_countdown($ngaydusinh = "2016-05-09") {
    if (NGAYDUSINH) {
        $ngaydusinh = NGAYDUSINH;
    }
    $date1    = date_create(date("Y-m-d h:i:s", time()));
    $date2    = date_create($ngaydusinh);
    $diff_obj = $date1->diff($date2);

    //============ ============  ============  ============
    // Object date
    if ($diff_obj->invert == 0) {
        $diff    = date_diff($date1, $date2);
        $days    = $diff->days;
        $weeks   = round((280 - $days) / 7);
        $percent = 100 - round(($days / 266) * 100);
        $m       = $diff->m;
        $d       = $diff->d;
        $h       = $diff->h;
        $i       = $diff->i;
        $s       = $diff->s;
        $html    = "
			<center>
				<h2 class='text-center'>Ngày dự sinh: <br>" . date("d-m-Y", $date2->getTimestamp()) . "</h2>
				<p><h3>Tuần thứ: <b>" . $weeks . "/40</b></p>
				<h1>Còn lại: " . $days . " Ngày</h1>
				<h3>" . $m . " Tháng " . $d . " Ngày - " . $h . " Giờ " . $i . " Phút " . $s . " Giây </h3>
				" . '
				<div id="count_down"></div>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%">
						<span class="sr-only">' . $percent . '% Complete (success)</span>
					</div>
				</div>
				<h2><i class="fa fa-refresh fa-spin"></i> Loading</h2>
				' . "
			</center>
			";
    } else {
        $html = "
			<div class='text-center'>
				<h1>Kem được</h1>" . ($diff_obj->y ? '<span>' . $diff_obj->y . " Năm</span> " :
                "") . '<span>' . $diff_obj->m . " Tháng</span> " . '<span>' . $diff_obj->d . " Ngày</span> " . '<hr>' . '<div class="hidden"><br>' . $diff_obj->days . " Ngày</div>
			</div>
			";
    }

    return $html;
}

//============ ============  ============  ============
// $method
// add_img_homepage
//============ ============  ============  ============ 
function show_modal_media($method = null) {
    ?>
    <!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
    <div class="modal fade" id="modal-upload-media">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/asset/js/jquery.form.js"></script>
    <script src="/asset/js/media-box.js"></script>
    <?php
    switch ($method) {
        case "add_img_homepage":
            ?>
            <script>
                /**
                 * Box hình ảnh
                 */
                $(".insert-img").open_media({
                    callbackevent_before: function () {
                        $(document).on("click", "#modal-upload-media .modal-body img", function () {
                            // SmartDown add img
                            src = "![](" + $(this).attr("data-src") + ")";

                            // Đóng modal
                            $("#modal-upload-media").modal("hide");
                            val_text = $("#content").val();
                            $("#content").val(val_text + src);
                        });
                    }
                });
            </script>
            <?php
        break;
        case "instant_img":
            ?>

            <?php
        break;
        default:
        break;
    }
    ?>
    <!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
    <?php


}

function createSlug1($str) {
    $coDau = [
        "à",
        "á",
        "ạ",
        "ả",
        "ã",
        "â",
        "ầ",
        "ấ",
        "ậ",
        "ẩ",
        "ẫ",
        "ă",
        "ằ",
        "ắ",
        "ặ",
        "ẳ",
        "ẵ",
        "è",
        "é",
        "ẹ",
        "ẻ",
        "ẽ",
        "ê",
        "ề",
        "ế",
        "ệ",
        "ể",
        "ễ",
        "ì",
        "í",
        "ị",
        "ỉ",
        "ĩ",
        "ò",
        "ó",
        "ọ",
        "ỏ",
        "õ",
        "ô",
        "ồ",
        "ố",
        "ộ",
        "ổ",
        "ỗ",
        "ơ",
        "ờ",
        "ớ",
        "ợ",
        "ở",
        "ỡ",
        "ù",
        "ú",
        "ụ",
        "ủ",
        "ũ",
        "ư",
        "ừ",
        "ứ",
        "ự",
        "ử",
        "ữ",
        "ỳ",
        "ý",
        "ỵ",
        "ỷ",
        "ỹ",
        "đ",
        "À",
        "Á",
        "Ạ",
        "Ả",
        "Ã",
        "Â",
        "Ầ",
        "Ấ",
        "Ậ",
        "Ẩ",
        "Ẫ",
        "Ă",
        "Ằ",
        "Ắ",
        "Ặ",
        "Ẳ",
        "Ẵ",
        "È",
        "É",
        "Ẹ",
        "Ẻ",
        "Ẽ",
        "Ê",
        "Ề",
        "Ế",
        "Ệ",
        "Ể",
        "Ễ",
        "Ì",
        "Í",
        "Ị",
        "Ỉ",
        "Ĩ",
        "Ò",
        "Ó",
        "Ọ",
        "Ỏ",
        "Õ",
        "Ô",
        "Ồ",
        "Ố",
        "Ộ",
        "Ổ",
        "Ỗ",
        "Ơ",
        "Ờ",
        "Ớ",
        "Ợ",
        "Ở",
        "Ỡ",
        "Ù",
        "Ú",
        "Ụ",
        "Ủ",
        "Ũ",
        "Ư",
        "Ừ",
        "Ứ",
        "Ự",
        "Ử",
        "Ữ",
        "Ỳ",
        "Ý",
        "Ỵ",
        "Ỷ",
        "Ỹ",
        "Đ",
        "ê",
        "ù",
        "à"
    ];

    $khongDau = [
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "i",
        "i",
        "i",
        "i",
        "i",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "y",
        "y",
        "y",
        "y",
        "y",
        "d",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "I",
        "I",
        "I",
        "I",
        "I",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "Y",
        "Y",
        "Y",
        "Y",
        "Y",
        "D",
        "e",
        "u",
        "a"
    ];
    $return   = str_replace($coDau, $khongDau, $str);
    $return   = preg_replace('/[^a-zA-Z0-9\s-]/', '', $return);

    return $return;
}

function createSlug($str) {
    $coDau = [
        "à",
        "á",
        "ạ",
        "ả",
        "ã",
        "â",
        "ầ",
        "ấ",
        "ậ",
        "ẩ",
        "ẫ",
        "ă",
        "ằ",
        "ắ",
        "ặ",
        "ẳ",
        "ẵ",
        "è",
        "é",
        "ẹ",
        "ẻ",
        "ẽ",
        "ê",
        "ề",
        "ế",
        "ệ",
        "ể",
        "ễ",
        "ì",
        "í",
        "ị",
        "ỉ",
        "ĩ",
        "ò",
        "ó",
        "ọ",
        "ỏ",
        "õ",
        "ô",
        "ồ",
        "ố",
        "ộ",
        "ổ",
        "ỗ",
        "ơ",
        "ờ",
        "ớ",
        "ợ",
        "ở",
        "ỡ",
        "ù",
        "ú",
        "ụ",
        "ủ",
        "ũ",
        "ư",
        "ừ",
        "ứ",
        "ự",
        "ử",
        "ữ",
        "ỳ",
        "ý",
        "ỵ",
        "ỷ",
        "ỹ",
        "đ",
        "À",
        "Á",
        "Ạ",
        "Ả",
        "Ã",
        "Â",
        "Ầ",
        "Ấ",
        "Ậ",
        "Ẩ",
        "Ẫ",
        "Ă",
        "Ằ",
        "Ắ",
        "Ặ",
        "Ẳ",
        "Ẵ",
        "È",
        "É",
        "Ẹ",
        "Ẻ",
        "Ẽ",
        "Ê",
        "Ề",
        "Ế",
        "Ệ",
        "Ể",
        "Ễ",
        "Ì",
        "Í",
        "Ị",
        "Ỉ",
        "Ĩ",
        "Ò",
        "Ó",
        "Ọ",
        "Ỏ",
        "Õ",
        "Ô",
        "Ồ",
        "Ố",
        "Ộ",
        "Ổ",
        "Ỗ",
        "Ơ",
        "Ờ",
        "Ớ",
        "Ợ",
        "Ở",
        "Ỡ",
        "Ù",
        "Ú",
        "Ụ",
        "Ủ",
        "Ũ",
        "Ư",
        "Ừ",
        "Ứ",
        "Ự",
        "Ử",
        "Ữ",
        "Ỳ",
        "Ý",
        "Ỵ",
        "Ỷ",
        "Ỹ",
        "Đ",
        "ê",
        "ù",
        "à"
    ];

    $khongDau = [
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "a",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "e",
        "i",
        "i",
        "i",
        "i",
        "i",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "o",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "u",
        "y",
        "y",
        "y",
        "y",
        "y",
        "d",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "A",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "E",
        "I",
        "I",
        "I",
        "I",
        "I",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "O",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "U",
        "Y",
        "Y",
        "Y",
        "Y",
        "Y",
        "D",
        "e",
        "u",
        "a"
    ];
    $return   = str_replace($coDau, $khongDau, $str);
    $return   = str_replace(" ", "-", $return);
    $return   = preg_replace('/[^a-zA-Z0-9\s-]/', '', $return);

    return $return;
}

function filter_string($string) {
    return strip_tags($string);
}
