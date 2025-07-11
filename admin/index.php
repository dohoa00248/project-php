<?php
session_start();
 include ("../clstmdt/clslogin.php");
 $q = new login();
if(isset($_SESSION['id'])&& isset($_SESSION['user'])&& isset($_SESSION['pass'])&& isset($_SESSION['phanquyen']))
{
	
	$q->confirmlogin($_SESSION['id'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['phanquyen']);
}
else
{
	header('location:../login/');
}
?>
<?php include ("../clstmdt/clsadmin.php");
$p = new admin();
?>

<?php
if(isset($_REQUEST['getid']))
{
	$getid = $_REQUEST['getid'];
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="800" border="1" align="center" cellpadding="4" cellspacing="0">
    <tbody>
      <tr>
        <td colspan="2" align="center"><h3><strong>MANAGER PRODUCT</strong></h3></td>
      </tr>
      <tr>
        <td width="141"><strong>Company </strong></td>
        <td width="653">
		<?php
			$id_publisher=$p->select_colum("SELECT id_publisher FROM product where id='$getid' limit 1");
		 	$p->loadlist_company("SELECT * FROM COMPANY ORDER BY ID ASC",$id_publisher);
		 ?>
        </td>
      </tr>
      <tr>-
        <td><strong>Productname</strong></td>
        <td align="left"><input name="txtname" type="text" id="txtname" value="<?php echo $p->select_colum("select product_name from product where id='$getid' limit 1");?>">
        <input name="idtodelete" type="hidden" id="idtodelete" value="<?php echo $getid;?>"></td>
      </tr>
      <tr>
        <td><strong>Discribe</strong></td>
        <td align="left"><textarea name="txtdiscribe" cols="50" rows="6" id="txtdiscribe"><?php echo $p->select_colum("select product_discribe from product where id='$getid' limit 1");?></textarea></td>
      </tr>
      <tr>
        <td><strong>Price</strong></td>
        <td><input name="txtprice" type="text" id="txtprice" value="<?php echo $p->select_colum("select product_price from product where id='$getid' limit 1");?>"></td>
      </tr>
      <tr>
        <td><strong>Image</strong></td>
        <td><input type="file" name="myfile" id="myfile"></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
			<input type="submit" name="nut" id="nut" value="Add">
        <input type="submit" name="nut" id="nut" value="Del">
        <input type="submit" name="nut" id="nut" value="Modify"></td>
      </tr>
    </tbody>
  </table>
  <hr>
  <?php
  	$p->loadlist_product("select * from product order by id desc");
  ?>
  <?php
  	switch($_POST['nut'])
	{
		case 'Add':
		{
			$name=$_POST['txtname'];
			$discribe=$_POST['txtdiscribe'];
			$price=$_POST['txtprice'];
			$company=$_POST['selectCompany'];
			$namefile = $_FILES['myfile']['name'];
			$size = $_FILES['myfile']['size'];
			$type = $_FILES['myfile']['type'];
			$tmp_name = $_FILES['myfile']['tmp_name'];
			
			if($name!=''&&$discribe!=''&&$price!='')
			{
				if($type=='image/jpeg')
				{
					$namefile=time()."_".$namefile;
					if($p->uploadfile($tmp_name,"../image",$namefile)==1)
					{
						if($p->addProduct("INSERT INTO product (product_name,product_discribe,product_price,product_image,id_publisher)VALUES ('$name','$discribe','$price','$namefile','$company')")==1)
						{
							//echo 'Insert successfull';
							echo '<script language="javascript">
									alert("Insert succesfull");
									</script>';
							echo '<script language="javascript">
									window.location="../admin/";
									</script>';
						}
						else
						{
							echo 'Insert failure!!';	
						}
					}
					else
					{
						echo 'Upload file failure!!';
					}
				}
				else
				{
					echo 'Please chose file img!!';
				}
			}
			
			else
			{
				echo 'Please input all infor!!';
			}
			break;
		}
		case 'Del':
		{
			$getidtodel=$_REQUEST['idtodelete'];
			if($getidtodel>0)
			{
				$image=$p->select_colum("select product_image from product where id='$getidtodel' limit 1");
				$imagelocation="../image/".$image;
				if(unlink($imagelocation))
				{
					if($p->delProduct("delete from product where  id='$getidtodel' limit 1")==1)
					{
						//echo 'xoa thanh cong';
						
						echo '<script language="javascript">
									alert("Delete succesfull");
									</script>';
							echo '<script language="javascript">
									window.location="../admin/";
									</script>';
									
					}
					else
					{
						echo 'Delete failure!!';	
					}
				}
				else
				{
					echo ' Not to del image';	
				}
			}
			else
			{
				echo 'Please chose product to del!!';
			}
				break;
		}
		case 'Modify':
		{
			$getidtoModify=$_REQUEST['idtodelete'];
			$name=$_POST['txtname'];
			$discribe=$_POST['txtdiscribe'];
			$price=$_POST['txtprice'];
			$company=$_POST['selectCompany'];
			if($getidtoModify>0)
			{
				if($p->modifyProduct("UPDATE product SET product_name = '$name',
												product_discribe = '$discribe',
												product_price = '$price',
												id_publisher = '$company' WHERE id ='$getidtoModify' LIMIT 1")==1)
				{
					echo '<script language="javascript">
									alert("Modify succesfull");
									</script>';
							echo '<script language="javascript">
									window.location="../admin/";
									</script>';	
				}
				else
				{
					echo 'Modify failure!!';
				}
					
			}
			else
			{
				echo 'Please chose product to modify!!';
			}
			break;
		}
	
		
	}
  ?>
</form>
</body>
</html>