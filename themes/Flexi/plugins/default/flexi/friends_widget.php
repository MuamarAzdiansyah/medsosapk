<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2018 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//https://github.com/opensource-socialnetwork/opensource-socialnetwork/issues/2149#issuecomment-1179688041
$attr = array(
	'limit' => 12,
	'order_by' => 'r1.relation_id DESC'
);
$friends = ossn_loggedin_user()->getFriends('', $attr);

if ($friends) {
	foreach($friends as $user) { ?>
		<a title="<?php echo $user->first_name . ' ' . $user->last_name; ?>"
		class="com-members-memberlist-item"
		href="<?php echo ossn_site_url() . 'u/' . $user->username; ?>">
		<img class="user-img" src="<?php echo $user->iconURL()->small;?>"></a>
		<?php
	}
}