<?php

namespace common\kato\helpers;

class KatoBase extends \yii\base\Object
{
    /**
     * Converts to money format
     */
    public static function formatMoney($amount) {
        setlocale(LC_MONETARY, 'en_GB.UTF-8');
        return money_format('%n', $amount);
    }

    /**
     * delete directory recursivly
     */
    public static function deleteDirectory($dir, $keepDir=false) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) return false;
        }
        if($keepDir)
            return true;
        else
            return rmdir($dir);
    }

    /**
     * merges new Get into current url
     * use it as: url("/model/action", mergeGet($_GET, 'limit', '50'));
     */
    public static function mergeGet($get, $key, $value) {
        if (array_key_exists($key, $get)) {
            $get[$key]=$value;
        }
        $array = array_merge(array($key => $value), $get);

        return $array;
    }

    /**
     * gets the data from a URL
     * Usage: $returned_content = get_data('http://davidwalsh.name');
     * Alternatively, you can use the file_get_contents function remotely, but many hosts don't allow this.
     */
    public static function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        //For your script we can also add a User Agent:
        $userAgent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)";

        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Creates random string
     * default lenght is 8
     */
    public static function genRandomString($length=8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $size = strlen( $chars );
        $str='';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;

    }

    /**
     * returns array containing: lat, lng, postcode
     * Usage: pass in postcode
     * @param $postcode
     * @param bool $r
     * @return array|bool|mixed
     */
    public static function getPostcodeData($postcode, $r = false) {
        $trim_postcode = str_replace(' ', '', preg_replace("/[^a-zA-Z0-9\s]/", "", strtolower($postcode)));

        $q_center = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $trim_postcode . "&sensor=false&region=gb";
        $json_center = file_get_contents($q_center);
        $details_center = json_decode($json_center, TRUE);

        if($details_center['status']=='OVER_QUERY_LIMIT') return false;

        if ($r) return $details_center;

        if (isset($details_center['results']) && isset($details_center['results'][0])) {

            $center_lat=null;
            $center_lng=null;
            if (isset($details_center['results'][0]['geometry']['location'])) {
                $center_lat = $details_center['results'][0]['geometry']['location']['lat'];
                $center_lng = $details_center['results'][0]['geometry']['location']['lng'];
            }

            $boundsNE=null;
            $boundsSW=null;
            if (isset($details_center['results'][0]['geometry']['bounds'])) {
                $boundsNE = $details_center['results'][0]['geometry']['bounds']['northeast'];
                $boundsSW = $details_center['results'][0]['geometry']['bounds']['southwest'];
            }

            $status = isset($details_center['results'][0]['status']) ? $details_center['results'][0]['status']: '';
            $types = isset($details_center['results'][0]['types']) ? $details_center['results'][0]['types'] : '' ;

            return array(
                'postcode' => $trim_postcode,
                'lat' => $center_lat,
                'lng' => $center_lng,
                'NE' => $boundsNE,
                'SW' => $boundsSW,
                'status' => $status,
                'types' => $types
            );

        } else {

            return false;

        }
    }

    /**
     * Sanitize database inputs
     * @param $input
     * @return string
     */
    public static function sanitize($input) {
        if (is_array($input)) {
            foreach($input as $var=>$val) {
                $output[$var] = sanitize($val);
            }
        }
        else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input  = cleanInput($input);
            $output = mysql_real_escape_string($input);
        }
        return $output;
    }
    /**
     * @param $input
     * @return mixed
     */
    function cleanInput($input) {

        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    /**
     * Helper function to limit the words in a string
     *
     * @param string $string the given string
     * @param int $word_limit the number of words to limit to
     * @return string the limited string
     */

    public static function limit_words($string, $word_limit)
    {
        $words = explode(' ',$string);
        return trim(implode(' ', array_splice($words, 0, $word_limit))) .'...';
    }

    /**
     * Helper function to recusively get all files in a directory
     *
     * @param string $directory start directory
     * @param string $ext optional limit to file extensions
     * @return array the matched files
     */
    public static function get_files($directory, $ext = '')
    {
        $array_items = array();
        if($handle = opendir($directory)){
            while(false !== ($file = readdir($handle))){
                if($file != "." && $file != ".."){
                    if(is_dir($directory. "/" . $file)){
                        $array_items = array_merge($array_items, KatoHelper::get_files($directory. "/" . $file, $ext));
                    } else {
                        $file = $directory . "/" . $file;
                        if(!$ext || strstr($file, $ext)) $array_items[] = preg_replace("/\/\//si", "/", $file);
                    }
                }
            }
            closedir($handle);
        }
        return $array_items;
    }

    /**
     * Helper function to work out the base URL
     *
     * @return string the base url
     */
    public static function base_url()
    {
        global $config;
        if(isset($config['base_url']) && $config['base_url']) return $config['base_url'];

        $url = '';
        $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
        $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
        if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');

        $protocol = KatoHelper::get_protocol();
        return rtrim(str_replace($url, '', $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']), '/');
    }

    /**
     * Tries to guess the server protocol. Used in base_url()
     *
     * @return string the current protocol
     */
    public static function get_protocol()
    {
        preg_match("|^HTTP[S]?|is",$_SERVER['SERVER_PROTOCOL'],$m);
        return strtolower($m[0]);
    }

    /**
     * THE PERFECT PHP CLEAN URL GENERATOR
     * @param $str
     * @param array $replace
     * @param string $delimiter
     * @return mixed|string
     */
    public static function toAscii($str, $replace=array(), $delimiter='-') {
        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    /**
     * Strip tags and limit description
     * @param $content
     * @param string $tag
     * @param int $wordLimit
     * @return string
     */
    public static function genShortDesc($content, $tag = 'p' , $wordLimit = 20)
    {
        if (preg_match('%(<' . $tag . '[^>]*>.*?</' . $tag . '>)%i', $content, $regs)) {
            $result = $regs[1];
        } else {
            $result = "";
        }

        return KatoHelper::limit_words(strip_tags($result), $wordLimit);
    }
}