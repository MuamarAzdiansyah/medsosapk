<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__THEMEDIR__', ossn_route()->themes . 'TayonaPink/');

ossn_register_callback('ossn', 'init', 'theme_TayonaPink_init');

function theme_TayonaPink_init(){	
	//add bootstrap
	ossn_new_css('bootstrap.min', 'css/bootstrap/bootstrap.min.css');
	
	ossn_new_css('ossn.default', 'css/core/site');
	ossn_new_css('ossn.default.overwrite', 'css/core/site_overwrite');
	ossn_new_css('ossn.admin.default', 'css/core/admin');

	//load bootstrap
	ossn_load_css('bootstrap.min', 'admin');
	ossn_load_css('bootstrap.min');

	ossn_load_css('ossn.default');
	ossn_load_css('ossn.default.overwrite');
	ossn_load_css('ossn.admin.default', 'admin');
	
	ossn_extend_view('ossn/admin/head', 'theme_TayonaPink_admin_head');
	ossn_extend_view('ossn/site/head', 'theme_TayonaPink_site_head');
    ossn_extend_view('js/opensource.socialnetwork', 'js/script');

	
	if(ossn_isAdminLoggedin()) {
		ossn_register_action('TayonaPink/settings', __THEMEDIR__ . 'actions/settings.php');
		ossn_register_admin_sidemenu('admin:theme:tayonapink', 'admin:theme:tayonapink', ossn_site_url('administrator/settings/TayonaPink'), ossn_print('admin:sidemenu:themes'));
		ossn_register_site_settings_page('TayonaPink', 'settings/admin/TayonaPink');
		ossn_unregister_menu_item('help', 'help', 'topbar_admin');
		ossn_unregister_menu_item('support', 'support', 'topbar_admin');
		ossn_unregister_menu_item('viewsite', 'viewsite', 'topbar_admin');
	}	

	if(ossn_isLoggedin()) {
		$user_loggedin = ossn_loggedin_user();

		ossn_add_hook('newsfeed_member', "sidebar:left", 'theme_TayonaPink_member_menu_handler');
		
		if(com_is_active('OssnGroups')) {
			ossn_register_sections_menu('newsfeed', array(
				'name' => 'mygroups',
				'text' => ossn_print('theme:tayonapink:section:menu:mygroups'),
				'url' => ossn_site_url('mygroups'),
				'parent' => 'personal',
				'priority' => 10,
			));
			ossn_register_page('mygroups', 'theme_TayonaPink_pagehandler');
		}
		if(com_is_active('OssnChat') && com_is_active('OssnMessages')) {
			ossn_register_sections_menu('newsfeed', array(
				'name' => 'friendsonline',
				'text' => ossn_print('theme:tayonapink:section:menu:friendsonline'),
				'url' => ossn_site_url('friendsonline'),
				'parent' => 'personal',
				'priority' => 4,
			));
			ossn_register_page('friendsonline', 'theme_TayonaPink_pagehandler');
			
			ossn_register_menu_item('topbar_dropdown', array(
				'name' => 'togglechatbar',
				'text' => ossn_print('theme:tayonapink:topbar:menu:togglechatbar'),
				'href' => 'javascript:void(0);',
				'priority' => 900
			));	
		}
		
	}
}

function theme_TayonaPink_member_menu_handler($hook, $type, $return) {
		$setting = new OssnSite;
		if(!$setting->getSettings('gbg:extra_newsfeed_link')) {
			ossn_unregister_menu_item('newsfeed', 'links', 'newsfeed');
		}
		theme_TayonaPink_remove_group_menu_items();

		/* menu transfers */
		theme_TayonaPink_transfer_menu_item('notifications', 'links', 'newsfeed', true, 'personal', 1);
		theme_TayonaPink_transfer_menu_item('messages', 'links', 'newsfeed', true, 'personal', 2);
		theme_TayonaPink_transfer_menu_item('friends', 'links', 'newsfeed', true, 'personal', 3);
		theme_TayonaPink_transfer_menu_item('photos', 'links', 'newsfeed', true, 'personal', 5);
		theme_TayonaPink_transfer_menu_item('notes', 'links', 'newsfeed', true, 'personal', 6);
		
		theme_TayonaPink_transfer_menu_item('myblogs', 'blogs', 'newsfeed', true, 'personal', 20);
		theme_TayonaPink_transfer_menu_item('files_my', 'files', 'newsfeed', true, 'personal', 21);
		theme_TayonaPink_transfer_menu_item('videos_my', 'videos', 'newsfeed', true, 'personal', 22);
		theme_TayonaPink_transfer_menu_item('events_my', 'event', 'newsfeed', true, 'personal', 23);

		theme_TayonaPink_transfer_menu_item('newsfeed', 'links', 'newsfeed', true, 'links', 100);
		theme_TayonaPink_transfer_menu_item('invite_friends', 'links', 'newsfeed', true, 'links', 101);

		return $return;
}

