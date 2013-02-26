<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>    

<div>
    <h1 class="pageTitle"><?php echo JText::_("COM_AVC_HOME"); ?></h1>
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm" id="adminForm" class="<?php echo $this->alias; ?>">
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tbody>
                <tr>
                    <td class="AVC_sidePanel">
                        
                        <!-- MENU -->
                        <?php
                            require_once("menu.php");
                        ?>

                    </td>
                    <td class="AVC_tableView">
                        <label><?php echo JText::_("COM_AVC_QUICK_ICONS"); ?></label>

                        <!-- QUICK ICONS -->
                        <?php
                        if (!empty($this->views)) {
                            foreach ($this->views as $index => $view) {
                                if ($view["published"]) {
                                    // Is image exists
                                    if (!empty ($view["icon_path"])) {
                                        $view_image = JURI::root() . $view["icon_path"];
                                    } else {
                                        $view_image = JURI::root() . 'administrator/components/com_avc/assets/images/icon-64-avc.png';
                                    }

                                    echo '
                                    <div class="quickIcon">
                                    <a href="#" onclick="
                                    AVC_menu_exec(\''.$index.'\',AVC_menu_items[\''.$index.'\'][\'layout\']);
                                    return false;
                                    ">
                                    <img src="' . $view_image . '" alt="">
                                    <span>' . JText::_($view["name"]) . '</span>
                                    </a>
                                    </div>
                                    ';
                                }
                            }
                        }
                        ?>

                        <!-- PERSONAL NOTES -->
                        <?php
                            require_once('personal_notes.php');
                        ?>

                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="option" value="com_avc" />
        <input type="hidden" name="controller" value="avc" />
        <input type="hidden" name="layout" id="layout" value="default" />
        <input type="hidden" name="task" id="task" value="task" />
        <input type="hidden" name="curr_view_id" id="curr_view_id" value="<?php echo $this->curr_view_id;?>" />

    </form>
</div>

<?php
    require_once("forcedStyles.php");
?>