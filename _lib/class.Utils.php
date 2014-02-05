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
}