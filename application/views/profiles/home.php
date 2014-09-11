<div id="topbar">
		<img src="/img/logosmall.jpg" id="logo" width="115px" height="44px" alt="MyChat"/>

	<h4 id="sitename"> My Chat </h4>

	<form method="get" action="/profiles/search/" class="searchbox">
	  <input type="text" placeholder="search friends" name="search" id="searchtext"/>
	  <input type="submit" value="" id="searchbutton" />
	</form>

<a href="/profiles/home"><img src="/img/home.png" width = "40px" height = "34px" id = "home"/></a>
	<a href="/auths/logout"><input type="submit" name="logout" id="logout" value="Logout"/> </a>
       
</div>



	<figure>
	   <?php
		if (isset($profImage) && !empty($profImage)) {
			$imagesrc= $profImage;
		}
		else {
			$imagesrc= "/img/no_profile.jpg";
		}
	?>
		<a href="#openModal"><img src="<?php echo $imagesrc; ?>" alt="no profile picture"/></a>
		
		

		<figcaption> <?php echo "$username"; ?> </figcaption>
	</figure>




<div id="leftbar">
	<h4><u> Suggested Friends</u> </h4>
	
<?php
		$suggestion = array();

		if(isset($frndsSugg)) {
	foreach($frndsSugg as $frndSugg) {
	if (!empty($frndSugg)) {
	foreach($frndSugg as $frndsugg) {	
		$suggestions[] = $frndsugg;
		$suggestion2[] = $frndsugg;
	}
	}
	}
		}

		if(isset($suggestions) && !empty($suggestions)) {
		for(reset($suggestions); key($suggestions)!==null; next($suggestions))
		{
			$id = key($suggestions);
			for(reset($suggestion2); key($suggestion2) < $id; next($suggestion2)) {
				if(current($suggestion2) == $suggestions[$id]) {
					$ids[] = $id;	
					
				}

			}
		}
		if(isset($ids)) {
		foreach($ids as $id) {
			unset($suggestions[$id]);
		}
		}

		
		if(isset($requests) && !empty($requests)) {
		for(reset($suggestions); key($suggestions)!==null; next($suggestions))
		{
			$id= key($suggestions);
			$suggestion = current($suggestions);
			foreach($requests as $request) {
				if(($suggestion['user_id'] == $request['f_id']) || ($suggestion['user_id'] == $uid)){
					$removeids[] = $id;
				}
			}
		}
		foreach($removeids as $removeid){
			unset($suggestions[$removeid]);
		}
		}




		if(isset($recvRequests) && !empty($recvRequests)) {
		for(reset($suggestions); key($suggestions)!==null; next($suggestions))
		{
			$id= key($suggestions);
			$suggestion = current($suggestions);
			foreach($recvRequests as $recvRequest) {
				if(($suggestion['user_id'] == $recvRequest['u_id'])){
					$removeids[] = $id;
				}
			}
		}
		if(isset($removeids) && !empty($removeids)) {
		foreach($removeids as $removeid){
			unset($suggestions[$removeid]);
		}
		}
	}




	foreach($suggestions as $suggestion) {	
	if(isset($suggestion) && !empty($suggestion)) {
	echo "<hr>";
	if(isset($suggestion['profilePic']) && !empty($suggestion['profilePic'])){
		echo "<img src=".$suggestion['dir_path'].$suggestion['profilePic']."  alt='no_pic' height='34px' width='40px' id='suggfrndPic'>";
	}
	else {
		$url = "/img/No_Image.jpg";
		echo "<img src=$url alt='no_pic' height='34px' width='40px' id='suggfrndPic'>";
	}
	echo "<h4>".$suggestion['username']."</h4>";
	$url="/profiles/addfriend/".$suggestion['user_id'];
	echo "<a href=$url>";
	echo "<input type='submit' id='add' value='Add'>";
	echo "</a>";
	


	

	

	
	}
		} 
		echo "<hr>";
		}
	?>
</div>





