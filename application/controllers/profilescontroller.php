<?php

class ProfilesController extends Controller {

	function home($rid=null) {
		global $clean;
		$this->set('title','My Chat');
		
		if ($_SESSION['authenticated']==true && isset($_SESSION['user'])) {
 			$uid = $this->Profile->queryid($_SESSION['user']);		
 			
			if ($uid == "Invalid username")
			{
				$this->set('msg','Invalid username');
			}
			else 
			{
				$this->set('uid',$uid);
			}

		
 		 $username = $this->Profile->queryName($uid);	
		 $this->set('username',$username);
 		 $friends = $this->Profile->queryfriend($uid);
		 $relation1 = array_shift($friends);
		 $relation2 = array_shift($friends);
		 $this->set('friendlist',$friends);
		 $this->set('relation1', $relation1);
		 $this->set('relation2', $relation2);
		
		 $get_prof_pic = $this->Profile->queryProfPic($uid);

		 if(isset($get_prof_pic) && !empty($get_prof_pic))
		 {


		 $get_dir = $this->Profile->queryDir($uid);

		 if(isset($get_dir) && !empty($get_dir))
		 {
		 
			 /*	 if ($files= @scandir($get_dir) && (count($files) > 2))  */
			 {
				 $this->set('profImage', $get_dir.$get_prof_pic);
			 }
		 }
	}

		 if (isset($rid) && !empty($rid)) {
			 $ids = $this->Profile->queryRID($rid);
			 if( ($ids['u_id'] == $uid) or ($ids['f_id'] == $uid))
			 {
			 $msgs = $this->Profile->getMessages($rid);
			 $this->set('msgs', $msgs);
			 $this->set('rid', $rid);
			 }
			 else {
				 $this->set('error', "Invalid url");
			 } 
		}
			
		
		 $i = 0;

		 if(isset($friends) && !empty($friends)) {

		 foreach($friends as $friend) {
			 $frndsugg[$i++] = $this->Profile->queryfriend($friend['user_id']);
			 $j = $i - 1;
			 array_shift($frndsugg[$j]);
			 array_shift($frndsugg[$j]);
		 }
			 for(reset($frndsugg); key($frndsugg)!==null; next($frndsugg)){
				 $frndsug = current($frndsugg);
				 $keyup = key($frndsugg);

				 for(reset($frndsug); key($frndsug)!==null; next($frndsug)){
					 foreach($friends as $existFriend) {
						$frnd = current($frndsug);
					 if(($frnd['user_id'] == $existFriend['user_id']) || ($frnd['user_id'] == $uid)){
						 $id = key($frndsug);
						 unset($frndsugg[$keyup][$id]);
					 }

				 }
				 }
			 }
		 
		 $this->set('frndsSugg', $frndsugg);
		}
		 $sentRequest = $this->Profile->queryRequest($uid);
		 $this->set('requests', $sentRequest);
		 if(!isset($rid) or empty($rid) or ($rid==null)) {
			 $this->set('home', "ishome");
		 }

		 

		if(isset($sentRequest) && !empty($sentRequest)){
		$sentReqDetails = $this->Profile->queryRequestDetails($sentRequest); 
		 $this->set('sentReq', $sentReqDetails);
		}

		 $recdRequest = $this->Profile->queryRecvRequest($uid);
		 $this->set('recvRequests', $recdRequest);

		 if(isset($recdRequest) && !empty($recdRequest)) {
			 $recdRequestDetails = $this->Profile->queryRecdRequestDetails($recdRequest);
		 	 $this->set('recdRequestDetails', $recdRequestDetails);
		 }

	
   }

}


		function imageupload() {
		 if(preg_match('/^image\/p?jpeg$/i', $_FILES['pic']['type']) or preg_match('/^image\/gif$/i', $_FILES['pic']['type']) or preg_match('/^image\/(x-)?png$/i', $_FILES['pic']['type']))
				{
					global $clean;
					$get_dir = $this->Profile->queryDir($clean['uid']);

					$tmpname = $_FILES['pic']['tmp_name'];
					$name=$_FILES['pic']['name'];
					$picname= "/home/r3b3l/vhosts/project0/public".$get_dir.$name;
					move_uploaded_file($tmpname, $picname);
					chmod($picname, 0755);
					$profImage= $get_dir.$tmpname;

					$this->Profile->updateProfilePic($name, $clean['uid']);

				}		
	
}

		function submit() {

			global $clean;

			$this->Profile->submitMessage($clean['msg'],$clean['r_id'], $clean['u_id']);
			$this->set('rid', $clean['r_id']);
		}


		
		function search() {
			global $clean;


			$this->set('title','My Chat');
				
			if ($_SESSION['authenticated']==true && isset($_SESSION['user'])) {
				$uid = $this->Profile->queryid($_SESSION['user']);		
						 			
				if ($uid == "Invalid username")
				{
					$this->set('msg','Invalid username');
				}
				else 
				{
					$this->set('uid',$uid);
				}

								
				$username = $this->Profile->queryName($uid);	
				$this->set('username',$username);
				$friends = $this->Profile->queryfriend($uid);
				$relation1 = array_shift($friends);
				$relation2 = array_shift($friends);
				$this->set('friendlist',$friends);
				$this->set('relation1', $relation1);
				$this->set('relation2', $relation2);

				$get_prof_pic = $this->Profile->queryProfPic($uid);

				if(isset($get_prof_pic) && !empty($get_prof_pic))
				{


					$get_dir = $this->Profile->queryDir($uid);

					if(isset($get_dir) && !empty($get_dir))
					{
																					 
																						       /*  if ($files= @scandir($get_dir) && (count($files) > 2))  */
																						 		{
																								 $this->set('profImage', $get_dir.$get_prof_pic);
																								}
					}
			}

				
											   
								
											   	 
			       $s_ids = $this->Profile->searchFriend($clean['search'], $uid);
			       $existFriends = array();
			       $existFriends = array_pop($s_ids);
			       $suggestions = array_pop($s_ids);
			       $this->set('suggestions', $suggestions);
			       $this->set('existFriends', $existFriends);
			       $this->set('searchprofiles', $s_ids);
		     }
			


		}




		function unfriend($fid=null) {
				$user = $_SESSION['user'];
				$uid = $this->Profile->queryid($user);
				$this->Profile->unFriend($fid, $uid);
}

		function addfriend($fid=null) {
				$user = $_SESSION['user'];
				$uid = $this->Profile->queryid($user);
				$this->Profile->sendRequest($uid, $fid);
		}

		function acceptfriend($fid = null) {
				$user = $_SESSION['user'];
				$uid = $this-> Profile->queryid($user);
				$this->Profile->acceptRequest($uid, $fid);
}

}
