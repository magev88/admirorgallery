<?php
 /*------------------------------------------------------------------------
# admirorgallery - Admiror Gallery Plugin
# ------------------------------------------------------------------------
# author   Igor Kekeljevic & Nikola Vasiljevski
# copyright Copyright (C) 2011 admiror-design-studio.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.admiror-design-studio.com/joomla-extensions
# Technical Support:  Forum - http://www.vasiljevski.com/forum/index.php
# Version: 4.5.0
-------------------------------------------------------------------------*/

// Joomla security code
defined('_JEXEC') or die('Restricted access');

// Load JavaScript from current popup folder
$this->loadJS($this->currPopupRoot . 'lib/klass.min.js');
$this->loadJS($this->currPopupRoot . 'code.photoswipe-3.0.5.min.js');

// Load CSS from current popup folder
$this->loadCSS($this->currPopupRoot . 'photoswipe.css');

// Set REL attribute needed for Popup engine
$this->popupEngine->rel = 'photoswipe[AdmirorGallery' . $this->getGalleryID() . ']';

// Insert JavaScript code needed to be loaded after gallery is formed
$this->popupEngine->endCode = '	
<script type="text/javascript">
    (function(window, PhotoSwipe){		
        document.addEventListener(\'DOMContentLoaded\', function(){
            var options = { enableMouseWheel: false , enableKeyboard: false },
            instance = PhotoSwipe.attach( window.document.querySelectorAll(\'#AG_' . $this->getGalleryID() . ' a\'), options );
        }, false);
    }
    (window, window.Code.PhotoSwipe));
</script>		
';
?>