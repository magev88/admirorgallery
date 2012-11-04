<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
jimport('joomla.html.parameter');

class AdmirorgalleryController extends JController {

    function display() {
        require_once JPATH_COMPONENT . '/helpers/admirorgallery.php';
        if (!is_dir(JPATH_SITE . '/plugins/content/admirorgallery/')) {
            JError::raiseWarning('2', JText::_('COM_PLUGIN_NOT_INSTALLED'));
        }
        AdmirorGalleryHelper::addSubmenu(JRequest::getCmd('view', 'control_panel'),JRequest::getCmd('AG_resourceType', ''));

        JToolBarHelper :: custom('AG_apply', 'AG_apply', 'AG_apply', 'COM_ADMIRORGALLERY_APPLY_DESC', false, false);
        JToolBarHelper :: custom('AG_reset', 'AG_reset', 'AG_reset', 'COM_ADMIRORGALLERY_RESET_DESC', false, false);
        $doc = &JFactory::getDocument();
        $doc->addScriptDeclaration('
	       AG_jQuery(function(){

		    // SET SHORCUTS
		    AG_jQuery(document).bind("keydown", "ctrl+return", function (){submitbutton("AG_apply");return false;});
		    AG_jQuery(document).bind("keydown", "ctrl+backspace", function (){submitbutton("AG_reset");return false;});

	       });//AG_jQuery(function()
	  ');
        parent::display();
    }
}