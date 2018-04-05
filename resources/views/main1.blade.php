@include('header')
<html>
<title>Demo</title>
<head>
</head>
<body>
	<br/><br/>
	
	<h2 align="center">Welcome to <?php 
foreach($record as $records)
{
echo $records->name;
}
	?> on demo page </h2>
	
</body>
</html>