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
      echo "</tr>";
          }
          ?>

 </table>