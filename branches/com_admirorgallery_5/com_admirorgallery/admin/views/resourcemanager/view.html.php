<?php

/* ------------------------------------------------------------------------
  # com_admirorgallery - Admiror Gallery Component
  # ------------------------------------------------------------------------
  # author   Igor Kekeljevic & Nikola Vasiljevski
  # copyright Copyright (C) 2014 admiror-design-studio.com. All Rights Reserved.
  # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Websites: http://www.admiror-design-studio.com/joomla-extensions
  # Technical Support:  Forum - http://www.vasiljevski.com/forum/index.php
  # Version: 5.0.0
  ------------------------------------------------------------------------- */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class AdmirorgalleryViewResourcemanager extends JViewLegacy {

    var $ag_resourceManager_installed=null;
    var $limitstart=0;
    var $limit=0;
    var $ag_resource_type='templates';
    
    function display($tpl = null) {
        
        // Preloading joomla tools
        jimport('joomla.installer.helper');
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.archive');
        jimport('joomla.html.pagination');
        jimport('joomla.filesystem.folder');
        JHTML::_('behavior.tooltip');
        
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');
        $this->ag_resource_type = JRequest::getVar('AG_resourceType'); // Current resource type
        
        JToolBarHelper::title(JText::_('COM_ADMIRORGALLERY_' . strtoupper($this->ag_resource_type)), $this->ag_resource_type);
        if (JFactory::getUser()->authorise('core.admin', 'com_admirorgallery')) {
            JToolbarHelper::custom('ag_install', 'ag_install', 'ag_install', 'JTOOLBAR_INSTALL', false, false);
            JToolbarHelper::deleteList('COM_ADMIRORGALLERY_ARE_YOU_SURE', 'ag_uninstall', 'JTOOLBAR_UNINSTALL');
        }
        
        // Loading JPagination vars
        $this->limitstart = $mainframe->getUserStateFromRequest($option . '.limitstart', 'limitstart', 0, 'int');
        $this->limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');

        // Read folder depending on $AG_resourceType
        $this->ag_resourceManager_installed = JFolder::folders(JPATH_SITE . '/plugins/content/admirorgallery/admirorgallery/' . $this->ag_resource_type); // N U
        sort($this->ag_resourceManager_installed);
        
        parent::display($tpl);
    }

}