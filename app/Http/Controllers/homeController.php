<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller ;
use App\Record;
use App\Admin;
use Mail;
use PDF;
use Excel;
use PHPExcel_Worksheet_Drawing;
use Dompdf\Dompdf;
use Milon\Barcode\DNS1D;
use CodeItNow\BarcodeBundle\Utils\QrCode;


class homeController extends Controller{
 
   
   public function index()
   {
    
       return view('main');
   }

public function about(){
    return view('index');
}



public function login()
{

    return view('login');
}


public function loginaction(Request $request)
{
    $password      =    $request->password;
    $email         =    $request->email;
    $record        =    Admin::
                        where('email',$email)
                       ->where('password',$password)
                       ->get();

   foreach($record as $records)
   {

    $id          =      $records->id;

   }

     $request->session()->put('id',$id);

      if(!$record->isEmpty())
      {

    return view('main1',compact('record'));
       }
       else
        {    
          return redirect()
                 ->intended('login')
                 ->withErrors('email id or password is incorrect'); 
            }
          }




public function register(Request $request)
{
	
   $name             =   $request->name;
   $email            =   $request->email;
   $mob              =   $request->mob;
   $pcode            =   $request->pcode;
   $address          =   $request->address;
   $record           =   new Record;
   $record->name     =   $name;
   $record->email    =   $email;
   $record->mob      =   $mob;
   $record->pcode    =   $mob;
   $record->address  =   $address;
                         $record->save();


   return redirect()->intended('login');


}
 



public function show()
{
  $record   =    Record::all();
//   foreach($record as $records)
//   {
//  $name=$records->name;
//  }

//  $qrCode = new QrCode();
//  $qrCode
//     ->setText($name)
//     ->setSize(50)
//     ->setPadding(30)
//     ->setErrorCorrection('high')
//     ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
//     ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
//     // ->setLabel('Scan Qr Code')
//     // ->setLabelFontSize(16)
//     ->setImageType(QrCode::IMAGE_TYPE_PNG)
// ;



     

return view('show',compact('record'));

}


    public function downloadPDF(Request $request ){

      $id            =   $request->id;
      $record        =    Record::where('id',$id)->first();

      $data[] = ['id','Name','Email','Mobile','Pincode','Address','File','createt_at','updated_at'];
      // $dompdf        =   new Dompdf();
      //                    $dompdf->loadHtml('hello');
      //                    $dompdf->setPaper('A4', 'landscape');
      //                    $dompdf->render();
      //                    $dompdf->stream();
    
      $pdf           = PDF::loadView('show', $data, compact('record'));
      return $pdf->download('laravelpdf.pdf');

       
            }


