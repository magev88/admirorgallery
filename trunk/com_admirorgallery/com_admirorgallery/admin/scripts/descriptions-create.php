<?php

$ag_desc_content=$_POST["ag_desc_contentArray"];
$ag_url_desc=$_POST["ag_url_desc"];

$ag_desc_contentArray = split(",",$ag_desc_content);

$ag_content = "";

for($a = 0; $a < count($ag_desc_contentArray) ; $a+=2) {
     if(strlen($ag_desc_contentArray[$a+1]) > 0){
          $ag_content .= '{'.substr($ag_desc_contentArray[$a],3,strlen($ag_desc_contentArray[$a])).'}'.$ag_desc_contentArray[$a+1].'{/'.substr($ag_desc_contentArray[$a],3,strlen($ag_desc_contentArray[$a])).'}'."\n";
     }
}

$handle = fopen($ag_url_desc,"w") or die("");
if(fwrite($handle,$ag_content)){
	echo 'created';
};
fclose($handle);



?>