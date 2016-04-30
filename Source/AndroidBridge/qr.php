<?php
namespace App;

include('phpqrcode/qrlib.php'); 

$id = $argv[1];	

$img_src = "archivo".$id.".png";

$imagen = QRcode::png($id, $img_src);  
	
$imagedata = file_get_contents($img_src);

$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
$img_str = base64_encode($imgbinary);
echo $img_str;


?>
