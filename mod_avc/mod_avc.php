<?php

/**
 * @package		Joomla.Site
 * @subpackage	mod_breadcrumbs
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . DS . 'helper.php';

// REQUIRE ONCE BEFORE
require_once dirname(__FILE__) . DS . 'require_once_before.php';

$AVC = new AVC( $module->id, $params->get('MOD_AVC_LAYOUT_DATABASE_ID') );

// REQUIRE ONCE AFTER
require_once dirname(__FILE__) . DS . 'require_once_after.php';

require JModuleHelper::getLayoutPath('mod_avc', $params->get('layout', 'default'));