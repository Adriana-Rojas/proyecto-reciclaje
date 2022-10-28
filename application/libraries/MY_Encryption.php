<?php
class MY_Encryption extends CI_Encryption
{
    /**
     * Encodes a string.
     * 
     * @param string $string The string to encrypt.
     * @param string $key[optional] The key to encrypt with.
     * @param bool $url_safe[optional] Specifies whether or not the
     *                returned string should be url-safe.
     * @return string
     */
    function encrypt($string, array $params = NULL)
    {
        $ret = parent::encrypt($string);
		//echo $ret."<br>";
        $ret = strtr(
                    $ret,
                    array(
                        '+' => '.',
                        '=' => '-',
                        '/' => '~'
                    )
                );
       // echo $ret."<br>";
        return $ret;
    }

    /**
     * Decodes the given string.
     * 
     * @access public
     * @param string $string The encrypted string to decrypt.
     * @param string $key[optional] The key to use for decryption.
     * @return string
     */
    function decrypt($string, array $params = NULL)
    {
        $string = strtr(
                $string,
                array(
                    '.' => '+',
                    '-' => '=',
                    '~' => '/'
                )
        );

        return parent::decrypt($string);
    }
}
?>
