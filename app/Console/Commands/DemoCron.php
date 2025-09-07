<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event_completed:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


       



        $qry = 'SELECT * FROM events where status="Upcomming"';
$event_info =  DB::select($qry);

if (empty($event_info)) {
    $data=0;

}else{


$event_info = json_decode(json_encode($event_info), true);

foreach ($event_info as $event)
{

 $event_id = $event['Id'];
 $u_id = $event['u_id'];
 $u_email = $event['u_email']; 
 $title = $event['title'];
 $description = $event['description'];
 $image = $event['image'];
 $price = "";
 $city = $event['city'];
 $location = $event['location'];
 $address = $event['address'];
 $phone = $event['phone'];
 $email = $event['email'];
 $website = $event['website'];
 $e_type = $event['e_type'];
 $e_time = $event['e_time'];
 $e_category = $event['e_category'];

  $status = $event['status'];

 $e_date = $event['e_date'];

  

$event_date_time_x = str_replace('T', ' ', $e_date);





 $date_time_array = explode('T', $e_date);
 
 


 $dateonly=$date_time_array[0];
 $date=$date_time_array[0];

 


 $timeonly=$date_time_array[1];
 $time=$date_time_array[1];
 $time= date('h:i a', strtotime($time));
 




 // $date= date('D, M y', strtotime($date)).", ".$time;

 



$current_date_time = date("Y-m-d H:i");





echo "Id: ".$event_id."<br>";

echo "Before".$event_date_time_x."<br>";



$event_time_after_24hours = date('Y-m-d H:i',strtotime('+24 hour +0 minutes',strtotime($event_date_time_x)));


// echo "After".$new_time."<br>";

echo "current date ".$current_date_time."<br>";





if ($current_date_time>$event_time_after_24hours) {

   $data =  DB::table('events')->where('Id', $event_id)->update(
['status' => "Completed"
 ]);


DB::table('tickets')->where('event_id', $event_id)->where('ticket_status', 'Active')->update(
['ticket_status' => "Expired"]);


echo "Updated <br>";

}else{

    echo "Time Left <br>";

    // echo date_default_timezone_get();
}






}


}


    }
}
