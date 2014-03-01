<?php
/*
pixtulate parameters: http://pixtulate.com/docs/crop.htm#cookbook
parameter   description                             type                mandatory                   default
w, width    desired width                           int, %, ‘max’       not if height is given   
h, height   desired height                          int, %, ‘max’       not if width is given    
tlc         top left corner of crop area            int, ‘min’, ‘max’   not if brc is given  
brc         bottom right corner of crop area        int, ‘min’, ‘max’   not if tlc is given  
fp          focal point where to center crop area   int                 no   
dpr         device pixel resolution                 decimal             no                          1
 
Typical screen widths: https://developer.android.com/guide/practices/screens_support.html
320dp: a typical phone screen (240x320 ldpi, 320x480 mdpi, 480x800 hdpi, etc).
480dp: a tweener tablet like the Streak (480x800 mdpi).
600dp: a 7” tablet (600x1024 mdpi).
720dp: a 10” tablet (720x1280 mdpi, 800x1280 mdpi, etc).
*/
$output = '';
 
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
//mobile android
if(stripos($ua,'android') !== false && stripos($ua,'mobile') !== false) {
    $detect = "400";
}
//mobile iphone
elseif(stripos($ua,'iphone') !== false) {
    $detect = "400";
}
//tablet android
elseif(stripos($ua,'android') !== false && stripos($ua,'mobile') == false) {
    $detect = "600";
}
//tablet ipad
elseif(stripos($ua,'ipad') !== false) {
    $detect = "600";
}
//laptop
else {
    $detect = "800";
}
 
//snippet parameters
$api    = isset($api)   ? $api  : 'http://demo.api.pixtulate.com/';
$pic    = isset($pic)   ? $pic  : 'demo/large-4.jpg';
$alt    = isset($alt)   ? $alt  : '';
$w      = isset($w)     ? $w    : $detect;
$h      = isset($h)     ? $h    : '';
$tlc    = isset($tlc)   ? $tlc  : '';
$brc    = isset($brc)   ? $brc  : '';
$fp     = isset($fp)    ? $fp   : '';
$dpr    = isset($dpr)   ? $dpr  : '1';
 
$data = array(
    'tlc'   =>   $tlc,
    'brc'   =>   $brc,
    'w'     =>   $w,
    'h'     =>   $h,
    'fp'    =>   $fp,
    'dpr'   =>   $dpr
);
$src = $api . $pic . "?" . http_build_query($data);
$output = '<img src="'. $src .'" alt="'. $alt .'">'; 
return $output;
?>