    public function downloadEXCEL(Request $request ){

      $id            =   $request->id;
      $record        =    Record::where('id',$id)->get();
      $data=[];
     
       // $Image = '<img width="200px" src="http://localhost/blog/public/images/a.jpg" />';
    
      $data[] = ['id','Name','Email','Mobile','Pincode','Address','File','createt_at','updated_at'];
  
      $count=0;
      foreach ($record as $records) {

        $data[]= $records->toArray();
        $count++;
    }

        $count=$count+5;
        $date=date("Y/m/d");
     // $sheet->getRowDimension(1)->setRowHeight(10);
    // $objDrawing->setCoordinates('A1');

       Excel::create('Laravel Excel', function($excel) use($data,$count,$date){
      
        $excel->sheet('Excel sheet', function($sheet) use($data,$count,$date) {
           
            $sheet->mergeCells('A1:I1');
            $sheet->row(1, function ($row) { 
               $row->setFontSize(40);
               $row->setAlignment('center');
                    });
       
            $objDrawing = new PHPExcel_Worksheet_Drawing;
            $objDrawing->setCoordinates('C1');
            $objDrawing->setPath(public_path('images/a.jpg')); 
            $objDrawing->setHeight(40);
            $objDrawing->setWidth(65);

            $objDrawing->setWorksheet($sheet);  


            $sheet->row(1, array('Testing'));
             
          
            $sheet->row(2, function ($row) {
            $row->setFontFamily('Rockwell Extra Bold');
            $row->setFontSize(12);
            $row->setFontWeight('bold');
                });
            $sheet->setWidth('A', 7);
            $sheet->setWidth('B', 12);
            $sheet->setWidth('C', 28);
            $sheet->setWidth('D', 20);
            $sheet->setWidth('E', 20);
            $sheet->setWidth('F', 28);
            $sheet->setWidth('G', 25);
            $sheet->setWidth('H', 22);
            $sheet->setWidth('I', 22);
            $sheet->fromArray($data);

            
            $sheet->row($count, array('created at',$date));
 
              });

             })->export('xlsx');

            }
 

public function edit(Request $request)
{
   $id           =   $request->id;
   $record       =   Record::
                     where('id',$id)->get();

   return view('edit',compact('record'));
}




public function update(Request $request)
{

 $id   =   $request->id;
 $data =  [
           'name'      =>    $request->name,
            'email'    =>    $request->email,
            'mob'      =>    $request->mob,
            'pcode'    =>    $request->pcode,
            'address'  =>    $request->address
          ];

$record     =       Record::where('id',$id)
                           ->update($data);

      return redirect()->intended('show')
                 ->withErrors('updated sucessfully');
}




public function delete(Request $request)
{
          $id       =     $request->id;
          $record   =    Record::where('id',$id)
                         ->delete();
         return redirect()->intended('show')
                ->withErrors('Deleted Sucessfully record');
}





public function passwordupdate()
{

   return view('profile');

} 






public function pupdate(Request $request)
{
       $id       =     $request->session()
                       ->get('id');
       $opass    =     $request->opassword; 
       $pass     =     $request->password;
       $cpass    =     $request->cpassword;
       $len      =     strlen($pass);
       $len1     =     strlen($cpass);

    if($len < 5 || $len1 <5 )
     {

       return redirect()
             ->intended('passwordupdate')
             ->withErrors('password minmum 6 digit');

     }

         $record   =    Admin::where('id',$id)
                        ->get();
      foreach($record as $records)
{
      $ospass =      $records->password;
}
if($opass!=$ospass )
{
  return redirect()->intended('passwordupdate')->withErrors('old password do not match'); 
}
$pass          =         $request->password;
$cpass         =         $request->cpassword;
if($pass!=$cpass || $pass=='')
{
   return redirect()->intended('passwordupdate')->withErrors('new password  and conform password do not match'); 
}
else
{
 Admin::where('id',1)
->update(array('password'=>$pass));
return redirect()->intended('passwordupdate')->withErrors('password change sucessfully'); 
}
}





public function forgot()
{
   return view('forgot');
}

public function passwordsend(Request $request)
{
  $email=$request->email; 
    $record = Admin::where('email',$email)
    ->get();
    foreach($record as $records)
    {
      $pass=$records->password;
    }
  if(!$record->isEmpty())
  {

   return redirect()->intended('login')->withErrors('your password has been send on your email id ');
  }
}



public function session1()
{

return view('session1');

}



public function session2(Request $request)
{
 $name              =    $request->name;
 $request->session()->put('name',$name);
 // $id = $request->session()->get('name');
return view('session2');
}



public function session3(Request $request)
{
$data               =        $request->email;
           
                          $request->session()
                          ->put('email',$data);
   return view('session3');
}




public function session4(Request $request)
{
          $data          =          $request->mob;
           
                                   $request->session()->put('mob',$data);
   return view('session4');
}



public function session5(Request $request)
{
                 $data  =         $request->pcode;
           
                                 $request->session()->put('pcode',$data);
   return view('session5');
}


public function session6(Request $request)
{
 

 
  $this->validate($request, [

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);

    $image                =         $request->file('image');
    // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
    $data                =          $request->image
                                    ->getClientOriginalName();
    $destinationPath     =          public_path('/images');
                                   $image->move($destinationPath,  $data );
  

   $name                 =         $request->session()
                                   ->get('name');
   $email                =        $request->session()
                                  ->get('email');
   $mob                  =       $request->session()
                                 ->get('mob');
   $pcode                =       $request->session()
                                 ->get('pcode');
   $file                 =       $data;
   $add                  =     'address';
   $record               =     new Record;
   $record->name         =     $name;
   $record->email        =     $email;
   $record->mob          =     $mob;
   $record->pcode        =     $mob;
   $record->address      =     $add;
   $record->file         =     $file;
                               $record->save();
                               $request->session()->flush();
return redirect()->intended('session1');
}


    public function myCaptchaPost(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ],
        ['captcha.captcha'=>'Invalid captcha code.']);
        dd("You are here :) .");
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function barcode()
{
  
 return view('barcode');
}
}
