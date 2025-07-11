<?php
class login
{
	private function connectDB()
	{
		$conn = mysql_connect("localhost","hoa","hoa123");
		if($conn)
		{
			mysql_select_db("tmdt_db");
			mysql_query("SET NAMES UTF8");
			return $conn;	
		}
		else
		{
			echo 'Khong ket noi duoc csdl!';
			exit();
		}
	}
	public function mylogin($user,$pass)
	{
		$pass = md5($pass);
		$sql = "select id,username,password,phanquyen from accout where username='$user' and password='$pass' limit 1";
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i=mysql_num_rows($result);
		if($i==1)
		{
			while($row=mysql_fetch_array($result))
			{
				$id = $row['id'];
				$username = $row['username'];
				$password = $row['password'];
				$phanquyen = $row['phanquyen'];
				session_start();
				$_SESSION['id']= $id;
				$_SESSION['user']= $username;
				$_SESSION['pass']= $password;
				$_SESSION['phanquyen']= $phanquyen;
				header('location:../admin/');
						
			}
		}
		else
		{
			echo 'User or password invalid!!';
		}
	}
	public function confirmlogin($id,$user,$pass,$phanquyen)
	{
		$sql="select id from accout where id='$id' and username='$user' and password='$pass' and phanquyen='$phanquyen' limit 1";
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i = mysql_num_rows($result);
		if($i!=1)
		{
			header('location:../login/');	
		}
		
	}
}
?>