<?php
 
// No direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.multiselect');// Select/Deselect all
jimport( 'joomla.html.html.grid' );
jimport('joomla.filesystem.file');

$breadcrumbmenuState = $this->escape($this->state->get('breadcrumbmenuState'));

$app = JFactory::getApplication();
$prefix = $app->getCfg('dbprefix');

$this->doc->addScript(JURI::root().'administrator'.DS.'components'.DS.'com_ccs'.DS.'assets'.DS.'js'.DS.'mootools-more-1.4-full.js');


?>    
<div class="<?php echo $this->alias;?>">
<h2><?php echo JText::_( strtoupper($this->alias) );?></h2>
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm" id="adminForm" class="<?php echo $this->alias;?>">
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="table-layout:fixed">
<tbody>
<tr>
<td class="CCS_sidePanel">
<label><?php echo JText::_('COM_CCS_MENU'); ?></label>
<input type="text" name="p" title="<?php echo JText::_("COM_CCS_BREADCRUMBMENU_FILTER");?>" id="breadcrumbMenu_input" />
<ul id="breadcrumbMenu"></ul>
<?php
require_once("breadcrumbMenu.php");
?>
</td>
<td class="CCS_tableView">



<!-- ################################################################################################################## -->
<!-- ################################################################################################################## -->

<label><?php echo JText::_("COM_CCS_QUICK_ICONS"); ?></label>

<?php

if(!empty($this->quickIcons)){
foreach ($this->quickIcons as $icon) {

// Is image exists
if( @GetImageSize(JURI::root().$icon["db_image"]) ){
	$icon_image=JURI::root().$icon["db_image"];
}else{
	$icon_image=JURI::root().'administrator'.DS.'components'.DS.'com_ccs'.DS.'assets'.DS.'images'.DS.'icon-64-ccs.png';
}
	
echo '
<div class="quickIcon">
<a href="#" onclick="
parentID = breadcrumbMenu_getParentID(\''.$icon["id"].'\');
document.id(\'breadcrumbmenuState\').value=parentID;
document.id(\'layout\').value=breadcrumbMenu_items[\''.$icon["id"].'\'][\'layout\'];
document.id(\'filter_order\').value=\'\';
document.id(\'filter_order_Dir\').value=\'\';
document.id(\'alias\').value=breadcrumbMenu_items[\''.$icon["id"].'\'][\'alias\'];
document.id(\'adminForm\').submit();
return false;
">
<img src="'.$icon_image.'" alt="">
<span>'.JText::_($icon["db_alias"]).'</span>
</a>
</div>
';

}
}

require_once('personal_notes.php');

?>






<!-- ################################################################################################################## -->
<!-- ################################################################################################################## -->





</td>
</tr>
</tbody>
</table>

<input type="hidden" name="option" value="com_ccs" />
<input type="hidden" name="controller" value="ccs" />
<input type="hidden" name="layout" id="layout" value="default" />
<input type="hidden" name="task" id="task" value="" />
<input type="hidden" name="alias" id="alias" value="home" />
<input type="hidden" name="filter_order" id="filter_order" value="<?php echo $listOrder; ?>" />
<input type="hidden" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $listDirn; ?>" />
<input type="hidden" name="breadcrumbmenuState" id="breadcrumbmenuState" value="<?php echo $breadcrumbmenuState; ?>" />
<input type="hidden" name="filter_search_value" id="filter_search_value" value="" />
<input type="hidden" name="filter_search_column" id="filter_search_column" value="" />

</form>
</div>