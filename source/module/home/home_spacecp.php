<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_spacecp.php 28214 2012-02-24 06:38:56Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/spacecp');
require_once libfile('function/magic');

$acs = array('space', 'doing', 'upload', 'comment', 'blog', 'album', 'relatekw', 'common', 'class',
	'swfupload', 'poke', 'friend', 'eccredit', 'favorite', 'follow',
	'avatar', 'profile', 'theme', 'feed', 'privacy', 'pm', 'share', 'invite','sendmail',
	'credit', 'usergroup', 'domain', 'click','magic', 'top', 'videophoto', 'index', 'plugin', 'plugin_all', 'search', 'promotion');

$_GET['ac'] = $ac = (empty($_GET['ac']) || !in_array($_GET['ac'], $acs))?'profile':$_GET['ac'];
$op = empty($_GET['op'])?'':$_GET['op'];
$_G['mnid'] = 'mn_common';


if(empty($_G['uid'])) {
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		dsetcookie('_refer', rawurlencode($_SERVER['REQUEST_URI']));
	} else {
		dsetcookie('_refer', rawurlencode('home.php?mod=spacecp&ac='.$ac));
	}
	showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
}

$space = getuserbyuid($_G['uid']);
if(empty($space)) {
	showmessage('space_does_not_exist');
}
space_merge($space, 'field_home');

if(($space['status'] == -1 || in_array($space['groupid'], array(4, 5, 6))) && $ac != 'usergroup') {
	showmessage('space_has_been_locked');
}

$actives = array($ac => ' class="a"');

$seccodecheck = $_G['group']['seccode'] ? $_G['setting']['seccodestatus'] & 4 : 0;
$secqaacheck = $_G['group']['seccode'] ? $_G['setting']['secqaa']['status'] & 2 : 0;

$navtitle = lang('core', 'title_setup');
if(lang('core', 'title_memcp_'.$ac)) {
	$navtitle = lang('core', 'title_memcp_'.$ac);
}

$_G['disabledwidthauto'] = 0;

//add by kaiser
$kaiser_user = C::t('common_member')->fetch_all_by_username($_G['username']);
foreach($kaiser_user as $val){
	$renzheng = $val['extgroupids'];
}
//end add
//add by zh
$spacecp = getuserbyuid($_G['uid']);
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
	$newpmarr = uc_pm_checknew($_G['uid'], 1);
	$newpm = $newpmarr['newpm'];
}
$newpmcount = $newpm + $announcepm;
//end add
require_once libfile('spacecp/'.$ac, 'include');

?>