 <?php
 $setting = new OssnSite;
 $logo_text_text  = $setting->getSettings('gbg:logo_text_text');
 $logo_text_color = $setting->getSettings('gbg:logo_text_color');
 $logo_text_size  = $setting->getSettings('gbg:logo_text_size');
 $greeting_text   = $setting->getSettings('gbg:greeting_text');
 $extra_newsfeed_link   = $setting->getSettings('gbg:extra_newsfeed_link');
 
 ?>
 <fieldset class="titleform">
	<br>
	<input type="checkbox" name="gbg:extra_newsfeed_link" value="checked"<?php echo ' ' . $extra_newsfeed_link;?> > <?php echo ossn_print('theme:tayonapink:extra:newsfeed:link');?> 
	<br>
	<br>
	<hr>
	<h3><?php echo ossn_print('theme:tayonapink:frontpage:settings');?></h3>
 	<div class="alert alert-warning">
    	<?php echo ossn_print('theme:tayonapink:instruction:1');?>
    </div>	
 	<div>	
    	<label><?php echo ossn_print('theme:tayonapink:logo:site');?> (450 x 90 | 500 kB png) </label>
        <input type="file" name="logo_site" />
        <div class="logo-container-tayonapink">
	        <img src="<?php echo ossn_theme_url() . 'images/logo.png?ver=' . time();?>" />
        </div>
    </div>
	
	<br>
 	<div class="alert alert-warning">
    	<?php echo ossn_print('theme:tayonapink:instruction:2');?>
    </div>	
 	<div>
    	<label><?php echo ossn_print('theme:tayonapink:logo:text:text');?> </label>
        <input type="text" name="gbg:logo_text_text" value="<?php echo ($logo_text_text ?: ossn_site_settings('site_name')); ?>" />
    </div>

 	<div>	
    	<label><?php echo ossn_print('theme:tayonapink:logo:text:color');?> </label>
		<input type="text" name="gbg:logo_text_color" id="logo_text_color" class="cp-position" value="<?php echo ($logo_text_color ?: 'rgb(210,210,60)'); ?>" />
	</div>

 	<div>	
    	<label><?php echo ossn_print('theme:tayonapink:logo:text:size');?> </label>
		<input class="tayonapink-number" type="number" name="gbg:logo_text_size" value="<?php echo ($logo_text_size ?: '22'); ?>" min="1" max="50" />
	</div>

	<br>
 	<div class="alert alert-warning">
    	<?php echo ossn_print('theme:tayonapink:instruction:3');?>
    </div>	
 	<div>
    	<label><?php echo ossn_print('theme:tayonapink:greeting:text');?> </label>
        <input type="text" name="gbg:greeting_text" value="<?php echo ($greeting_text ?: ''); ?>" />
    </div>

	<br>
	<hr>
	<h3><?php echo ossn_print('theme:tayonapink:backend:settings');?></h3>
 	<div class="alert alert-warning">
    	<?php echo ossn_print('theme:tayonapink:instruction:4');?>
    </div>	
  	<div>	
    	<label><?php echo ossn_print('theme:tayonapink:logo:admin');?> (180 x 45 | 500 kB jpg)</label>
        <input type="file" name="logo_admin" />
        <div class="admin-logo-container-tayonapink">
	        <img src="<?php echo ossn_theme_url();?>images/logo_admin.jpg" />
        </div>
    </div>   
	<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save');?>"/>
</fieldset>
