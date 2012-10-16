<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>绑定插件 - 新浪微博插件</title>
<link href="<?php echo XWB_plugin::getPluginUrl('images/xwb_admin.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo XWB_plugin::getPluginUrl('images/xwb.js');?>"></script>
<script type="text/javascript" language="javascript">
    function $id(id){
        return document.getElementById(id);
    }
    function setFriend(action){
        action.className = action.className + ' hidden';
        var tmp = $id(action.id + '_ed');
        tmp.className = tmp.className.replace(/ hidden/, '');
        setTimeout("window.location.reload()", 1000);
    }
    function showMsg(type)
    {
        var msgObj;
        if('error' ==  type) msgObj = $id('popMsgErr');
        else if('success' == type) msgObj = $id('popMsgSuc');
        else if('bind' == type) msgObj = $id('popMsgUbind');
        msgObj.className = 'pop-win win-w fixed-pop';
    }
    function ubindTip()
    {
        $id('popMsgUbind').className='pop-win win-w fixed-pop hidden';
        document.getElementById('unbindFrm').submit();
        setTimeout("window.location='<?php echo XWB_plugin::getEntryURL("xwbSiteInterface.bind");?>'", 100);
    }
</script>
<style>
body{ background:#FFF;}
#bound	{ padding-left:6px; padding-top:21px;}
#bound .kaiser_sina_main					{ width:799px; padding:0;}
#bound .kaiser_sina_con-l					{ width:64px; height:64px; margin-right:0; overflow:hidden; float:left;}
#bound .kaiser_sina_con-l .binding			{ width:64px; height:64px; padding:0; background:url(/template/we54/images/kiaser_space_bangding_sina.png) no-repeat; overflow:hidden; float:left;}
#bound .kaiser_sina_con-r					{ width:80%; padding:4px 0 0 19px; font-family:"微软雅黑"; overflow:hidden; float:left;}
#bound .kaiser_sina_con-r h4				{ padding:0 16px 0 0; font-size:12px; font-weight:normal; color:#999; line-height:24px; overflow:hidden; float:left;}
#bound .kaiser_sina_con-r a					{ width:131px; height:24px; background:none; font-size:12px; font-weight:normal; color:#006699; line-height:24px; overflow:hidden; float:left;}
#bound .kaiser_sina_con-r a:hover			{ text-decoration:underline;}
#bound .kaiser_sina_con-r p					{ width:700px; margin-left:0; margin-top:10px; display:inline; font-size:12px; font-weight:normal; color:#999; line-height:16px; overflow:hidden; float:left;}
</style>
</head>
<body>
    <div id="bound" class="set-wrap">
    	<?php if ( $_GET['ac'] == 'plugin_all' ):?>
    	<div class="main kaiser_sina_main">
        	<div class="con-l kaiser_sina_con-l">
                <div class="binding"></div>
            </div> 
            <div class="con-r kaiser_sina_con-r">
				<h4>点击按钮，立刻绑定QQ帐号</h4>
                <a class="binding-btn binding-w" href="home.php?mod=spacecp&ac=plugin&id=sina_xweibo_x2:home_binding" target="_parent">解除已绑定账号？</a>
                <p>绑定以后就可以把帖子、回帖同步发到新浪微博上啦，无需记住本站的帐号和密码，随时使用新浪帐号密码轻松登录</p>
            </div>
        </div>
        <?php endif;?>
        <?php if ( $_GET['ac'] == 'plugin' ):?>
		<h3><!--动态同步新浪微博--><span>把我的动态同步到新浪微博，让更多的朋友了解我，关注我<em>（设置后可选择是否同步）</em></span></h3>
        <div class="main">
        	<div class="con-l">
        	
        		<form id="userProfileBind" action="<?php echo XWB_plugin::getEntryURL('xwbSiteInterface.setUserProfileBind');?>" method="post" target="xwbSiteRegister" >
        		<input type="hidden" name="<?php echo XWB_TOKEN_NAME; ?>" value="<?php echo $sync_tokenhash; ?>" />
            	<div class="set-sle">
                	<div class="choice">
                    	<label for="part1">
                        	<input class="chk" id="part1" name="set[topic2weibo_checked]" type="checkbox" value="1" <?php echo ( !isset($userPorfile['topic2weibo_checked']) || $userPorfile['topic2weibo_checked'] == 1 ) ? 'checked="checked"' : '' ?> />发帖
                    	</label>
                    </div>
                    <div class="choice">
                    	<label for="part2">
                        	<input class="chk" id="part2" name="set[doing2weibo]" type="checkbox" value="1" <?php echo ( isset($userPorfile['doing2weibo']) && $userPorfile['doing2weibo'] == 1 ) ? 'checked="checked"' : '' ?> />记录
                    	</label>
                    </div>
                    <div class="choice">
                    	<label for="part3">
                        	<input class="chk" id="part3" name="set[blog2weibo_checked]" type="checkbox" value="1" <?php echo ( !isset($userPorfile['blog2weibo_checked']) || $userPorfile['blog2weibo_checked'] == 1 ) ? 'checked="checked"' : '' ?> />日志
                    	</label>
                    </div>
                    <div class="choice">
                    	<label for="part4">
                        	<input class="chk" id="part4" name="set[share2weibo]" type="checkbox" value="1" <?php echo ( isset($userPorfile['share2weibo']) && $userPorfile['share2weibo'] == 1 ) ? 'checked="checked"' : '' ?> />添加分享
                    	</label>
                    </div>
                    <div class="choice">
                    	<label for="part5">
                        	<input class="chk" id="part5" name="set[article2weibo_checked]" type="checkbox" value="1" <?php echo ( !isset($userPorfile['article2weibo_checked']) || $userPorfile['article2weibo_checked'] == 1 ) ? 'checked="checked"' : '' ?> />门户文章
                    	</label>
                    </div>
                </div>
                <div class="save-set1">
                	<input class="conmon-btn" name="saveConfig" type="submit" value="保存设置"/>
                </div>
                </form>
                
                <form id="unbindFrm" action="<?php echo XWB_plugin::getEntryURL('xwbSiteInterface.unbind');?>" method="post" target="xwbSiteRegister" >
                <input type="hidden" name="<?php echo XWB_TOKEN_NAME; ?>" value="<?php echo $unbind_tokenhash; ?>" />
                <p>已经绑定新浪微博：<strong><a href="<?php echo XWB_plugin::getWeiboProfileLink($domain); ?>" target="_blank"><?php echo $screenName;?></a></strong>
                    <a href="javascript:void(0)" onclick="showMsg('bind')">解除绑定</a>
                </p>
                </form>
            </div>
            <div class="con-r">
                <?php if ($isBind && ! empty($owbUserRs)):?>
            	<div class="official">
                	<h4><?php echo XWB_S_TITLE ;?> 官方微博</h4>
                    <div class="users">
                    	<a href="<?php echo XWB_plugin::getWeiboProfileLink($owbUserRs['id']);?>" target="_blank"><img alt="官方微博头像" src="<?php echo $owbUserRs['local_image_url']?$owbUserRs['local_image_url']:XWB_plugin::getPluginUrl('images/bgimg/0.gif');?>" /></a>
                        <div class="user-info">
                            <p><?php echo $owbUserRs['screen_name'];?></p>
                            <?php if($owbUserRs['id'] != $domain): ?>
                            <a id="ocFriend" class="addfollow-btn <?php echo TRUE === $friendship?'hidden':'';?>"  target="_blank" href="<?php echo XWB_plugin::getEntryURL('xwbSiteInterface.attention', "att_id={$owbUserRs['id']}&". XWB_TOKEN_NAME. "=". FORMHASH);?>" onclick="setFriend(this)"></a>
                            <a id="ocFriend_ed" class="already-addfollow-btn <?php echo TRUE !== $friendship?'hidden':'';?>" href="javascript:void(0)"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <?php if ( ! empty($huwbUserRs)):?>
                <div class="active">
                	<h4>本站活跃用户的微博</h4>
                    <?php foreach ($huwbUserRs as $value):?>
                    <div class="users">
                        <a href="<?php echo XWB_plugin::getWeiboProfileLink($value['sina_uid']); ?>" target="_blank"><?php echo $value['avatar'];?></a>
                        <div class="user-info">
                            <p><?php echo XWB_plugin::convertEncoding($value['username'], XWB_S_CHARSET, 'UTF-8');?></p>
                            <?php if($value['sina_uid'] != $domain): ?>
                                <?php if($isBind):?>
                                <a id="huFriend" class="addfollow-btn <?php echo TRUE === $value['friends']?'hidden':'';?>" target="_blank" href="<?php echo XWB_plugin::getEntryURL('xwbSiteInterface.attention', "att_id={$value['sina_uid']}&". XWB_TOKEN_NAME. "=". FORMHASH);?>" onclick="setFriend(this)"></a>
                                <?php else:?>
                                <a class="addfollow-btn" href="<?php echo XWB_plugin::getWeiboProfileLink($value['sina_uid']); ?>"></a>
                                <?php endif;?>
                                <a id="huFriend_ed" class="already-addfollow-btn <?php echo TRUE !== $value['friends']?'hidden':'';?>" href="javascript:void(0)"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
            </div>
        </div>
        <?php endif;?>
    </div>
<iframe src="" name="xwbSiteRegister" frameborder="0" height="0" width="0"></iframe>
<!--保存设置成功提示-->
<div class="pop-win win-w fixed-pop hidden" id="popMsgSuc">
	<div class="pop-t">
		<div></div>
	</div>
	<div class="pop-m">
		<div class="pop-inner">
			<h4>提示</h4>
			<div class="add-float-content">
            	<div class="tip-success">
                	<div class="success"></div>
                    <span>插件设置保存成功！</span>
                </div>
                <div class="pop-btn-s"><a class="pop-btn" href="javascript:void(0)" onclick="$id('popMsgSuc').className='pop-win win-w fixed-pop hidden';"><span>知道了</span></a></div>
			</div>
    	</div>
		<div class="pop-inner-bg"></div>
	</div>
	<div class="pop-b">
		<div></div>
	</div>
</div>
<!--保存异常提示-->
<div class="pop-win win-w fixed-pop hidden" id="popMsgErr">
	<div class="pop-t">
		<div></div>
	</div>
	<div class="pop-m">
		<div class="pop-inner">
			<h4>提示</h4>
			<div class="add-float-content">
            	<div class="tip-success">
                	<div class="error"></div>
                    <span id="msg">出错了，异常提示！</span>
                </div>
                <div class="pop-btn-s"><a class="pop-btn" href="javascript:void(0)" onclick="$id('popMsgErr').className='pop-win win-w fixed-pop hidden';"><span>返回</span></a></div>
			</div>
    	</div>
		<div class="pop-inner-bg"></div>
	</div>
	<div class="pop-b">
		<div></div>
	</div>
</div>
<!--解除绑定提示-->
<div class="pop-win win-w fixed-pop hidden" id="popMsgUbind">
	<div class="pop-t">
		<div></div>
	</div>
	<div class="pop-m">
		<div class="pop-inner">
			<h4>提示</h4>
			<div class="add-float-content">
            	<div class="tip-success">
                	<div class="success" style="background-position:-50px 0;"></div>
                    <span>确认解除帐号绑定？</span>
                </div>
                <div class="pop-btn-s">
                    <a class="pop-btn" href="javascript:void(0)" onclick="ubindTip()" style="margin-right:10px;"><span>确定</span></a>
                    <a class="pop-btn" href="javascript:void(0)" onclick="$id('popMsgUbind').className='pop-win win-w fixed-pop hidden';"><span>取消</span></a>
                </div>
			</div>
    	</div>
		<div class="pop-inner-bg"></div>
	</div>
	<div class="pop-b">
		<div></div>
	</div>
</div>
</body>
</html>
