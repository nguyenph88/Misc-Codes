<?php
if (!defined('IN_CODE')) die("Hacking attempt");
class View {
	function slug($str)
	{
		$str = strtolower(trim($str));
		$str = preg_replace('/[^a-z0-9-]/', '-', $str);
		$str = preg_replace('/-+/', "-", $str);
		return $str;
	}
	function stripTag($Str_Input) {
		@settype($Str_Input, 'string');
		$Str_Input= @strip_tags($Str_Input);
		$_Ary_TagsList= array('jav&#x0A;ascript:', 'jav&#x0D;ascript:', 'jav&#x09;ascript:', '<!-', '<', '>', '%3C', '&lt', '&lt;', '&LT', '&LT;', '&#60', '&#060', '&#0060', '&#00060', '&#000060', '&#0000060', '&#60;', '&#060;', '&#0060;', '&#00060;', '&#000060;', '&#0000060;', '&#x3c', '&#x03c', '&#x003c', '&#x0003c', '&#x00003c', '&#x000003c', '&#x3c;', '&#x03c;', '&#x003c;', '&#x0003c;', '&#x00003c;', '&#x000003c;', '&#X3c', '&#X03c', '&#X003c', '&#X0003c', '&#X00003c', '&#X000003c', '&#X3c;', '&#X03c;', '&#X003c;', '&#X0003c;', '&#X00003c;', '&#X000003c;', '&#x3C', '&#x03C', '&#x003C', '&#x0003C', '&#x00003C', '&#x000003C', '&#x3C;', '&#x03C;', '&#x003C;', '&#x0003C;', '&#x00003C;', '&#x000003C;', '&#X3C', '&#X03C', '&#X003C', '&#X0003C', '&#X00003C', '&#X000003C', '&#X3C;', '&#X03C;', '&#X003C;', '&#X0003C;', '&#X00003C;', '&#X000003C;', '\x3c', '\x3C', '\u003c', '\u003C', chr(60), chr(62));
		$Str_Input= @str_replace($_Ary_TagsList, '', $Str_Input);
		$Str_Input= @str_replace('
		', '', $Str_Input);
		return((string)$Str_Input);
	}
    function getUniqueCode($length = 8) {
		$code = md5(uniqid(rand(), true));
		return substr($code, 0, $length);
    }
    function encode($s)
	{
		$encode = convert_uuencode($s);
		$encode = bin2hex($encode);
		return $encode;
	}
	function decode($s)
	{
		$decode = pack("H*",$s);
		$decode = convert_uudecode($decode);
		return $decode;
	}
}
?>