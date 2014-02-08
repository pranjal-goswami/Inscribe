<?
/**
 * © 2013-2015 GreekTurtle
 *
 * LICENSE:
 *
 * This file is part of  (http://).
 *
 * The contents of this file cannot be copied, distributed or modified without prior
 * consent from the author. 
 *
 * Project : 
 * File : 
 * Description : 
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Tue Feb 04 2014 22:49:11 GMT+0530 (IST)
 */
class Utils {
	 /* 
    * Encrypt content
    */
    public static function encryptId($content=null) {

		$key = "stairway_to_heaven";
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, md5($key), $content, MCRYPT_MODE_CBC, md5(md5($key))));
        $filename_unfriendly_chars = array("/");
        $filename_friendly_replacement = array('%');
        $encrypted = str_replace($filename_unfriendly_chars, $filename_friendly_replacement, $encrypted);
		return $encrypted;
    }

    /* 
    * Decrypt content 
    */
    public static function decryptId($encryption=null) {

		$key = "stairway_to_heaven";
        $filename_friendly_replacement = array('%');
        $filename_unfriendly_chars = array("/");
        $encryption = str_replace($filename_friendly_replacement, $filename_unfriendly_chars, $encryption);
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, md5($key), base64_decode($encryption), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		return $decrypted;
    }  
	
	    /**
     * Indents a flat JSON string to make it more human-readable.
     *
     * @author http://recursive-design.com/blog/2008/03/11/format-json-with-php/
     * @param string $json The original JSON string to process.
     * @return string Indented version of the original JSON string.
     */
    public static function indentJSON($json) {
        $result = '';
        $pos = 0;
        $str_len = strlen($json);
        $indent_str = '    ';
        $new_line = "\n";
        $prev_char = '';
        $prev_prev_char = '';
        $out_of_quotes = true;

        for ($i = 0; $i <= $str_len; $i++) {

            // Grab the next character in the string.
            $char = substr($json, $i, 1);

            // Are we inside a quoted string?
            if ($char == '"') {
                if ( $prev_char != "\\") {
                    $out_of_quotes = !$out_of_quotes;
                } elseif ($prev_prev_char == "\\") {
                    $out_of_quotes = !$out_of_quotes;
                }
                // If this character is the end of an element,
                // output a new line and indent the next line.
            } else if (($char == '}' || $char == ']') && $out_of_quotes) {
                $result .= $new_line;
                $pos--;
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indent_str;
                }
            }

            // Add the character to the result string.
            $result .= $char;

            // If the last character was the beginning of an element,
            // output a new line and indent the next line.
            if (($char == ',' || $char == '{' || $char == '[') && $out_of_quotes) {
                $result .= $new_line;
                if ($char == '{' || $char == '[') {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indent_str;
                }
            }

            $prev_prev_char = $prev_char;
            $prev_char = $char;
        }

        return $result;
    }

    /**
     * Becuse PHP doesn't have a data type large enough to hold some of the
     * numbers that Twitter deals with, this function strips the double
     * quotes off every string that contains only numbers inside the double
     * quotes.
     *
     * @param string $encoded_json JSON formatted string.
     * @return string Encoded JSON with numeric strings converted to numbers.
     */
    public static function convertNumericStrings($encoded_json) {
        return preg_replace('/\"((?:-)?[0-9]+(\.[0-9]+)?)\"/', '$1', $encoded_json);
    }

    /**
     * Get percentage
     * @param int $numerator
     * @param int $denominator
     * @return int Percentage
     */
    public static function getPercentage($numerator, $denominator) {
        if ((isset($numerator)) && (isset($denominator))) {
            if ($numerator > 0 && $denominator > 0) {
                return ($numerator * 100) / ($denominator);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
	
	/**
     * Validate email address
     * This method uses a raw regex instead of filter_var because as of PHP 5.3.3,
     * filter_var($email, FILTER_VALIDATE_EMAIL) validates local email addresses.
     * From 5.2 to 5.3.3, it does not.
     * Therefore, this method uses the PHP 5.2 regex instead of filter_var in order to return consistent results
     * regardless of PHP version.
     * http://svn.php.net/viewvc/php/php-src/trunk/ext/filter/logical_filters.c?r1=297250&r2=297350
     *
     * @param str $email Email address to validate
     * @return bool Whether or not it's a valid address
     */
    public static function validateEmail($email = '') {
        //return filter_var($email, FILTER_VALIDATE_EMAIL));
        $reg_exp = "/^((\\\"[^\\\"\\f\\n\\r\\t\\b]+\\\")|([A-Za-z0-9_][A-Za-z0-9_\\!\\#\\$\\%\\&\\'\\*\\+\\-\\~\\".
        "/\\=\\?\\^\\`\\|\\{\\}]*(\\.[A-Za-z0-9_\\!\\#\\$\\%\\&\\'\\*\\+\\-\\~\\/\\=\\?\\^\\`\\|\\{\\}]*)*))@((\\".
        "[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\\.".
        "((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\\])|".
        "(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\\.".
        "((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|".
        "((([A-Za-z0-9])(([A-Za-z0-9\\-])*([A-Za-z0-9]))?(\\.(?=[A-Za-z0-9\\-]))?)+[A-Za-z]+))$/D";
        //return (preg_match($reg_exp, $email) === false)?false:true;
        return (preg_match($reg_exp, $email)>0)?true:false;
    }
}