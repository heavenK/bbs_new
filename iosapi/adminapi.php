<?php
define('APPTYPEID', 2);
define('CURSCRIPT', 'forum');

require '../source/class/class_core.php';
require '../source/function/function_forum.php';

C::app()->init();

if($_G['uid'] != 1 && $_G['uid'] != 34) {
	echo '����Ȩ���룡';
	exit;
}

if($_POST['type'] == 'dosubmit'){
	for($i=0 ;$i<4 ;$i++){
		$pic = 'pic'.$i;
		$ad = 'ad'.$i;
		if(isset($_FILES[$pic])){
			move_uploaded_file($_FILES[$pic]["tmp_name"], "welcome".$i.".jpg");
		}
		if(isset($_FILES[$ad])){
			move_uploaded_file($_FILES[$ad]["tmp_name"], "ad0".$i.".jpg");
		}	
		
		$ads[$i]['imgURL'] = "http://bbs.we54.com/iosapi/ad0".$i.".jpg";
		$ads[$i]['type'] = $_POST['types'.$i];
		$ads[$i]['content'] = $_POST['content'.$i];
		
	}
	
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	
	$r = $doc->createElement( "ADV" );
	$doc->appendChild( $r );
	
	foreach( $ads as $val )
	{
		$b = $doc->createElement( "ad" );
		
		$imgURL = $doc->createElement( "imgURL" );
		$imgURL->appendChild($doc->createTextNode($val['imgURL']));
	   $b->appendChild( $imgURL );
	
	  $type = $doc->createElement( "type" );
	  $type->appendChild( $doc->createTextNode( $val['type'] ));
	  $b->appendChild( $type );
	
	  $content = $doc->createElement( "content" );
	  $content->appendChild($doc->createTextNode( $val['content'] ));
	  $b->appendChild( $content );
	
	  $r->appendChild( $b );
	}
	
	$doc->save('ad.xml');
	
	echo "<script language='javascript'>window.location.reload();</script>";
}else{
	$xmlDoc = new DOMDocument(); 
	$xmlDoc->load('ad.xml'); 
	
	$ads = $xmlDoc->getElementsByTagName("ad"); 
	
	$i=0;
	foreach($ads as $ad){
		$imgURL = $ad->getElementsByTagName("imgURL"); 
		$type = $ad->getElementsByTagName("type");
		$content = $ad->getElementsByTagName("content");
		
		$pic[$i]['imgURL'] = $imgURL->item(0)->nodeValue; 
		$pic[$i]['type'] = $type->item(0)->nodeValue; 
		$pic[$i]['content'] = $content->item(0)->nodeValue; 
	
		$i++;
	}
		
}

?>
<style>
body	{ margin:0 auto; width:1000px;}

.part1	{ float:left; width:1000px;}
.part1 div:nth-child(2n+1)	{ float:left; width:500px;}
.part1 div:nth-child(2n+2)	{ float:right; width:500px;}

.part2	{ float:left; width:1000px;}
.part2 div:nth-child(2n+1)	{ float:left; width:500px;}
.part2 div:nth-child(2n+2)	{ float:right; width:500px;}

</style>
<body>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="type" value="dosubmit" />
<h1>�޸ĵ�¼���ͼƬ</h1>
<div class="part1">
    <div>
        <img src="welcome0.jpg" width="150" />
        ͼƬ1:<input type="file" name="pic0"  />
    </div>
    <div>
        <img src="welcome1.jpg" width="150" />
        ͼƬ2:<input type="file" name="pic1"  />
    </div>
    <div>
        <img src="welcome2.jpg" width="150" />
        ͼƬ3:<input type="file" name="pic2"  />
    </div>
    <div>
        <img src="welcome3.jpg" width="150" />
        ͼƬ4:<input type="file" name="pic3"  />
    </div>
</div>
<p></p>
<h1>�޸Ĺ��</h1>
<div class="part2">
	<?php foreach($pic as $key => $val){ ?>
    <div>
        <img src="ad0<?php echo $key;?>.jpg" width="150" />
        ͼƬ<?php echo $key+1;?>:<input type="file" name="ad<?php echo $key;?>"  />
        ����<?php echo $key+1;?>:<select name="types<?php echo $key;?>">
        		<option value="1" <?php if($val['type'] == 1) {?>selected="selected"<?php }?>>����</option>
                <option value="2" <?php if($val['type'] == 2) {?>selected="selected"<?php }?>>��ҳ����</option>
                <option value="3" <?php if($val['type'] == 3) {?>selected="selected"<?php }?>>����</option>
                <option value="4" <?php if($val['type'] == 4) {?>selected="selected"<?php }?>>����</option>
        	  </select>
        ����<?php echo $key+1;?>:<input type="text" name="content<?php echo $key;?>" value="<?php echo $val['content'];?>" />
    </div>
    <?php } ?>
</div>
<input type="submit" value="submit" />
</form>
</body>