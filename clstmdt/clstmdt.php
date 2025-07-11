<?php
class tmdt
{
	public function connectDB()
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
	public function printProduct($sql)
	{
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i=mysql_num_rows($result);
		if($i>0)
		{
			while($row=mysql_fetch_array($result))
			{
				$id = $row['id'];
				$product_name = $row['product_name'];
				$product_discribe = $row['product_discribe'];
				$product_price = $row['product_price'];
				$product_image = $row['product_image'];
				echo '<div id="product">
							<div id="product_images"><img src="image/'.$product_image.'" width="180" height="200" alt=""/></div>
							<div id="product_info">
								<div id="product_name">'.$product_name.'</div>
								<div id="product_discribe">'.$product_discribe.'</div>
								<div id="product_price">Price:'.$product_price.'USD</div>
							</div>
						</div>';
			}
		}
		else
		{
			echo 'Khong co du lieu!!';	
		}
		mysql_close($link);
		
	}
	public function printCompany($sql)
	{
		$link = $this->connectDB();
		$result = mysql_query($sql,$link);
		$i=mysql_num_rows($result);
		if($i>0)
		{
			while($row=mysql_fetch_array($result))
			{
				$id = $row['id'];
				$company_name = $row['company_name'];
				echo '<a href="?id_company='.$id.'">'.$company_name.' </a>';
				echo '<br>';
			}
		}
		else
		{
			echo 'Khong co du lieu!!';	
		}
		mysql_close($link);
		
	}
}
?>