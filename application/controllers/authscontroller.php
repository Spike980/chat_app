<?php

class AuthsController extends Controller {


	function login() {
		
		$this->set('title', 'Log-In');
		
		}

	function authorize() {
		global $clean;

		$this->set('title','Authenticated');
			
        	$count=0;
		if (isset($clean["user"]) && isset($clean["pass"]))
		{
			$count=$this->Auth->query($clean["user"],$clean["pass"]);
			print($count);
			if ($count==1)
			{
				$_SESSION['authenticated']=true;
				$_SESSION['user'] = $clean["user"];
			}
			else

			   	echo 'Please Sign in first';
			
		}
	
	
			$this->set('count',$count);
	}



	function signup()
	{
		$this->set('title','Sign-Up');
	}

	function submit()
	{
		$check=0;
		$this->set('title','My Chat');

		global $clean;

//		$fields = array("user", "pass", "email", "date", "month", "year", "sex");

		if (isset($clean["user"]) && isset($clean["pass"]) && isset($clean["date"]) && isset($clean["month"]) && isset($clean["year"]) && isset($clean["sex"]))
		{
			$msg=$this->Auth->createAccount($clean);

		}
		else
		{
			$msg = "Please fill in the form first";
			$check=1000;
		}
		$this->set('check',$check);
		$this->set('msg',$msg);
	}

}


