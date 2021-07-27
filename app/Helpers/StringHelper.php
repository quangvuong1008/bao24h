<?php

namespace App\Helpers;

/**
 * Class StringHelper
 * @package App\Helpers
 */
class StringHelper extends BaseStringHelper
{
    /**
     * Xóa trọng âm
     * @param $string
     * @return string
     */
    public static function removeMark($string)
    {
        $trans = [
            'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
            'ă' => 'a', 'ằ' => 'a', 'ắ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
            'â' => 'a', 'ầ' => 'a', 'ấ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
            'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A',
            'Ă' => 'A', 'Ằ' => 'A', 'Ắ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A',
            'Â' => 'A', 'Ầ' => 'A', 'Ấ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A',
            'đ' => 'd', 'Đ' => 'D',
            'è' => 'e', 'é' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
            'ê' => 'e', 'ề' => 'e', 'ế' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
            'È' => 'E', 'É' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E',
            'Ê' => 'E', 'Ề' => 'E', 'Ế' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E',
            'ì' => 'i', 'í' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
            'Ì' => 'I', 'Í' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I',
            'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
            'ô' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
            'ơ' => 'o', 'ờ' => 'o', 'ớ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
            'Ò' => 'O', 'Ó' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O',
            'Ô' => 'O', 'Ồ' => 'O', 'Ố' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O',
            'Ơ' => 'O', 'Ờ' => 'O', 'Ớ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',
            'ù' => 'u', 'ú' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
            'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
            'Ù' => 'U', 'Ú' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U',
            'Ư' => 'U', 'Ừ' => 'U', 'Ứ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U',
            'ỳ' => 'y', 'ý' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
            'Y' => 'Y', 'Ỳ' => 'Y', 'Ý' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y'
        ];
        return strtr($string, $trans);
    }

    /**
     * @param $string
     * @return string
     */
    public static function rewrite($string)
    {
        $string = static::removeMark(trim($string));
        $string = strtolower($string);
        // Chuyển các ký tự đặc biệt thành khoảng trắng
        $string = preg_replace('/([^a-z0-9\s\-])/i', '', $string);
        $string = preg_replace('/\s+/', '-', $string); // Xoá các khoảng trắng lặp lại
        $string = preg_replace('/\-+/', '-', $string);

        return $string;
    }

    /**
     * @param int $number
     * @return string
     */
    public static function formatNumber(int $number): string
    {
        return number_format($number, 0, ',', '.');
    }

    /**
     * @param int $number
     * @param null $suffix
     * @return string
     */
    public static function formatPrice(int $number, $suffix = null): string
    {
        $formattedNumber = static::formatNumber($number);

        if (!$suffix) return $formattedNumber;
        return "$formattedNumber $suffix";
    }

    public static function cut_string_by_length($string_input, $max_length)
    {

        if (strlen($string_input) > $max_length) {

            return substr($string_input, 0, $max_length) . '...';

//            $text = $string_input;
//            $limit = intval($max_length/6);
//            if (str_word_count($text, 0) >= $limit) {
//                $words = str_word_count($text, 2);
//                $pos = array_keys($words);
//                $text = substr($text, 0, $pos[$limit]) . '...';
//            }
//            return $text;
        }
        return $string_input;
    }


    public function get_url_user_product($title, $id)
    {
        return base_url() . '/' . StringHelper::rewrite($title) . '-' . $id;
    }

    public function get_url_user_product_keyword($keyword)
    {
        return base_url() . '/' . StringHelper::rewrite($keyword);
    }

    public function get_url_user_posts($id, $slug)
    {
        return base_url() . '/' . $id . '/' . StringHelper::rewrite($slug);
    }
}
