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
		$dir_path = "/users/".$clean["email"]."/";
		$stmt = $this->_dbh->prepare("INSERT INTO auths(username,password,dir_path,email,sex,dob,time) VALUES(?,?,?,?,?,?,?)");
		$stmt->bindParam(1, $clean["user"]);
		$stmt->bindParam(2, $clean["pass"]);
		$stmt->bindParam(3, $dir_path);
		$stmt->bindParam(4, $clean["email"]);
		$stmt->bindParam(5, $clean["sex"]);
		$stmt->bindParam(6, $date);
		$stmt->bindParam(7, $cur_date);
		
		$this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$stmt->execute();	
		}
		catch(PDOException $e)
		{
			return $e;
		}
	}

}
