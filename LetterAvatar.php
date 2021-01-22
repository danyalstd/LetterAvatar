<?php
/**
 * Letter Avatar compatible with Persian language for PHP
 * @version 0.9.1
 * @author  https://github.com/danyalstd
*/
function colorFromString($text){
	$min_brightness=100;
	$spec=10;
	$hash = md5($text);
	$colors = array();
	for($i=0;$i<3;$i++){
		$colors[$i] = max(array(round(((hexdec(substr($hash,$spec*$i,$spec)))/hexdec(str_pad('',$spec,'F')))*255),$min_brightness));
	}
	while( array_sum($colors)/3 < $min_brightness ){
		for($i=0;$i<3;$i++){
			$colors[$i] += 10;
		}
	}
	$output = '';
	for($i=0;$i<3;$i++){
		$output .= str_pad(dechex($colors[$i]),2,0,STR_PAD_LEFT);
	}
	$hex = '#'.$output;
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    $r = floor($r/2);
    $g = floor($g/2);
    $b = floor($b/2);
    
    return array("r"=>$r,"g"=>$g,"b"=>$b);
}

function createAvatar($text,$settings = array()){
    if(isset($settings['size'])){
        $size = $settings['size'];
    }else{
        $size = "120";
    }
    $im = imagecreatetruecolor($size, $size);
        
    imagealphablending($im, true);
    imagesavealpha($im, true);
    imagefill($im,0,0,0x7fffffff);
    if(isset($settings['background'])){
        $hex = $settings['background'];
    	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        $color = array("r"=>$r,"g"=>$g,"b"=>$b);
    }else{
        $color = colorFromString($text);
    }
    
    $background = imagecolorallocate($im, $color['r'], $color['g'], $color['b']);
    
    $white = imagecolorallocate($im, 255, 255, 255);
    if($settings['shape'] == "square"){
        imagefilledrectangle($im, 0, 0, $size, $size, $background);
    }else{
        imagefilledellipse($im,$size/2,$size/2,$size,$size,$background);
    }
    $text = $_GET['q'];
    
    $text = explode(" ",$text);
    if(isset($settings['words'])){
        $words = $settings['words'];
    }else{
        $words = "one";
    }
    if(isset($settings['direction'])){
        $direction = $settings['direction'];
    }else{
        $direction = "rtl";
    }
    
    if($words == "one"){
        if($direction == "rtl"){
            $text = mb_substr($text[0],0,1);
        }else{
            $text = strtoupper(mb_substr($text[0],0,1));
        }
    }elseif($words == "two"){
        if(count($text) > 1){
            if($direction == "rtl"){
                $text = mb_substr($text[count($text)-1],0,1)." ".mb_substr($text[0],0,1);
            }else{
                $text = strtoupper(mb_substr($text[0],0,1)." ".mb_substr($text[count($text)-1],0,1));
            }
        }else{
            if($direction == "rtl"){
                $text = mb_substr($text[0],0,1);
            }else{
                $text = strtoupper(mb_substr($text[0],0,1));
            }
        }
    }
    
    if(isset($settings['font'])){
        $font = $settings['font'];
    }else{
        $font = 'vazir.ttf';
    }
    if(isset($settings['fontSize'])){
        $fontSize = $settings['fontSize'];
    }else{
        $fontSize = $size/3;
    }
    
    $tb = imagettfbbox($fontSize, 0, $font, $text);
    $max_height =  max(array($tb[1],$tb[3],$tb[5],$tb[7]));
    $min_height =  min(array($tb[1],$tb[3],$tb[5],$tb[7]));
    $height =  abs($max_height)  -  abs($min_height);
    $y = $size/2 - ($height/2);
    $x = ceil(($size - $tb[2]) / 2);
    
    imagettftext($im, $fontSize, 0, $x, $y, $white, $font, $text);
    imagepng($im);
    imagedestroy($im);
}
