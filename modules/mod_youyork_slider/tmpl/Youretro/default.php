<?php
/*======================================================================*\
|| #################################################################### ||
|| # Copyright (C) 2006-2010 Youjoomla LLC. All Rights Reserved.        ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- THIS IS NOT FREE SOFTWARE ---------------- #      ||
|| # http://www.youjoomla.com | http://www.youjoomla.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<!-- http://www.Youjoomla.com  Youyork Module Slider for Joomla 1.5 starts here -->
<div id="yy_container<?php echo $is_copy ?>" class="yy_container" style="width:<?php echo $slider_width ?>;height:<?php echo $slider_height ?>;">
    <a class="linkForward"></a>
        <div id="yy_slider<?php echo $is_copy ?>" class="yy_slider" style="width:<?php echo $slider_width -0 ?>px;height:<?php echo $slider_height ?>;">
            <?php  for($m = 0;$m<count($slide2mods);$m++){
                        $slide2_out = JModuleHelper::getModules($slide2mods[$m]);
                            foreach (array_keys($slide2_out) as $o) {
                                $getmodule 				= JModuleHelper::getModule( ''.$slide2_out[$o]->name.'', ''.$slide2_out[$o]->title.'' );
                                $mt_attribs['style'] 	= 'raw';
                                $mt_module 				= JModuleHelper::renderModule( $getmodule, $mt_attribs );
                            ?>
                <div class="yy_slideitems" style="width:<?php echo $items_width ?>px;height:<?php echo $yy_slideitems_height ?>px;">
                   <div class="yy_slideitems_in" style="height:<?php echo $yy_slideitems_height + 40 ?>px;">
							<?php if ($showtitle == 1 ): //checks if Show Module Title is set to yes is ?>
                                        <div class="yy_module_title">
                                            <?php echo $titles[$m] ?>
                                        </div>
                            <?php endif; ?>  
                        <?php echo $mt_module  ?>                
                   </div>
                </div>
            <?php } } ?>  
        </div>
    <a class="linkBackward"></a>
</div>