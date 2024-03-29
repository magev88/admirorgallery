<?php

$form_items_width = 1;
if( !empty( $FIELD_PARAMS["width"] ) ){
	$form_items_width = $FIELD_PARAMS["width"];
}
$form_items_height = 1;
if( !empty( $FIELD_PARAMS["height"] ) ){
	$form_items_height = $FIELD_PARAMS["height"];
}

echo '
<div class="form_items form_item_width_'. $form_items_width .' form_item_height_'. $form_items_height .'">
';

// Create Form Field Label
echo '<label id="jform_enabled-lbl" for="jform_enabled">';
echo JText::_( strtoupper($FIELD_ALIAS));
echo '</label>';

echo '<select tabindex="'.$TABINDEX.'" name="'.$FIELD_ALIAS.'" class="required editlinktip" title="'.JText::_('COM_AVC_TOOLTIPS_DROPLIST').'">';			
echo '<option value="">'.JText::_("COM_AVC_SELECT_NONE").'</option>';

foreach($FIELD_PARAMS as $PARAM_KEY => $PARAM_VALUE)// Add Dropbox item for any param founded
{

	$selected=NULL;					
	if($PARAM_KEY == $FIELD_VALUE)// Add Selected Value
	{
		$selected=' selected="selected"';
	}
	echo '<option value="'.$PARAM_KEY.'"'.$selected.'>'.JText::_( $PARAM_VALUE ).'</option>';

}

echo '</select>';

echo '</div>';