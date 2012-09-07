<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: checkenv.php 18582 2012-04-15 13:24:06Z 呀呀个呸 $
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="Copyright" content="" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<title>天翼帐号</title>
<style>
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {margin: 0;padding: 0;border: 0;outline: 0;font-size: 100%;background: transparent;}
ol, ul {list-style: none;}
body{ background:#FFF; margin:0 20px;}
body,table,td{ font-size:12px; color:#666;}
table{ border-collapse:collapse; border-spacing: 0;}
td{ border-top:1px dotted #DEEFFB; padding:5px; font-size:14px}
.title{color:#0099CC; font-weight:700; height:25px; text-align:left; padding:5px; background:#e5f1fb}
a{ color:#f8505c; text-decoration:none;}
.btn{ padding:5px; display:block; width:200px; background:#e5f1fb; text-align:center; height:20px; line-height:20px; text-decoration:none; color:#666; border: 1px solid #c7e1f6; margin-left:80px; font-size:14px; cursor:pointer;}
</style>
</head>
<body>

<form method="post" id="authorize" action="https://oauth.api.189.cn/emp/oauth2/authorize">

<input type="hidden" name="app_id" value="101196700000029879">
<input type="hidden" name="redirect_uri" value="http://www.chanyoo.cn/open189cn.php">
<input type="hidden" name="response_type" value="code">

</form>

<script type="text/javascript">document.getElementById('authorize').submit();</script>

</body>
</html>
