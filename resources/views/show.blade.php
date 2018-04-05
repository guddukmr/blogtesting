 <?php
 use CodeItNow\BarcodeBundle\Utils\QrCode;
 ?>
@include('header')

<br/>
<br/>
<html>
<title>Show Record</title>
<head>
</head>
<body>
<table  border="1" align='center'>
     <tr style='padding : 10px;'>
        <th><b>Name</b></th>
        <th><b>Email</b></th>
        <th><b>MobileNumber</b></th> 
        <th><b>Pinecode</b></th>
        <th><b>Address</b></th>
        <th></th>
        <th></th>
     </tr>
          <?php
   foreach($record as $res)
          {

            $name=$res->name;
            $email=$res->email;
            $mob=$res->mob;
            $pcode=$res->pcode;
            $address=$res->address;

            $data="Name=".$name.''." Email= ".$email.''." Mobile Number= ".$mob.''." Pine code= ".$pcode.''." Address= ".$address; 
            
            $qrCode = new QrCode();
 $qrCode
    ->setText($data)
    ->setSize(100)
    ->setPadding(30)
    ->setErrorCorrection('high')
    ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
    ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
    // ->setLabel('Scan Qr Code')
    // ->setLabelFontSize(16)
    ->setImageType(QrCode::IMAGE_TYPE_PNG);

     echo "<tr style='padding : 10px;'>";
        echo "<td>".$res['name']."</td>";
        echo "<td>".$res['email']."</td>";
        echo "<td>".$res['mob']."</td>";
        echo "<td>".$res['pcode']."</td>";
        echo "<td>".$res['address']."</td>";
        echo "<td>".'<a  href="edit?id=' . $res['id'] . '">Edit</a>'."</td>";
        echo "<td>".'<a   href="delete?id=' . $res['id'] . '">Delete</a>'."</td>";
        echo "<td>".'<a   href="downloadPDF?id=' . $res['id'] . '">Download pdf</a>'."</td>";
        echo "<td>".'<a   href="downloadEXCEL?id=' . $res['id'] . '">Download Excel</a>'."</td>";
        echo "<td>".'<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />'."</td>";
      echo "</tr>";
          }


          ?>

 </table>

  <!-- if there are login errors, show them here -->
     @if(!$errors->isEmpty())
       <div>
           {{ $errors}}        
 </div>
 {{helpercheak()}}
 @endif

 </body>
 </html>
