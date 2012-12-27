<?php

///////////////////////////////////////////////
//	CREATE LISTING
///////////////////////////////////////////////

$dbObject = JFactory::getDBO();
$query = $dbObject->getQuery(true);
$query->select('*');
$query->order($dbObject->getEscaped($FIELD_PARAMS->label.' ASC'));
$query->from($dbObject->nameQuote($FIELD_REL->table));
$dbObject->setQuery($query);
$ROWS = $dbObject->loadAssocList();

echo '
<div style="display:none;">
<div id="hello">
<h1>' . JText::_($FIELD_NAME) . '</h1>
<ul>
';


$JS_FIELD_REL_VALUES='
//////////////////////////////
// FIELD REL DECLARE DOM READY
//////////////////////////////
window.addEvent("domready", function(){
AVC_REL[\'' . $FIELD_NAME . '\'] = new Object();
';
foreach($ROWS as $ROW){
	$JS_FIELD_REL_VALUES.='AVC_REL[\'' . $FIELD_NAME . '\'][\'' . $ROW[$FIELD_PARAMS->value] . '\'] = "' . $ROW[$FIELD_PARAMS->label] . '";'."\n";
}
$JS_FIELD_REL_VALUES.='
});
';

foreach($ROWS as $ROW){
	echo '
		<li>
			<a
				href="#"
				onclick="
					window.parent.jInsertRelSelect(\'' . $FIELD_NAME . '\', \'' . $ROW[$FIELD_PARAMS->value] . '\');
					window.parent.SqueezeBox.close();
					return false;
				"
			>
			' . $ROW[$FIELD_PARAMS->label] . ' (' . $ROW[$FIELD_PARAMS->value] . ')
			</a>
		</li>
		';
}

$this->doc->addScriptDeclaration($JS_FIELD_REL_VALUES);

echo '
</ul>
</div>
</div>
';


echo '
<div class="form_items form_items2">
';


///////////////////////////////////////////////
//	ADD LABEL
///////////////////////////////////////////////

echo '
<label id="jform_enabled-lbl" for="jform_enabled">
	' . JText::_( strtoupper($FIELD_TITLE)) . '
</label>
';


///////////////////////////////////////////////
//	ADD INPUT
///////////////////////////////////////////////

echo
'
<div class="AVC_frame">
<input
	onkeyup="relOnChange(\'' . $FIELD_NAME . '\', $(this).get(\'value\'));"
	tabindex="' . $TABINDEX . '"
	type="text"
	id="' . $FIELD_NAME . '"
	name="' . $FIELD_NAME . '"
	value="' . $FIELD_VALUE . '"
	class="avc_rel width_auto"
	title="' . JText::_('COM_AVC_TOOLTIPS_VARCHAR') . '"
	size="4"
/>
<span id="lbl_' . $FIELD_NAME . '"></span>
</div>
';

///////////////////////////////////////////////
//	ADD BUTTON
///////////////////////////////////////////////

echo
'
<input type="button" class="pointer width_auto" value="'.JText::_('COM_AVC_SELECT').'"
	onclick="
		SqueezeBox.fromElement($(\'hello\'), {
			handler:\'clone\',
			size: {
				x: 400,
				y: 600,
			}
		});
		return false;
	"
	>
<input type="button" class="pointer width_auto" value="'.JText::_('COM_AVC_CLEAR').'"
	onclick="
		jInsertRelSelect(\'\',\'\');
		return false;
	"
	>

';

echo
'
</div>
';