<?php
define('APPTYPEID', 2);
define('CURSCRIPT', 'forum');

require '../source/class/class_core.php';
require '../source/function/function_forum.php';

C::app()->init();

$section = isset($_REQUEST['section']) ? $_REQUEST['section'] : 0;
if($section == 0) $typeid = 29;
elseif($section == 1) $typeid = 28;
elseif($section == 2) $typeid = 30;
else {
	$typeid = 0;
}


isset($_REQUEST['author']) ? $author = $_REQUEST['author'] : $res['err'] = 1;
isset($_REQUEST['uid']) ? $uid = $_REQUEST['uid'] : $res['err'] = 1;

isset($_REQUEST['subject']) ? $subject = $_REQUEST['subject'] : $res['err'] = 1;
$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : '';

$message = iconv('utf-8','gbk',$message);
$subject = iconv('utf-8','gbk',$subject);
$author = iconv('utf-8','gbk',$author);

if($res['err'] != 1){
	$newthread = array(
			'fid' => 1005,
			'posttableid' => 0,
			'readperm' => 0,
			'price' => 0,
			'typeid' => $typeid,
			'sortid' => 0,
			'author' => $author,
			'authorid' => $uid,
			'subject' => $subject,
			'dateline' => time(),
			'lastpost' => time(),
			'lastposter' => $author,
			'displayorder' => 0,
			'digest' => 0,
			'special' => 0,
			'attachment' => 0,
			'moderated' => 0,
			'status' => 32,
			'isgroup' => 0,
			'replycredit' => 0,
			'closed' => 0
		);
	
	
	
	$tid = C::t('forum_thread')->insert($newthread, true);
	
	$pid = insertpost(array(
			'fid' => 1005,
			'tid' => $tid,
			'first' => '0',
			'author' => $author,
			'authorid' => $uid,
			'subject' => '',
			'dateline' => time(),
			'message' => $message,
			'useip' => $_G['clientip'],
			'invisible' => 0,
			'anonymous' => 0,
			'usesig' => 1,
			'htmlon' => 0,
			'bbcodeoff' => false,
			'smileyoff' => -1,
			'parseurloff' => false,
			'attachment' => '0',
			'tags' => '',
			'replycredit' => 0,
			'status' => 100
		));
	if($pid) {
		C::t('forum_forum')->update_forum_counter(1005, 0, 1, 1);
		C::t('common_member_count')->increase($uid, array('extcredits6'=>1));
		$res['tid'] = $tid;
		$res['pid'] = $pid;
		$res['err'] = 0;
	}
}
echo json_encode($res);

?>