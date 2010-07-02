<?php
defined('_JEXEC') or die('Restricted access');
/**
 * Makes directory, returns TRUE if exists or made
 *
 * @param string $pathname The directory path.
 * @return boolean returns TRUE if exists or made or FALSE on failure.
 */
function mkdir_recursive($pathname, $mode)
{
    is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname), $mode);
    return is_dir($pathname) || @mkdir($pathname, $mode);
}

function SureRemoveDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}

//Gets the atributes value by name, else returns false
function ag_getAttribute($attrib, $tag)
{
        //get attribute from html tag
        $re = '/' . preg_quote($attrib) . '=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
        if (preg_match($re, $tag, $match)) {
        return urldecode($match[2]);
        }
        return false;
}
//Gets the atributes value by name, else returns false
function ag_getParams($attrib, $tag, $default)
{
        //get attribute from html tag
        $re = '/' . preg_quote($attrib) . '=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
        if (preg_match($re, $tag, $match)) {
        return urldecode($match[2]);
        }
        return $default;
}

//Creates thumbnail from original images, return $errorMessage;
function ag_createThumb($original_file, $thumb_file, $new_h) {

    $errorMessage = '';

    if (preg_match("/jpg|jpeg/i", $original_file)) {
        @$src_img = imagecreatefromjpeg($original_file);
    } else if (preg_match("/png/i", $original_file)) {
        @$src_img = imagecreatefrompng($original_file);
    } else if (preg_match("/gif/i", $original_file)) {
        @$src_img = imagecreatefromgif($original_file);
    } else {
        return '<div class="error">Unsupported image type for image "'.$original_file.'". </div>';
    }
    @$old_x = imageSX($src_img);
    @$old_y = imageSY($src_img);

    @$thumb_w = $old_x * ($new_h / $old_y);
    @$thumb_h = $new_h;

    if($thumb_w==0 || $thumb_h==0){
        return '<div class="error">Image "'.$original_file.'" is missing or not valid. Cannot read this image.</div>';
    }

    @$dst_img = imagecreatetruecolor($thumb_w, $thumb_h);

    @imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

    if (preg_match("/jpg|jpeg/i", $original_file)) {
        @imagejpeg($dst_img, $thumb_file);
    } else if (preg_match("/png/i", $original_file)) {
        @imagepng($dst_img, $thumb_file);
    } else if (preg_match("/gif/i", $original_file)) {
        @imagegif($dst_img, $thumb_file);
    } else {
        return '<div class="error">Could not create thumbnail file for image "'.$original_file.'"! </div>';
    }
    @imagedestroy($dst_img);
    @imagedestroy($src_img);
    return $errorMessage;
}
//Read's all images from folder.
function ag_imageArrayFromFolder($targetFolder,$sort){
	unset($images);
	if (!file_exists($targetFolder))
	{
		return null;
	}
	if ($dh = opendir($targetFolder)) {
	  while (($f = readdir($dh)) !== false) {
		  if((substr(strtolower($f),-3) == 'jpg') || (substr(strtolower($f),-4) == 'jpeg') || (substr(strtolower($f),-3) == 'gif') || (substr(strtolower($f),-3) == 'png')) {
			  $images[] = $f;
		  }
	  }
	  if (isset($images))
	  {
		  if ($sort)
		  {
			  for($i=0;$i<count($images);$i++)
			  {
				$imagesPath[$i]=$targetFolder.$images[$i];
			  }
			  array_multisort(
					array_map( 'filectime', $imagesPath ),
					SORT_NUMERIC,
					SORT_DESC,
					$images
				);
			  unset($imagesPath);
		  }
		  else
				array_multisort($images, SORT_ASC, SORT_REGULAR);
	  return $images;
	 }
	 else
	 {
		return null;
	 }
	 closedir($dh);
  }

}
//Read's all floders in folder.
function ag_foldersArrayFromFolder($targetFolder){

	unset($folders);

	if (!file_exists($targetFolder))
	{
		return null;
	}
	$folders = array();

	if ($dh = opendir($targetFolder)) {
	  while (($f = readdir($dh)) !== false) {
		  if(is_dir($targetFolder.$f) && $f!="." && $f!="..") {
			  $folders[] = $f;
		  }
	  }
	  return $folders;
	 }else{
		return null;
	 }

	 closedir($dh);
}

function ag_clearOldThumbs($thumbsFolder, $imagesFolder){

  // Generate array of thumbs
  $targetFolder=$thumbsFolder;
  $thumbs=ag_imageArrayFromFolder($targetFolder,0);

  // Generate array of images
  $targetFolder=$imagesFolder;
  $images=ag_imageArrayFromFolder($targetFolder,0);

  if (empty($images)){
  SureRemoveDir($thumbsFolder, 1);
  return;
  }

  // Locate and delete old thumbs
  if(!empty($thumbs)){
    foreach ($thumbs as $thumbsKey => $thumbsValue){
      if ((!in_array($thumbsValue, $images)) && (!empty($thumbsValue)) && file_exists($thumbsFolder.$thumbsValue)) {
         unlink($thumbsFolder.$thumbsValue);
      }
    }
  }
}

function ag_cleanThumbsFolder($originalFolder,$thumbFolder)
{
	$origin= ag_foldersArrayFromFolder($originalFolder);
	$thumbs= ag_foldersArrayFromFolder($thumbFolder);
	$diffArray= array_diff($thumbs,$origin);
	if ($diffArray!=null)
	{
		foreach ($diffArray as $diffFolder) {
			 SureRemoveDir($thumbFolder.$diffFolder,true);
		}
	}
}
// This script is part of ACMS, Admiror Content Management System.
// Copyright Admiror Design Studio, 2009. All rights reserved.
// Script by Igor Kekeljevic.
// Edited by Nikola :)

function ag_indexWrite($filename){

  $handle = fopen($filename,"w") or die("");
  $contents = fwrite($handle,'<html><body bgcolor="#FFFFFF"></body></html>');
  fclose($handle);

}

?>