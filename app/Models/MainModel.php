<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;

class MainModel extends Model
{
    use HasFactory;








public function signin_ajax($email_username,$password){

$qry = 'SELECT * FROM users WHERE Email ="'.$email_username.'" and Password="'.$password.'"';
$data =  DB::select($qry);
if (empty($data)) {

return 0;

}else{


return 1;
}


}

public function insert_function($data,$table_name){

$data =  DB::table($table_name)->insert([$data]);

return $data;


}

public static function get_logged_in_user_id($user_email){
        $qry = 'SELECT * FROM users WHERE Email ="'.$user_email.'"';
        $data =  DB::select($qry);
        $data = json_decode(json_encode($data), true);
        return $data;
        }


public function check_if_loggedin(){

  $user_email=Session::get('email');
if ($user_email=="") {
   $loggedin = "No";    
}else{
    $loggedin = "Yes";
    

}



return $loggedin;


}


///////////////////////////////////////////////

public function get_all_users(){

$qry = 'SELECT * FROM users';
$data =  DB::select($qry);

return $data;


}

public function get_single_event($event_id){

$qry = 'SELECT * FROM events where Id="'.$event_id.'"';
$data =  DB::select($qry);

return $data;


}


public function get_all_events($e_type,$e_category,$city,$location,$sortby,$filtered_searching){


    if ($e_type=="") {

        $e_type='events.e_type IS NOT NULL';
        
    }else{

   $e_type='events.e_type LIKE "%'.$e_type.'%"';
        
        }



  if ($city=="") {

        $city='events.city IS NOT NULL';
        
    }else{

   $city='events.city LIKE "%'.$city.'%"';
        }






  if ($e_category=="") {

        $e_category='events.e_category IS NOT NULL';
        
    }else{

   $e_category='events.e_category LIKE "%'.$e_category.'%"';
}


  if ($location=="") {

        $location='events.location IS NOT NULL';
        
    }else{

   $location='events.location LIKE "%'.$location.'%"';
}

if ($sortby=="") {

$sort="";
}else{

 $sort='ORDER BY '.$sortby.'';

}



if ($filtered_searching=="") {
    

$qry = 'SELECT * FROM events JOIN (SELECT event_id,MIN(ticket_price) as minprice FROM tickettypes WHERE ticket_price!="" AND ticket_quantity!="0" GROUP BY event_id) as allmax ON events.Id=allmax.event_id where events.status="Upcomming" AND '.$e_type.' AND '.$city.' AND '.$location.' AND '.$e_category. ' '.$sort.' ';

}else{



$qry='SELECT * FROM events INNER JOIN (SELECT event_id,MIN(ticket_price) as minprice FROM tickettypes WHERE ticket_price!="" AND ticket_quantity!="0" GROUP BY event_id) as allmax ON events.Id=allmax.event_id JOIN (SELECT * FROM events WHERE title LIKE "%'.$filtered_searching.'%" OR e_type LIKE "%'.$filtered_searching.'%" OR location LIKE "%'.$filtered_searching.'%" OR city LIKE "%'.$filtered_searching.'%" OR e_category LIKE "%'.$filtered_searching.'%" OR e_time LIKE "%'.$filtered_searching.'%" OR description LIKE "%'.$filtered_searching.'%" ) as searchresult ON events.Id=searchresult.Id where events.status="Upcomming" AND '.$e_type.' AND '.$city.' AND '.$location.' AND '.$e_category. ' '.$sort.'';

}

    


// $qry='SELECT * FROM events INNER JOIN (SELECT event_id,MIN(ticket_price) as minprice FROM tickettypes WHERE ticket_price!="" AND ticket_quantity!="0" GROUP BY event_id) as allmax ON events.Id=allmax.event_id where events.status="Upcomming" AND '.$e_type.' AND '.$city.' AND '.$e_category.' AND '.$location;



$data =  DB::select($qry);

return $data;


}




public function insert_function_getid($data,$table_name){

$data =  DB::table($table_name)->insertGetId($data);

return $data;


}







public function get_data($table_name,$where,$where2,$where3){

if ($where2=="") {
  $where2=null;
  }

  if ($where3=="") {
  $where3=null;
  }
$data = DB::table($table_name)->where($where)->orwhere($where2)->orwhere($where3)->get();


return $data;


}


 



public static function get_ticket_join_event($user_id){

        $qry = 'SELECT t1.*,t2.title,t2.e_date FROM tickets t1 join events t2 on t1.event_id=t2.Id where t1.user_id="'.$user_id.'"';
        $data =  DB::select($qry);
        // $data = json_decode(json_encode($data), true);
        return $data;
        }

        
public function get_event_tickets_by_id($event_id){

    
$qry = 'SELECT t1.*,t2.title,t2.e_date FROM tickets t1 join events t2 on t1.event_id=t2.Id WHERE t1.event_id ="'.$event_id.'"';
$data =  DB::select($qry);
// $data = json_decode(json_encode($data), true);
return $data;
}

public function get_event_ticket_types($event_id){

$qry = 'SELECT * FROM tickettypes WHERE event_id ="'.$event_id.'" ';
$data =  DB::select($qry);
// $data = json_decode(json_encode($data), true);
return $data;
}


public static function get_single_ticket_info($ticket_id){
$qry = 'SELECT t1.*,t2.title,t2.e_date,t2.online_zoom_link,t2.location FROM tickets t1 join events t2 on t1.event_id=t2.Id WHERE t1.Id ="'.$ticket_id.'"';
$data =  DB::select($qry);
// $data = json_decode(json_encode($data), true);
return $data;
}


public function get_all_managers(){

$qry = 'SELECT * FROM managers';
$data =  DB::select($qry);

return $data;


}


}
