<?php include ("clstmdt/clstmdt.php");
$p = new tmdt();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/cssgiaodien.css">
</head>

<body>
	<div id="container">
    	<div id="banner"></div>
        <div id="menu"></div>
        <div id="main">
        	<div id="main_left">
            <?php
						$p->printCompany('select * from company order by company_name asc');
				?>
            </div>
            <div id="main_right">
            	<?php
				if(isset($_REQUEST['id_company']))
				{
					$id_company = $_REQUEST['id_company'];	
				}
				else
				{
					$id_company = 0;	
				}
				if($id_company>0)
				{
					$p->printProduct('select * from product where id_publisher='.$id_company.' order by id asc');
				}
				else
				{
					$p->printProduct('select * from product order by id asc');
				}
						
				?>
            </div>
        </div>
        <div id="footer"></div>
    </div>
</body>
</html>