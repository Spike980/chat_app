<div id="topbar">
		<img src="/img/logosmall.jpg" id="logo" width="115px" height="44px" alt="MyChat"/>

	<h4 id="sitename"> My Chat </h4>

	<form method="get" action="/profiles/search/" class="searchbox">
	  <input type="text" placeholder="search friends" name="search" id="searchtext"/>
	  <input type="submit" value="" id="searchbutton" />
	</form>
	<a href="/profiles/home"><img src="/img/home.png" width = "40px" height = "34px" id = "home"/></a>
	<a href="/auths/logout" id="logout1"><input type="submit" name="logout" id="logout" value="Logout"/></a>
       
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
	<h4> profile information </h4>
</div>




<div id ="rightbar">
<?php
	if (isset($friendlist) && !empty($friendlist)) {
	foreach($friendlist as $friend){
	echo '<div class="friendseperator" id="friends">';
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


<div id="center1">


<?php foreach ($existFriends as $existFriend) {
	echo '<hr>';
	echo '<div id="searchprofile">';
	if(isset($existFriend['profilePic']) && !empty($existFriend['profilePic'])){
		echo '<img src='.$existFriend['dir_path'].$existFriend['profilePic'].'  alt="no_pic" id="searchfrndimg" height="34px" width="40px">';
	}
	else {
		echo '<img src="/img/No_Image.jpg" alt="no_pic" id="searchfrndimg" height="34px" width="40px">';
	}
	echo "<h4>".$existFriend['username']."</h4>";
	$url = "/profiles/unfriend/".$existFriend['user_id'];
	echo "<a href=$url>";
	echo "<input type='button' name='Unfriend' value='Unfriend' id='addFriend' />";
	echo "</a>";
	echo '</div>';  
}

?>
<?php foreach ($searchprofiles as $profile) {
	echo '<hr>';
	echo '<div id="searchprofile">';
	if(isset($profile['profilePic']) && !empty($profile['profilePic'])){
		echo '<img src='.$profile['dir_path'].$profile['profilePic'].'  alt="no_pic" id="searchfrndimg" height="34px" width="40px">';
	}
	else {
		echo '<img src="/img/No_Image.jpg" alt="no_pic" id="searchfrndimg" height="34px" width="40px">';
	}
	echo "<h4>".$profile['username']."</h4>";
	$url = "/profiles/addfriend/".$profile['user_id'];
	echo "<a href=$url>";
	echo "<input type='button' name='addFriend' value='Add Friend' id='addFriend'/>";
	echo "</a>";
	echo '</div>';
}
?>


<?php

if(isset($suggestions) && !empty($suggestion)) {
foreach ($suggestions as $suggestion) {
	echo '<hr>';
	echo '<div id="searchprofile">';
	if(isset($suggestion['profilePic']) && !empty($suggestion['profilePic'])){
		echo '<img src='.$suggestion['dir_path'].$suggestion['profilePic'].'  alt="no_pic" id="searchfrndimg" height="34px" width="40px">';
	}
	else {
		echo '<img src="/img/No_Image.jpg" alt="no_pic" id="searchfrndimg" height="34px" width="40px">';
	}
	echo "<h4>".$suggestion['username']."</h4>";
	$url = "/profiles/acceptfriend/".$suggestion['user_id'];
	echo "<a href=$url>";
	echo "<input type='button' name='addFriend' value='Accept Friend' id='addFriend'/>";
	echo "</a>";
	echo '</div>';
}
echo "<hr>";
}
?>
</div>
