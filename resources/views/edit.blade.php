@include('header')
<html>
<head>

<title>Edit Record</title>

</head>

<body>

 <?php   foreach($record as $res)
          {
          	$id=$res['id'];
          	$name=$res['name'];
          	$email=$res['email'];
          	$mob=$res['mob'];
          	$pcode=$res['pcode'];
          	$add=$res['address'];
          }
   ?>
         <form method="get" action="update">
			<table height="200px"width="500px">
				<tr>
				   <td>Id</td>
				   <td><input type="text" name="id"  value="<?php echo $id; ?>"></td>
				</tr>

				<tr>
				    <td>Name</td>
				     <td><input type="text" name="name"  value="<?php echo $name; ?>"></td>
				</tr>
				
				<tr>
				    <td>Email</td>	
				     <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
				</tr>
				
				<tr>
				     <td>Mobile No.</td>
				     <td><input type="number" name="mob" value="<?php echo $mob; ?>"></td>
				</tr>

				<tr>
				     <td>Pine code</td>
				     <td><input type="number" name="pcode" value="<?php echo $pcode; ?>"></td>
				</tr>
               
                
				<tr>
				     <td>Address:</td>
				      <td><textarea name="address"  ><?php echo $add; ?></textarea></td>
				</tr>

				<tr>
				   <td><input type="submit" name="submit"  value="update"></td>
				</tr>

				
			</table>
			</form>

		</body>
		</html>
