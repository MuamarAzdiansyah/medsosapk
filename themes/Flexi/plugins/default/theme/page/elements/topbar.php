<?php
	$hide_loggedin = '';
	if(ossn_isLoggedin()){		
		$hide_loggedin = "hidden-xs hidden-sm";
	}
?>
<!-- ossn topbar -->
<div class="topbar">
	<div class="container-fluid">
		<div class="row">
		<?php if(ossn_isLoggedin()){ ?>        
			<div class="col col-md-2 left-side left">
				<div class="topbar-menu-left">
					<li id="sidebar-toggle" data-toggle='0'>
						<a role="button" data-bs-target="#"> <i class="fa fa-th-list"></i></a>
					</li>
				</div>
			</div>
				<?php } ?>
			<div class="col-md-3 site-name text-center <?php echo $hide_loggedin;?>">
				<span><a href="<?php echo ossn_site_url();?>"><?php echo ossn_site_settings('site_name');?></a></span>
			</div>
 <?php if(ossn_isLoggedin()){ ?>
		<div class="col-md-3 hidden-xs hidden-sm">
        	<div class="topbar-search">
            	<form method="get" action="<?php echo ossn_site_url("search");?>">
                <input type="text" name="q" placeholder="<?php echo ossn_print('ossn:search');?>" onblur="if (this.value=='') { this.value=Ossn.Print('ossn:search'); }" onFocus="if (this.value==Ossn.Print('ossn:search')) { this.value='' };"/>
				</form>
            </div>
        </div>
        <?php } ?>            
			<div class="col-8 col-md-4 text-right right-side">
				<div class="topbar-menu-right">
					<ul>
					<li class="ossn-topbar-dropdown-menu">
						<div class="dropdown">
						<?php
							if(ossn_isLoggedin()){						
								echo ossn_plugin_view('output/url', array(
									'role' => 'button',
									'data-bs-toggle' => 'dropdown',
									'data-bs-target' => '#',
									'text' => '<i class="fa fa-sort-down"></i>',
								));									
								echo ossn_view_menu('topbar_dropdown'); 
							}
							?>
						</div>
					</li>                
					<?php
						if(ossn_isLoggedin()){
							echo ossn_plugin_view('notifications/page/topbar');
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ./ ossn topbar -->
