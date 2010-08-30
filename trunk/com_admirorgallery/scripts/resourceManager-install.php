<?php

$file = JRequest::getVar( 'file_upload', null, 'files' );
$task = JRequest::getVar( 'task', null, 'post');

$config =& JFactory::getConfig();
$tmp_dest = $config->getValue('config.tmp_path');

$file_type = "zip";

if(isset($file) && !empty($file['name'])){ 
      //Clean up filename to get rid of strange characters like spaces etc
      $filename = JFile::makeSafe($file['name']);
      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      $src = $file['tmp_name'];
      $dest = $tmp_dest.'/'.$filename;

      //First check if the file has the right extension
      if ($ext == $file_type) {
         if ( JFile::upload($src, $dest) ) {
			if(JArchive::extract($tmp_dest.'/'.$filename, JPATH_SITE.'/plugins/content/AdmirorGallery/'. JFile::makeSafe($task) )){
			     JFile::delete($tmp_dest.'/'.$filename);
			}
			$msg = JText::_('ZIP package is installed.');
			$msgType = "notice";
         } else {
              $msg = JText::_('Cannot upload file to temp folder. Please check permissions.');
	      $msgType = "error";
         }
      } else {
         $msg = JText::_('Only zip archives can be installed.');
	 $msgType = "error";
      }
	echo '<script type="text/javascript">ag_showMessage("'. $msg .'", "'.$msgType.'");</script>';
}

?>