function theme_TayonaPink_remove_group_menu_items() {
		global $Ossn;
		if(isset($Ossn->menu['newsfeed']['groups'])) {
			foreach($Ossn->menu['newsfeed']['groups'] as $key => $item) {
				if($item['name'] != 'addgroup' && $item['name'] != 'allgroups') {
					unset($Ossn->menu['newsfeed']['groups'][$key]);
				}
			}
		}
}

function theme_TayonaPink_transfer_menu_item($name, $menu, $menutype = 'newsfeed', $entry_transfer = false, $destination, $priority) {
		global $Ossn;
		if(isset($Ossn->menu[$menutype][$menu])) {
			foreach($Ossn->menu[$menutype][$menu] as $key => $item) {
				if($item['name'] == $name) {
					if($entry_transfer) {
						$entry = $Ossn->menu[$menutype][$menu][$key];
						if($entry) {
							ossn_register_sections_menu('newsfeed', array(
							'name' => $entry['name'],
							'text' => $entry['text'],
							'url' => $entry['href'],
							'parent' => $destination,
							'priority' => $priority,
							));
						}
					}
					unset($Ossn->menu[$menutype][$menu][$key]);
				}
			}
		}
}

function theme_TayonaPink_pagehandler($home, $handler) {
		switch($handler) {
				case 'mygroups':
						$title = ossn_print('theme:tayonapink:section:menu:mygroups');
						if(com_is_active('OssnGroups')) {
								$contents['content'] = ossn_plugin_view('pages/contents/user/mygroups');
						}
						$content = ossn_set_page_layout('newsfeed', $contents);
						echo ossn_view_page($title, $content);
						break;
				
				case 'friendsonline':
						$title = ossn_print('theme:tayonapink:section:menu:friendsonline');
						if(com_is_active('OssnChat')) {
								$contents['content'] = ossn_plugin_view('pages/contents/user/friendsonline');
						}
						$content = ossn_set_page_layout('newsfeed', $contents);
						echo ossn_view_page($title, $content);
						break;
				
				default:
						ossn_error_page();
						break;
						
		}
}

function theme_TayonaPink_site_head(){
	$head	 = array();
	// <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	$head[]  = ossn_html_css(array(
				'href' => '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
				// 'href' => '//use.fontawesome.com/releases/v5.7.2/css/all.css'
			  ));	
	$head[]  = ossn_html_css(array(
					'href' =>  'https://fonts.googleapis.com/css?family=PT+Sans:400italic,700,400'
			  ));		
	$head[]  = ossn_html_js(array(
					'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js'
			  ));
	$head[]  = ossn_html_css(array(
					'href' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery-ui.css'
			  ));	
	return implode('', $head);
}

function theme_TayonaPink_admin_head(){
	$head	 = array();	
	$head[]  = ossn_html_css(array(
					'href' => '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
			  ));	
	$head[]  = ossn_html_css(array(
					'href' =>  '//fonts.googleapis.com/css?family=Roboto+Slab:300,700,400'
			  ));		
	$head[]  = ossn_html_js(array(
					'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js'
			  ));
	$head[]  = ossn_html_css(array(
					'href' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
			  ));
	$head[]  = ossn_html_js(array(
					'src' => ossn_theme_url() . 'vendors/jquery-colorpicker/jquery.colorpicker.js'
			  ));
	$head[]  = ossn_html_css(array(
					'href' => ossn_theme_url() . 'vendors/jquery-colorpicker/jquery.colorpicker.css'
			  ));
	return implode('', $head);
}
