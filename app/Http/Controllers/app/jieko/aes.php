<?php

namespace App\Http\Controllers\app\jieko;

class aes {

    private $hex_iv = ''; # converted JAVA byte code in to HEX and placed it here

    private $key; #Same as in JAVA

    public function __construct($key) {
        $this->key = $key;
        //$this->key = hash('sha256', $this->key, true);
    }

    public function encrypt($input)
    {
        $data = openssl_encrypt($input, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        //$data = base64_encode($data);  //base64编码
        $data = bin2hex($data);  //普通编码转成16进制
        return $data;
    }

    public function decrypt($input)
    {
        //$input = base64_decode($input);
        $input = hex2bin($input);  //16进制转为普通编码
        $decrypted = openssl_decrypt($input, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        return $decrypted;
    }

    /*
      For PKCS7 padding
     */
    private function addpadding($string, $blocksize = 16) {

        $len = strlen($string);

        $pad = $blocksize - ($len % $blocksize);

        $string .= str_repeat(chr($pad), $pad);

        return $string;

    }

    private function strippadding($string) {

        $slast = ord(substr($string, -1));

        $slastc = chr($slast);

        $pcheck = substr($string, -$slast);

        if (preg_match("/$slastc{" . $slast . "}/", $string)) {

            $string = substr($string, 0, strlen($string) - $slast);

            return $string;

        } else {

            return false;

        }

    }

    function hexToStr($hex)
    {
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2)
        {
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }

}




//57902A2EF7897E101E5F7CBCEF98BAC9
//
// str:aabbcc
// key:1234567890123456
// result:
// 8263AB6D6DB5BE41C098B27CBB1D6A39
// 8263AB6D6DB5BE41C098B27CBB1D6A39

