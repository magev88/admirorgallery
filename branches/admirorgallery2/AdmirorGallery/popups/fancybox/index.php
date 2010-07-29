<?php
defined('_JEXEC') or die('Restricted access');

$this->loadJS('popups/'.$this->params['popupEngine'].'/js/jquery.easing-1.3.pack.js');
$this->loadJS('popups/'.$this->params['popupEngine'].'/js/jquery.fancybox-1.3.1.pack.js');
$this->loadJS('popups/'.$this->params['popupEngine'].'/js/jquery.mousewheel-3.0.2.pack.js');
$this->loadCSS('popups/'.$this->params['popupEngine'].'/css/jquery.fancybox-1.3.1.css');
$this->popupEngine->rel = 'fancybox[AdmirorGallery'.$this->getGalleryID().']';
$this->popupEngine->jsInclude='<script type="text/javascript" charset="utf-8">
        jQuery("a[rel='.$this->popupEngine->rel.']").fancybox({
		 \'transitionIn\' : \'elastic\',
		 \'transitionOut\' : \'elastic\',
		 \'easingIn\' : \'easeOutBack\',
		 \'easingOut\' : \'easeInBack\'
        });
</script>'
?>