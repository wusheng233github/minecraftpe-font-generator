<?php
// 本来没打算公开的
// 字体文件
$font_file = "./eeee.ttf";
// 输出目录(不自动创建！)
$dir = "./dir";
for($u = 0;$u <= 255;++$u) {
	if($u >= 216 && $u < 249) {
		continue;
	}
	$img = imagecreatetruecolor(256, 256);
	imagealphablending($img, false);
	imagesavealpha($img, true);
	$bg = imagecolorallocatealpha($img, 0, 0, 0, 127);
	$white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
	imagefill($img, 0, 0, $bg);
	$u2 = 0;
	for($y = 14;$y <= 254;$y = $y + 16) {
		for($x = 0;$x <= 255;$x = $x + 16) {
			$a = str_pad(dechex($u), 2, "0", STR_PAD_LEFT) . str_pad(dechex($u2), 2, "0", STR_PAD_LEFT);
			$json = "[\"\\u" . $a . "\"]";
			echo "\\u$a\n";
			$array = json_decode($json, true);
			imagefttext($img, 12, 0, $x, $y, $white, $font_file, $array[0]);
			++$u2;
		}
	}
	imagepng($img, $dir . "/glyph_" . str_pad(strtoupper(dechex($u)), 2, "0", STR_PAD_LEFT) . ".png");
}