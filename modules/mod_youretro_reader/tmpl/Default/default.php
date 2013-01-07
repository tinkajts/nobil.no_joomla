<?php
/**
 * @package		YJ Module Engine
 * @author		Youjoomla LLC
 * @website     Youjoomla.com 
 * @copyright	Copyright (c) 2007 - 2011 Youjoomla LLC.
 * @license   PHP files are GNU/GPL V2. CSS / JS / IMAGES are Copyrighted Commercial
 */
//Title: 			$yj_get_items['item_title']
//Author: 			$yj_get_items['item_author'] = username || $yj_get_items['item_author_rn'] = real name
//Image:			$yj_get_items['img_url'] = use isset to check before output
//Intro text:		$yj_get_items['item_intro']
//Create date:		$yj_get_items['item_date']
//Category:			$yj_get_items['cat_title']
//Item url:			$yj_get_items['item_url']
//Author url: 		$yj_get_items['author_url']
//Cat url:			$yj_get_items['cat_url']
//Foreach to be used =  foreach ($main_yj_arr as $yj_get_items){ echo each part here }

/*Image sizing: The images are inside div that is resizing when you enter the values in module parameters. this way there is no image disortion. For those who dont like that , you can add this
style="width:<?php echo $img_width ?>;height:<?php echo $img_height ?>;"
within image tag after alt="" (space it please) and have the images resized */

  
defined('_JEXEC') or die('Restricted access'); ?>
<!-- Youretro Reader is Powered by YJ Module Engine find out more at www.youjoomla.com -->

<div id="YRReader_container<?php echo $is_copy ?>" class="YR_reader<?php echo $container_poz ?>" style="height:<?php echo $slider_height ?>px; width:<?php echo $slider_width ?>px;"> 
  <!-- navigator -->
  <div id="yrrnavigator_outer<?php echo $is_copy ?>" class="navigator_outer" style="height:<?php echo $slider_height ?>px; width:<?php echo  ($thumb_width * 2) + 20 ?>px;">
    <ul id="yrrnavigator<?php echo $is_copy ?>" class="navigator">
      <?php foreach ($main_yj_arr as $key => $yj_get_items):?>
      <li class="yrrelement" style="height:<?php echo ($slider_height / $visibleItems) -20  ?>px;width:<?php echo $thumb_width - 10?>px;">
        <div class="inner" style="width:<?php echo $thumb_width -10 ?>px;height:<?php echo ($slider_height / $visibleItems) -20  ?>px">
          <div class="inner_over" style="width:<?php echo $thumb_width?>;height:<?php echo $slider_height / $visibleItems?>px">
            <div class="overimg" style="width:<?php echo $thumb_width ?>;height:<?php echo $slider_height / $visibleItems?>px"></div>
            <div class="img_holder" style="width:<?php echo $thumb_width ?>;height:<?php echo $slider_height / $visibleItems?>px"> <img class="retroimg" src="<?php echo $yj_get_items['img_url']; ?>" height="<?php echo $slider_height / $visibleItems?>" alt="<?php echo $yj_get_items['item_title']?>" /> </div>
          </div>
        </div>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
  <!-- end of navigator, start slides -->
  <div id="yrrslides<?php echo $is_copy ?>" class="slidesholder" style="height:<?php echo $slider_height ?>px; width:<?php echo $slider_width - ($thumb_width * 2) - 20 ?>px;">
    <?php foreach ($main_yj_arr as $yj_get_items):?>
    <div class="yrrslide" style="height:<?php echo $slider_height ?>px; width:<?php echo $slider_width - ($thumb_width * 2)  ?>px;">
      <h1 class="yr_into_title"><a href="<?php echo $yj_get_items['item_url'] ?>" title="<?php echo  $yj_get_items['item_title'] ?>"><?php echo  $yj_get_items['item_title'] ?></a></h1>
      <?php if($show_read == 1) :
		  
		  $intro_width = $slider_width - ($thumb_width * 2) - 272;
		  
		   ?>
       <div class="youretro_readon">
     	 <a class="yrreadon" href="<?php echo $yj_get_items['item_url'] ?>"> 
         	<span><?php echo JText::_('READ_MORE_TEXT') ?></span> 
         </a>
      </div>
      <?php
		  else:
		  	$intro_width = $slider_width - ($thumb_width * 2) - 40;
		  endif; ?>
      <?php  if (isset($yj_get_items['img_url']) && $yj_get_items['img_url'] != "" && $show_img == 1) :?>
      <a class="yrreader_img" style="height:<?php echo $intro_cont_height ?>;width:<?php echo $intro_width ?>px;" href="<?php echo $yj_get_items['item_url'] ?>" title="<?php echo  $yj_get_items['item_title'] ?>"> <span style="height:<?php echo $intro_cont_height ?>;width:<?php echo $intro_width ?>px;"> <img src="<?php echo $yj_get_items['img_url'] ?>" alt="<?php echo $yj_get_items['item_title']?>" width="<?php echo $intro_width ?>" /> </span> </a>
      <?php endif; ?>
      <?php if ($show_intro == 1 ):?>
      <div class="long_desc" style="width:<?php echo $intro_width ?>px;"> <?php echo $yj_get_items['item_intro'] ?> </div>
      <?php endif; ?>
    </div>
    <?php endforeach;?>
  </div>
</div>
