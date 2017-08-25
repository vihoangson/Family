<?php
/**
 * [get_sheet_google description]
 *
 * @param  [type] $link_sheet_google [link sheet google được public html]
 * @param  string $return [array|table]
 *
 * @return [type]                    [array|html]
 */
function get_sheet_google($link_sheet_google = null, $return = "array") {

    if (!$link_sheet_google) {
        // Theo dõi cân nặng của cả nhà.
        $link_sheet_google = "https://docs.google.com/spreadsheets/d/1v9VLjRWpDYW8vZth40B5BrasOrfsouqkMy8ZZfYC0_s/pubhtml";
    }

    $string = file_get_contents($link_sheet_google);

    // Lưu về local
    $save_to_local = false;
    if ($save_to_local) {
        $string = file_put_contents("data.html", $string);
        $files  = scandir("./");
        foreach ($files as $key => $value) {
            if (preg_match("/data_/", $value)) {
                $string = file_get_contents("data_" . time() . ".html");
            }
        }
    }
    // Chuyển table vào array
    $array_table = ConvertHelper::getdata($string);
    foreach ($array_table as $key => $value) {
        if ($value[1] == "") {
            unset($array_table[$key]);
        }
    }

    if ($return == "array") {
        return $array_table;
    } else {
        return array2Html($array_table, true);
    }
}

//============ ============  ============  ============ 
// Convert html table to aray
// 
// @auth: ViHoangSon
// @since: 20160704092752
// 
// Using:
// $contents = "<table><tr><td>Row 1 Column 1</td><td>Row 1 Column 2</td></tr><tr><td>Row 2 Column 1</td><td>Row 2 Column 2</td></tr></table>";
// $array = ConvertHelper::getdata($contents);
//============ ============  ============  ============ 
class ConvertHelper {

    static function getdata($contents) {
        $DOM = new DOMDocument;
        $DOM->loadHTML($contents);
        $items  = $DOM->getElementsByTagName('tr');
        $return = [];
        foreach ($items as $node) {
            $return[] = self::tdrows($node->childNodes);
        }

        return $return;
    }

    static function tdrows($elements) {
        $str = [];
        foreach ($elements as $element) {
            $str[] = $element->nodeValue;
        }

        return $str;
    }
}

function array2Html($array, $table = true) {
    $out = '';
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            if (!isset($tableHeader)) {
                $tableHeader = '<th>' . implode('</th><th>', array_keys($value)) . '</th>';
            }
            array_keys($value);
            $out .= '<tr>';
            $out .= array2Html($value, false);
            $out .= '</tr>';
        } else {
            $out .= "<td>$value</td>";
        }
    }

    if ($table) {
        return '<table border="1">' . $tableHeader . $out . '</table>';
    } else {
        return $out;
    }
}

?>
