<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 28502 2012-03-01 11:33:29Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$dos = array('index', 'doing', 'blog', 'album', 'friend', 'wall',
	'notice', 'share', 'home', 'pm', 'videophoto', 'favorite',
	'thread', 'trade', 'poll', 'activity', 'debate', 'reward', 'profile', 'plugin', 'follow');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';

if(!in_array($do, array('home', 'doing', 'blog', 'album', 'share', 'wall'))) {
	$_G['mnid'] = 'mn_common';
}

$uid = empty($_GET['uid']) ? 0 : intval($_GET['uid']);

$member = array();
if($_GET['username']) {
	$member = C::t('common_member')->fetch_by_username($_GET['username']);
	if(empty($member) && !($member = C::t('common_member_archive')->fetch_by_username($_GET['username']))) {
		showmessage('space_does_not_exist');
	}
	$uid = $member['uid'];
}

if($_GET['view'] == 'admin') {
	$_GET['do'] = $do;
}
if(empty($uid) || in_array($do, array('notice', 'pm'))) $uid = $_G['uid'];
if(empty($_GET['do']) && !isset($_GET['diy'])) {
	if($_G['adminid'] == 1) {
		if($_G['setting']['allowquickviewprofile']) {
			if(!$_G['inajax']) dheader("Location:home.php?mod=space&uid=$uid&do=profile");
		}
	}
	if(helper_access::check_module('follow')) {
		$do = $_GET['do'] = 'follow';
	} else {
		$do = $_GET['do'] = !$_G['setting']['homepagestyle'] ? 'profile' : 'index';
	}
}

if($_GET['do'] == 'follow') {
	if($uid != $_G['uid']) {
		$_GET['do'] = 'view';
		$_GET['uid'] = $uid;
	}
	require_once libfile('home/follow', 'module');
	exit;
} elseif(empty($_GET['do']) && !$_G['inajax'] && !helper_access::check_module('follow')) {
	$do = 'profile';
}

if($uid && empty($member)) {
	$space = getuserbyuid($uid, 1);
	if(empty($space)) {
		showmessage('space_does_not_exist');
	}
} else {
	$space = &$member;
}

if(empty($space)) {
	if(in_array($do, array('doing', 'blog', 'album', 'share', 'home', 'thread', 'trade', 'poll', 'activity', 'debate', 'reward', 'group'))) {
		$_GET['view'] = 'all';
		$space['uid'] = 0;
	} else {
		showmessage('login_before_enter_home', null, array(), array('showmsg' => true, 'login' => 1));
	}
} else {

	$navtitle = $space['username'];

	if($space['status'] == -1 && $_G['adminid'] != 1) {
		showmessage('space_has_been_locked');
	}

	if(in_array($space['groupid'], array(4, 5, 6)) && ($_G['adminid'] != 1 && $space['uid'] != $_G['uid'])) {
		$_GET['do'] = $do = 'profile';
	}

	if($do != 'profile' && $do != 'index' && !ckprivacy($do, 'view')) {
		$_G['privacy'] = 1;
		require_once libfile('space/profile', 'include');
		include template('home/space_privacy');
		exit();
	}

	if(!$space['self'] && $_GET['view'] != 'eccredit' && $_GET['view'] != 'admin') $_GET['view'] = 'me';

	get_my_userapp();

	get_my_app();
}

$diymode = 0;

$seccodecheck = $_G['setting']['seccodestatus'] & 4;
$secqaacheck = $_G['setting']['secqaa']['status'] & 2;
if($do != 'index') {
	$_G['disabledwidthauto'] = 0;
}
//add by zh
space_merge($space, 'profile');
$spacecp = getuserbyuid($uid);
space_merge($spacecp, 'profile');
space_merge($spacecp, 'count');
//$data=C::t('common_usergroup')->findgroupid_by('��֤��Ա','','',0,0,'icon');
if($_G['member']['groupid']==22||strpos($_G['member']['extgroupids'],'22')!==false){
	$spacecp['vertifyico']='static/image/common/kaiser_ext.png';
}

$followerlist = C::t('home_follow')->fetch_all_following_by_uid($_G['uid']);
foreach($followerlist as $k=>$val){
	if($val['followuid']==$uid){
		$gzflag=true;
		break;
	}
}
//˽��
$filter = in_array($_GET['filter'], array('newpm', 'privatepm', 'announcepm')) ? $_GET['filter'] : 'privatepm';
$newpm = $newpmcount = 0;

if($filter == 'privatepm' || $filter == 'announcepm' || $filter == 'newpm') {
	$announcepm  = 0;
	foreach(C::t('common_member_grouppm')->fetch_all_by_uid($_G['uid'], $filter == 'announcepm' ? 1 : 0) as $gpmid => $gpuser) {
		$gpmstatus[$gpmid] = $gpuser['status'];
		if($gpuser['status'] == 0) {
			$announcepm ++;
		}
	}
	$gpmids = array_keys($gpmstatus);
	if($gpmids) {
		foreach(C::t('common_grouppm')->fetch_all_by_id_authorid($gpmids) as $grouppm) {
			$grouppm['message'] = cutstr(strip_tags($grouppm['message']), 100, '');
			$grouppms[] = $grouppm;
		}
	}
}
loaducenter();

if($filter == 'privatepm' || $filter == 'newpm') {
	$newpmarr = uc_pm_checknew($uid, 1);
	$newpm = $newpmarr['newpm'];
}
$newpmcount = $newpm + $announcepm;
//end add
require_once libfile('space/'.$do, 'include');

?>