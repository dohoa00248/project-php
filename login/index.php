
<?php include ("../clstmdt/clslogin.php");
$p = new login();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post">
  <table width="600" border="1" align="center" cellpadding="2" cellspacing="0">
    <tbody>
      <tr>
        <td colspan="2" align="center">Login</td>
      </tr>
      <tr>
        <td width="132" align="left">Enter username:</td>
        <td width="462" align="left"><input type="text" name="txtuser" id="txtuser"></td>
      </tr>
      <tr>
        <td align="left">Enter password:</td>
        <td align="left"><input type="password" name="txtpass" id="txtpass"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Login">
        <input type="reset" name="reset" id="reset" value="Reset"></td>
      </tr>
    </tbody>
  </table>
  

</form>
<div align="center">
  <?php
	switch($_POST['nut'])
	{
		case 'Login':
		{
			$user = $_REQUEST['txtuser'];
			$pass = $_REQUEST['txtpass'];
			if($user!=''&&$pass!='')
			{
				$p->mylogin($user,$pass);
			}
			else
			{
				echo 'Please enter full information!!';
			}
			break;
		}
	}
	?>
  </div>
</body>
</html>