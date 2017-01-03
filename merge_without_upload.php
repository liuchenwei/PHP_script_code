<?php
$img_bg = "bg.png";
$img_info = array(
	array("9.png", 14, 22),
//	array("3.png", 14, 22),
//	array("4.png", 14, 22),
//	array("5.png", 14, 22),
//	array("6.png", 14, 22),
//	array("7.png", 14, 22),
//	array("8.png", 14, 22),
//	array("9.png", 14, 22),
);
$img_quality = 100; //定义图片质量为100，用在imagejpeg函数上

// 图片合成功能一：根据需要覆盖图片
function img_merge(&$dst_im, &$src_im, $center_x, $center_y, $src_w, $src_h)
{
	$dst_x = $center_x - $src_w / 2;
	$dst_y = $center_y - $src_h / 2;
	imagecopy($dst_im, $src_im, $dst_x, $dst_y, 0, 0, $src_w, $src_h); // 拷贝图像或者图像的一部分
}

function img_merge2(&$dst_im, &$src_im, $center_x, $center_y, $src_w, $src_h)
{
	$dst_x = $center_x - $src_w / 2;
	$dst_y = $center_y - $src_h / 2;
	imagecopy($dst_im, $src_im, $dst_x+10, $dst_y, 0, 0, $src_w, $src_h); // 拷贝图像或者图像的一部分
}

function img_merge3(&$dst_im, &$src_im, $center_x, $center_y, $src_w, $src_h)
{
	$dst_x = $center_x - $src_w / 2;
	$dst_y = $center_y - $src_h / 2;
	imagecopy($dst_im, $src_im, $dst_x+20, $dst_y, 0, 0, $src_w, $src_h); // 拷贝图像或者图像的一部分
}

// begin
$img_data = array();
$img_size = array();

$target_img = Imagecreatefrompng($img_bg); // 创建一块画布，并从 png 文件载入一副图像
$num=0;
//foreach ($img_info as $i => $v){
//    $img_source = Imagecreatefrompng($v[0]); // 创建一块画布，并从 png 文件载入一副图像
//    $img_data[$i] = $img_source;
//    $img_size[$i] = getimagesize($v[0]); // 获取图像大小及相关信息
//}

$target_img = Imagecreatefrompng($img_bg); // 创建一块画布，并从 png 文件载入一副图像
foreach ($img_info as $i => $v){
    $img_source = Imagecreatefrompng($v[0]);
	$img_source2 = Imagecreatefrompng("9.png");
	$img_source3 = Imagecreatefrompng("p.png");
    $img_size = getimagesize($v[0]);
    img_merge($target_img, $img_source, $v[1], $v[2], $img_size[0], $img_size[1]); // 主要功能函数
	img_merge2($target_img, $img_source2, $v[1], $v[2], $img_size[0], $img_size[1]); // 主要功能函数
	img_merge3($target_img, $img_source3, $v[1], $v[2], $img_size[0], $img_size[1]); // 主要功能函数
    imagedestroy($img_source);
	print_out($target_img,$num);
	$num++;
}

function print_out($target_img,$num)
{
//output to buffer
	ob_start();
	$bg = imagecolorallocatealpha($target_img, 0, 0, 0, 127);
	imagealphablending($target_img, false);
	imagefill($target_img, 0, 0, $bg);
	imagesavealpha($target_img, true);
	$ret = imagepng($target_img, "o".$num.".png"); // 以 png 格式将图像输出到浏览器或文件
	if (false === $ret) {
		echo "output failed";
	}
	ob_get_clean(); // 得到当前缓冲区的内容并删除当前输出缓冲区。
}
//
//echo "<p>file size: " . strlen($str_img_data) . "</p>";
//?>
<!--<img src="output.jpg"/>-->
