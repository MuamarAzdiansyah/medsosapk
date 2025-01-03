<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('__THEMEDIR__', ossn_route()->themes . 'gopink/');

ossn_register_callback('ossn', 'init', 'ossn_gopink_theme_init');

function ossn_gopink_theme_init() {
		//add bootstrap
		ossn_new_css('bootstrap.min', 'css/bootstrap/bootstrap.min.css');

		ossn_new_css('ossn.default', 'css/core/default');
		ossn_new_css('ossn.admin.default', 'css/core/administrator');

		//load bootstrap
		ossn_load_css('bootstrap.min', 'admin');
		ossn_load_css('bootstrap.min');

		ossn_load_css('ossn.default');
		ossn_load_css('ossn.admin.default', 'admin');

		ossn_extend_view('ossn/admin/head', 'ossn_gopink_admin_head');
		ossn_extend_view('ossn/site/head', 'ossn_gopink_head');
		ossn_extend_view('js/opensource.socialnetwork', 'js/gopink');

		if(ossn_isAdminLoggedin()) {
				ossn_register_menu_item('admin/sidemenu', array(
						'name'   => 'admin:theme:gopink',
						'text'   => ossn_print('admin:theme:gopink'),
						'href'   => ossn_site_url('administrator/settings/gopink'),
						'parent' => 'admin:sidemenu:themes',
				));
				ossn_register_site_settings_page('gopink', 'settings/admin/gopink');
				ossn_register_action('gopink/settings', __THEMEDIR__ . 'actions/settings.php');
		}
}
function ossn_gopink_head() {
		$head = array();

		$head[] = ossn_html_css(array(
				'href' => '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
		));
		$head[] = ossn_html_css(array(
				'href' => 'https://fonts.googleapis.com/css?family=PT+Sans:400italic,700,400',
		));

		$head[] = ossn_html_css(array(
			'href' => 'https://fonts.googleapis.com/css2?family=Kanit&display=swap',
	    ));


		$head[] = ossn_html_js(array(
				'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js?v5.2',
		));
		$head[] = ossn_html_css(array(
				'href' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery-ui.css',
		));
		return implode('', $head);
}
function ossn_gopink_admin_head() {
		$head   = array();
		$head[] = ossn_html_css(array(
				'href' => '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
		));
		$head[] = ossn_html_css(array(
				'href' => '//fonts.googleapis.com/css?family=Roboto+Slab:300,700,400',
		)); 

		$head[] = ossn_html_css(array(
			'href' => 'https://fonts.googleapis.com/css2?family=Kanit&display=swap',
	    ));

		$head[] = ossn_html_js(array(
				'src' => ossn_theme_url() . 'vendors/bootstrap/js/bootstrap.min.js?v5.2',
		));
		$head[] = ossn_html_css(array(
				'href' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery-ui.css',
		));
		return implode('', $head);
}