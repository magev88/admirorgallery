<?php

echo '<div class="form_items form_items1">';

// Create Form Field Label
echo '<label id="jform_enabled-lbl" for="jform_enabled">';
echo JText::_(strtoupper($FIELD_ALIAS));
echo '</label>';

$javascript__label = explode("|", $FIELD_PARAMS);
echo '<input type="button" class="pointer width_auto" onclick="' . $FIELD_PARAMS["onclick"] . '" value="' . JText::_( $FIELD_PARAMS["label"] ) . '" />';

echo '</div>';