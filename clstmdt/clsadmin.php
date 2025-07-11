<?php
include ("clstmdt.php");
class admin extends tmdt
{
	public function loadlist_company($sql,$getid)
	{
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i=mysql_num_rows($result);
		if($i>0)
		{
			echo ' <select name="selectCompany" id="selectCompany">
            		<option>Please chose Company</option>';
			while($row=mysql_fetch_array($result))
			{
				$id = $row['id'];
				$company_name = $row['company_name'];
				if($id==$getid)
				{
					echo '<option value="'.$id.'" selected>'.$company_name.'</option>';
				}
				else
				{
					echo '<option value="'.$id.'">'.$company_name.'</option>';
				}
				//nay de them san pham .. khi xoa san pham thi dua vo if else
				//echo '<option value="'.$id.'">'.$company_name.'</option>';
			}
			echo '</select>';
		}
		else
		{
			echo 'Đang cập nhật!!';
		}
		mysql_close($link);			
	}
	public function addProduct($sql)
	{
		$link = $this->connectDB();
		if(mysql_query($sql,$link))
		{
			return 1;	
		}
		else
		{
			return 0;
		}
	}
	public function uploadfile($tmp_name,$folder,$name)
	{
		if($tmp_name!='')
		{
			$newname = $folder."/".$name;	
			if(move_uploaded_file($tmp_name,$newname))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
			
	}
	public function loadlist_product($sql)
	{
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i=mysql_num_rows($result);
		if($i>0)
		{
			$dem =1;
			echo '<table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
				  <tbody>
					<tr>
					  <td align="center"><strong>STT</strong></td>
					  <td align="center"><strong>Productname</strong></td>
					  <td align="center"><strong>Discribe</strong></td>
					  <td align="center"><strong>Price</strong></td>
					</tr>';
			while($row=mysql_fetch_array($result))
			{
				$id = $row['id'];
				$name = $row['product_name'];
				$discribe = $row['product_discribe'];
				$price = $row['product_price'];
				echo '<tr>
					  <td align="center"><a href="?getid='.$id.'">'.$dem.'</a></td>
					  <td align="center"><a href="?getid='.$id.'">'.$name.'</a></td>
					  <td align="center"><a href="?getid='.$id.'">'.$discribe.'</a></td>
					  <td align="center"><a href="?getid='.$id.'">'.$price.'</a></td>
					</tr>';
				$dem++;
			}
			echo ' </tbody>
					</table>';
			
		}
		
		else
		{
			echo 'Đang cập nhật!!';
		}
		mysql_close($link);			
	}
	public function select_colum($sql)
	{
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i=mysql_num_rows($result);
		$value='';
		if($i>0)
		{
			
			while($row=mysql_fetch_array($result))
			{
				$value = $row[0];
				
			}
			
		}
		return $value;

	}
	public function delProduct($sql)
	{
		$link = $this->connectDB();
		if(mysql_query($sql,$link))
		{
			return 1;	
		}
		else
		{
			return 0;
		}
	}
	public function modifyProduct($sql)
	{
		$link = $this->connectDB();
		if(mysql_query($sql,$link))
		{
			return 1;	
		}
		else
		{
			return 0;
		}
	}
}
?>