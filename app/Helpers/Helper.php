<?php

/**
 * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
 * @access    public
 * @param string
 * @return    string
 */
if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}
if (!function_exists('dataTreee')) {
    function dataTree($array, $parent, $check = 0, $level = 0,$isDisabled=1)
    {
        $data = '';
        foreach ($array as  $val) {
            if ($val['parent_id'] == $parent) {
                $childData = dataTree($array, $val['id'], $check, $level + 1);
                $disabled = '';
                if (!empty($childData) && $isDisabled) {
                    $disabled = ' disabled';
                }
                if ($val['id'] == $check)
                    $data .= "<option data-parent=" . $val['parent_id'] . " value=" . $val['id'] . " selected" . $disabled . ">" . str_repeat('--', $level) . $val['name'] . "</option>";
                else $data .= "<option data-parent=" . $val['parent_id'] . " value=" . $val['id'] . $disabled  . ">" . str_repeat('--', $level) . $val['name'] . "</option>";
                $data .= $childData;
            }
        }
        return $data;
    }
}
if (!function_exists('deleteImgFromFile')) {
    function deleteImgFromFile($path)
    {
        $image_path = public_path() . '\storage\\' . $path;
        if (file_exists($image_path))
            unlink($image_path);
    }
}
if (!function_exists('menuMultipleLevel')) {
    function menuMultipleLevel($array, $parent, $check = 0, $level = 3)
    {
        $data = '';
        foreach ($array as  $val) {
            if ($val['parent_id'] == $parent) {
                $childData = menuMultipleLevel($array, $val['id'], $check, $level + 1);
                if (!empty($childData)) {
                    $data .= "<li><a class='' style='color:black;' data-toggle='collapse' href='#cate-" . $val['id'] . "' role='button'>
                    <i class='fa fa-caret-down mr-2'></i><label class='menu-title ml-2 label-multiple'>" . $val['name'] . "</label></a>
                                      <div class='collapse' id='cate-" . $val['id'] . "'>
                                        <ul class='nav flex-column sub-menu mt-1 ml-" . $level . "'>";
                    $data .= $childData;
                    $data .= "</ul></div></li>";
                } else {
                    $data .= "<li>
                    <input type='radio' class='mr-2 category' name='categories' value=" . $val['id'] . " id=category-" . $val['id'] . ">
                    <label for=category-" . $val['id'] . ">" . $val['name'] . "</label></li>";
                }
            }
        }
        return $data;
    }
}
