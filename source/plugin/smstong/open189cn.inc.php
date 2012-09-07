<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: checkenv.inc.php 18582 2012-04-15 13:24:06Z Ñ½Ñ½¸öÅÞ $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

loadcache('plugin');

$Plang = $scriptlang['smstong'];

if (!$_G['cache']['plugin']['smstong']) {
	cpmsg($Plang['smstong_plugin_closed'], "action=plugins", 'error');
}

echo '<iframe id="frame_content" src="source/plugin/smstong/open189cn.php" scrolling="no" frameborder="0" onload="this.height=668" style="position:absolute; left:0px; top:50px; width:100%; border:0px;"></iframe>';

?>