<div id ="rightbar">
<?php
if (isset($friendlist) && !empty($friendlist)) {
	foreach($friendlist as $friend){
		if (isset($friend['status']) && !empty($friend['status'])) {
			if($friend['status'] === "online") {
			echo '<div class="friendseperator" id="friends">';
		}
			else
			   echo '<div class="friendseperators" id="friends">';

		}
		else {
			echo '<div class="friendseperators" id="friends">';
		}
		
        foreach($relation1 as $relationid) {
		if($friend['user_id'] == $relationid['f_id']){	
			echo "<a href=/profiles/home/".$relationid['r_id'].">";
			if(isset($friend['profilePic']) && !empty($friend['profilePic']))
				echo '<img src='.$friend['dir_path'].$friend['profilePic'].'  alt="no_pic" id="friendpic" height = "34px" width = "40px">';
			else{
				$picurl = "/img/No_Image.jpg";
				echo "<img src=$picurl alt='no_pic' id='friendpic' height='34px' width='40px'>";
			}
			echo "<p>  ".$friend['username']."</p> ";
			echo "</a>";
			break;
		}
	}
	
	
	foreach($relation2 as $relationid) {
		if($friend['user_id'] == $relationid['u_id']){	
			echo "<a href=/profiles/home/".$relationid['r_id'].">";
			if(isset($friend['profilePic']) && !empty($friend['profilePic']))
				echo '<img src='.$friend['dir_path'].$friend['profilePic'].'  alt="no_pic" id="friendpic" height = "34px" width = "40px">';
			else{
				$picurl = "/img/No_Image.jpg";
				echo "<img src=$picurl alt='no_pic' id='friendpic' height='34px' width='40px'>";
			}
			echo "<p>  ".$friend['username']."</p> ";
			echo "</a>";
			break;
		}
	}
			echo "</div>";
	
}
}

else {
	echo "<h4> No Friends </h4>";
}
?>
</div>





<div id="center">

<?php
	if(isset($home) && $home === "ishome") {
		echo "<h4><u>Friend Requests</u></h4>";
		if(isset($recdRequestDetails) && !empty($recdRequestDetails)) {
		foreach($recdRequestDetails as $recdRequestDetail) {
			if(isset($recdRequestDetail['profilePic']) && !empty($recdRequestDetail['profilePic'])){
				$url = $recdRequestDetail['dir_path'].$recdRequestDetail['profilePic'];
			}
			else {
				$url = "/img/No_Image.jpg";
			}
			echo "<hr>";
			echo "<div id='searchprofile'>";

			echo "<img src=".$url."  alt='no_pic' id='reqPic' height='40px' width='50'>";
			echo "<h4>".$recdRequestDetail['username']."</h4>";
			$url1 = "/profiles/acceptfriend/".$recdRequestDetail['user_id'];
			echo "<a href=$url1>";
			echo "<input type='submit' name='accept' id='acceptbtn' value='Accept Request'>";
			echo "</a>";
			echo "</div>";
		}
		echo "<hr>";
		
		

		}
	}
	
	else{

	if(isset($msgs))
	{
	foreach($msgs as $msgdetails)
	{
		if($msgdetails['u_id'] == $uid)
		{
			echo "<div id='mymessage'>";
			echo "<u> me: </u>";
			echo "<div id = 'msgbg'>";
			echo "<p><div class='msg1'>".$msgdetails['msg']."</div></p>";
			echo "</div>";
			echo "<p><span class='timestamp'>".$msgdetails['timestmp']."</span></p>";
			echo "</div>";
		}
		else {
			echo "<div id='frndmessage'>";
			echo "<p><div class='msg2'>".$msgdetails['msg']."</div></p>";
			echo "<p><span class='timestamp1'>".$msgdetails['timestmp']."</span></p>";
			echo "</div>";
		}
	echo "<br>";
	}
}

else {
	echo "<h4><u>No Messages</u></h4>";
}
	}

?>
</div>





<div id="msgbox">
	<form action="/profiles/submit" method="post" class="msgsend">
	<textarea name="msg" id="msg" ROWS=6 COLS=30 autofocus></textarea>
	<input type="hidden" name="r_id" value="<?php if(isset($rid)) echo $rid; ?>">
	<input type="hidden" name="u_id" value="<?php echo $uid; ?>">
	<input type="submit" id="sendmsg" name="submit" value="Send"/>
	</form>

</div>




<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2> Image Upload </h2>
		<img src="<?php echo $imagesrc; ?>" alt="no profile pic" id="modalprofile"/>
		<form action="/profiles/imageupload" method="post" enctype="multipart/form-data">
		<input type="file" name="pic" accept="image/*"/>
		<input type="hidden" name="uid" value="<?php echo $uid?>">
		<input type="submit" name="upload" value="Upload">

	</div>
</div>

