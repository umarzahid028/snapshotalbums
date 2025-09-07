<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MainModel;
use DateTimeZone;
use DateTime;
use Session;

class User extends Controller
{
    function user_dashboard(){


        $model = new MainModel;
        $data['loggedin']= $model->check_if_loggedin();
        $data['u_id']="";
        $data['u_email']="";

        if ($data['loggedin']=="Yes") {
            $user_email=Session::get('email');
          $user_details= $model->get_logged_in_user_id($user_email); 
    $data['u_id'] = $user_details[0]['id'];
    $data['u_email'] = $user_details[0]['Email'];
    $data['u_name'] = $user_details[0]['Name'];
    $data['Image'] = $user_details[0]['Image'];

     $uid = $data['u_id'];


    $qry = "select * from Tasks where u_id='$uid'";

    $data['user_tasks'] =  DB::select($qry);

    return view('userdashboard.dashboard',compact('data'));

        }

         
            
else{

   return redirect('/login');
}

}

 function post_task(){

         $model = new MainModel;
        $data['loggedin']= $model->check_if_loggedin();
        $data['u_id']="";
        $data['u_email']="";

        if ($data['loggedin']=="Yes") {
            $user_email=Session::get('email');
          $user_details= $model->get_logged_in_user_id($user_email); 
    $data['u_id'] = $user_details[0]['id'];
    $data['u_email'] = $user_details[0]['Email'];
    $data['u_name'] = $user_details[0]['Name'];
    $data['Image'] = $user_details[0]['Image'];

    $u_id = $data['u_id'];

    // $qry = "select * from payments where u_id='$u_id' ORDER BY category ASC";

    // $data['categories'] =  DB::select($qry);

    return view('userdashboard.post-task',compact('data'));

        }
        
            
else{

   return redirect('/login');
}

} 

function manage_tasks(){

         $model = new MainModel;
        $data['loggedin']= $model->check_if_loggedin();
        $data['u_id']="";
        $data['u_email']="";

        if ($data['loggedin']=="Yes") {
            $user_email=Session::get('email');
          $user_details= $model->get_logged_in_user_id($user_email); 
    $data['u_id'] = $user_details[0]['id'];
    $data['u_email'] = $user_details[0]['Email'];
    $data['u_name'] = $user_details[0]['Name'];
    $data['Image'] = $user_details[0]['Image'];

    $uid = $data['u_id'];


    $qry = "select * from Tasks where u_id='$uid'";

    $data['user_tasks'] =  DB::select($qry);

    return view('userdashboard.manage-tasks',compact('data'));

        }
        
            
else{

   return redirect('/login');
}

}


function manage_bidders($t_id){

     $t_id=base64_decode($t_id);

         $model = new MainModel;
        $data['loggedin']= $model->check_if_loggedin();
        $data['u_id']="";
        $data['u_email']="";

        if ($data['loggedin']=="Yes") {
            $user_email=Session::get('email');
          $user_details= $model->get_logged_in_user_id($user_email); 
    $data['u_id'] = $user_details[0]['id'];
    $data['u_email'] = $user_details[0]['Email'];
    $data['u_name'] = $user_details[0]['Name'];
    $data['Image'] = $user_details[0]['Image'];

    $qry = "select * from bids where t_id='$t_id'";

    $data['bids'] =  DB::select($qry);

    $qry1 = "select * from Tasks where Id='$t_id'";

    $data['Task'] =  DB::select($qry1);


    return view('userdashboard.manage-bidders',compact('data'));

        }
        
            
else{

   return redirect('/login');
}

}

 

function post_task_ajax(Request $request)
{


 $u_id=$_POST['u_id'];
$u_email=$_POST['u_email']; 
$post_name=$_POST['post_name'];
$Category=$_POST['Category'];
$Location=$_POST['Location'];   

$budget_min=$_POST['budget_min'];
$budget_max=$_POST['budget_max'];

$rate=$_POST['rate'];
$Due_Date=$_POST['Due_Date'];
$Describe=$_POST['Describe'];     

$newDate = date("d/m/Y", strtotime($Due_Date));

$data1['u_id'] = $u_id;
$data1['u_email'] = $u_email;
$data1['Name'] = $post_name;
$data1['Category'] = $Category;
$data1['Location'] = $Location;
$data1['Budget_Min'] = $budget_min;
$data1['Budget_Max'] = $budget_max;
$data1['Budget_Rate'] = $rate;
$data1['Due_Date'] = $newDate;

$data1['Description'] = $Describe;


$model = new MainModel;
  $table_name="Tasks";
  $data = $model->insert_function($data1,$table_name);




return $data;
}   
  



   function settings(){


        $model = new MainModel;
        $data['loggedin']= $model->check_if_loggedin();
        $data['u_id']="";
        $data['u_email']="";

        if ($data['loggedin']=="Yes") {
            $user_email=Session::get('email');
          $user_details= $model->get_logged_in_user_id($user_email); 
    $data['u_id'] = $user_details[0]['id'];
    $data['u_email'] = $user_details[0]['Email'];
    $data['u_name'] = $user_details[0]['Name'];
    $data['Image'] = $user_details[0]['Image'];

    $uid = $data['u_id'];

     $qry = "select * from users where id='$uid'";

    $data['user_info'] =  DB::select($qry);

    return view('userdashboard.settings',compact('data'));

        }

         
            
else{

   return redirect('/login');
}

}


   function settings_ajax(Request $request){

    $u_id=$_POST['u_id'];
$u_name=$_POST['name']; 
$email=$_POST['email'];
$Introduction=$_POST['Introduction'];
$o_Image=$_POST['o_Image'];

if ($request->hasfile('image')){
 
$file = $request->file('image');
// $name = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
$name = date('mdYHis').uniqid().$file->getClientOriginalName();
$image['filePath'] = $name;
$file->move(public_path().'/user_img', $name);
$image = $name;

}
else{
    $image = $o_Image;
}


  $data =  DB::table('users')->where('id', $u_id)->update(
[

'Name' => $u_name,
'Email' => $email,
'Introduction' => $Introduction,
'Image' => $image,


 ]);

 return $data;    


}
  

 function change_password_ajax(Request $request){

    $u_id=$_POST['u_id'];
$newpassword=$_POST['new_password']; 




  $data =  DB::table('users')->where('id', $u_id)->update(
[

'Password' => $newpassword,


 ]);

 return $data;    


}

function logout(){

      session()->forget('email');
        return redirect('/');
    }

}