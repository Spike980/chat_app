<?php
class Auth extends Model {

	public function query($user,$pass) {
	$stmt = $this->_dbh->prepare("SELECT * FROM auths WHERE username=:username AND  password=:password LIMIT 1");
	$stmt->bindParam(':username', $user, PDO::PARAM_STR, 32);
	$stmt->bindParam(':password', $pass, PDO::PARAM_STR, 32);

	$stmt->execute();
	$count= $stmt->rowCount();
	return $count;
	
	}

	public function createAccount($clean)
	{
		$date = date('Y-m-d',mktime(0,0,0,$clean["month"], $clean["date"], $clean["year"]));
		$cur_date = date('Y-m-d H:i:s');
		/*	$dir_path = "/users/".$clean["email"]."/"; */
		$stmt = $this->_dbh->prepare("INSERT INTO auths(username,password,email,sex,dob,time) VALUES(?,?,?,?,?,?)");
		$stmt->bindParam(1, $clean["user"]);
		$stmt->bindParam(2, $clean["pass"]);
		$stmt->bindParam(3, $clean["email"]);
		$stmt->bindParam(4, $clean["sex"]);
		$stmt->bindParam(5, $date);
		$stmt->bindParam(6, $cur_date);
		
		$this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$stmt->execute();	
			
		}
		catch(PDOException $e)
		{
			return $e;
		}
		$userid = $this->_dbh->lastInsertId();
		$dir= "/img/users/".$userid."/";
		$stmt = $this->_dbh->prepare("UPDATE auths SET dir_path = :dir WHERE user_id = :userid");
		$stmt->bindParam(':dir', $dir, PDO::PARAM_STR, 50);
		$stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
		
		$stmt->execute();
		$old= umask(0);
	

		mkdir("/home/r3b3l/vhosts/project0/public/img/users/".$userid, 0777, true);
		umask($old);
	
	}
	 

	public function updateStatusOnline($user) {

		$stmt = $this->_dbh->prepare("UPDATE auths SET status = 'online' WHERE username = :userid");
		$stmt->bindParam(':userid', $user, PDO::PARAM_STR, 32);
		$stmt->execute();

	}


	public function updateStatusOffline($user) {

		$stmt = $this->_dbh->prepare("UPDATE auths SET status = 'offline' WHERE username =:userid");
		$stmt->bindParam(':userid', $user, PDO::PARAM_STR, 32);
		$stmt->execute();

		}
	}


