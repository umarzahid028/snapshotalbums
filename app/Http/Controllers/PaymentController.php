<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Payment;
use Config;
use Illuminate\Support\Facades\DB;
  
class PaymentController extends Controller
{
  
    public $gateway;
  
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AXi2TVhqiUVuAx66qsgSa-rt4WOQQaWxaea1_GuUN3mJhNyVGeSnB6tFFvOAlBYnSxGPiYgH102NPx7N');
        $this->gateway->setSecret('EKmMHh8AxQoeO9tZ4h9VdEwjtWTHq_G1RepRxsK6hHeiCX28Jmc-dOwq9FaDbhpoLppTdNGXnBZld_Ft');
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
  
    public function index()
    {
        return view('payment');
    }



    public function sendingmail($event_id,$ticket_price,$payment_id,$user_email,$user_name,$ticket_type,$ticket_id)
    {


         $to = $user_email;
    
    $username= $user_name;
    $email= 'corammers@gmail.com';
   $event_id= $event_id;
   $ticket_price=$ticket_price;
   $payment_id=$payment_id;
   $ticket_type=$ticket_type;
    

  
    $headers = "From: " . $email . "\r\n"; // Sender's E-mail
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message ='<table style="width:100%">
    <h1>Thank You For Buying Ticket</h1>
       
       
        <tr><td><a href="'.url('/').'/ticket-info?ticket_id='.$ticket_id.'" style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display:inline-block;font-size: 16px;">View Ticket</a></td></tr>

     
        
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        // echo "Mail send successfully";
        
        // return redirect('/mail-success?user_email='.$user_email.'');
        return "Mail send successfully";
    }else{
        echo 'failed';
        return "Mail send successfully";
        // return redirect('/mail-failed');
    }


        
    }



  
    public function charge(Request $request)
    { 
                 

        // $signin_status =$request->input('signin_status');
        // $user_id =$request->input('user_id');



                $category =$request->input('category');
                $price =$request->input('price');
                $u_id =$request->input('u_id');

                
        


            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $price,
                    'currency' => 'GBP',
                    'returnUrl' => url('paymentsuccess?u_id='.$u_id.'&category='.$category.'&price='.urlencode($price)),
                    'cancelUrl' => url('paymenterror'),

                ))->send();
           
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage().config('paypal.PAYPAL_CURRENCY');
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }










            
        
        
    }
  
    public function payment_success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
          
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
          

                // Insert transaction data into the database
                // $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();
          
                // if(!$isPaymentExist)
                // {
                //     $payment = new Payment;
                //     $payment->payment_id = $arr_body['id'];
                //     $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                //     $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                //     $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                //     $payment->currency = env('PAYPAL_CURRENCY');
                //     $payment->payment_status = $arr_body['state'];
                //     $payment->save();
                // }

// $signin_status =$_GET['signin_status'];
// $user_id =$_GET['user_id'];




    $u_id =$_GET['u_id'];
$category =$_GET['category'];

$price =$_GET['price'];




       
                $p_id =  DB::table('payments')->insertGetId(
    ['price' => $price , 'category' => $category , 'u_id' => $u_id ]);

                  

            
    




return redirect('/payment-successfull');



            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    

}
  
    public function payment_error()
    {
        return 'User is canceled the payment.';
    }


    public function freeticket(Request $request)
    { 
                 

        
        $user_id =$request->input('user_id');
        $amount ="Free";
       
        $organizer_id =$request->input('organizer_id');
        $event_id =$request->input('event_id');
        $signin_status =$request->input('signin_status');
        $ticket_type =$request->input('ticket_type');

        $ticket_type_id = $request->input('ticket_type_id');

        $user_email = $request->input('user_email');

        if ($user_email==null) {
            $user_email="";
        }



        $payment_status ='Free';
        $payment_id = "Free";


        $tquantity =$request->input('tquantity');



        $coupon_applied =$request->input('coupon_applied');
        $coupon_discount =$request->input('coupon_discount');
        $remaining_coupon_price =$request->input('remaining_coupon_price');
        $couponvalue =$request->input('couponvalue');

// if ($coupon_discount!="No") {
//     $ticket_price=0;
// }else{
//     $ticket_price =$coupon_discount;
    
// }
         $ticket_price="Free";

        if ($coupon_applied=="Yes") {
            
if ($remaining_coupon_price>0) {

     $data2 = DB::table('tickets')->where('coupon','=', $couponvalue)->update(['ticket_price' => $remaining_coupon_price]);

        }else{

$data2 = DB::table('tickets')->where('coupon','=', $couponvalue)->update(['coupon' => 'Used','coupon' => 'Used']);

        }

        $ticket_price=$coupon_discount;
    
}
           

$created_ticket_id = array();

$ticket_price=$ticket_price/$tquantity;

for ($i=1; $i <= $tquantity ; $i++) { 

//this will decrement the quantity
    $this->decrementticket($ticket_type_id);

$user_first_name =$request->input('user_first_name_'.$i);
        $user_last_name =$request->input('user_last_name_'.$i);

      
       $user_name= $user_first_name." ".$user_last_name;


       
                $ticket_id =  DB::table('tickets')->insertGetId(
    ['event_id' => $event_id , 'user_id' => $user_id , 'organizer_id' => $organizer_id , 'ticket_price' => $ticket_price, 'ticket_type' => $ticket_type , 'payment_status' => $payment_status , 'payment_id' => $payment_id, 'user_email' => $user_email, 'user_first_name' => $user_first_name, 'user_last_name' => $user_last_name, 'ticket_status' => 'Active', 'coupon' => '']);


                array_push($created_ticket_id,$ticket_id);


             if ($user_email!="") {
              $this->sendingmail($event_id,$ticket_price,$payment_id,$user_email,$user_name,$ticket_type,$ticket_id);
           }
        
        
  


}


$created_ticket_id = implode(', ', $created_ticket_id);

return redirect('/my-ticket');

    


        
    }



    public function decrementticket($ticket_type_id)
    {



$data= DB::table('tickettypes')->where('Id','=', $ticket_type_id)->update(['ticket_quantity' => DB::raw('GREATEST(ticket_quantity - 1, 0)')]);
return $data;

    }
  

 public function cinetpay_payment_success(Request $request)
    {



if (isset($_POST['cpm_trans_id'])) {

    $organizer_id =$_GET['organizer_id'];
$event_id =$_GET['event_id'];

$user_id =$_GET['user_id'];

$user_email =$_GET['user_email'];




$ticket_type =$_GET['ticket_type'];
$ticket_type_id = $_GET['ticket_type_id'];
$tquantity =$_GET['tquantity'];


$coupon_applied =$_GET['coupon_applied'];
$coupon_discount =$_GET['coupon_discount'];
$remaining_coupon_price =$_GET['remaining_coupon_price'];
$couponvalue =$_GET['couponvalue'];

$actualprice =$_GET['actualprice'];



 if ($coupon_applied=="Yes") {
            
if ($remaining_coupon_price>0) {

     $data2 = DB::table('tickets')->where('coupon','=', $couponvalue)->update(['ticket_price' => $remaining_coupon_price]);

        }else{

$data2 = DB::table('tickets')->where('coupon','=', $couponvalue)->update(['coupon' => 'Used']);

        }

        $ticket_price=$actualprice;
    
}
          





// $ticket_price = $_GET['singleticketprice'];
$payment_status ='Completed';
$payment_id ='cinetpay';


$created_ticket_id = array();


$ticket_price=$ticket_price/$tquantity;

for ($i=1; $i <= $tquantity ; $i++) { 

     $this->decrementticket($ticket_type_id);


$user_first_name =$_GET['user_first_name_'.$i];
$user_last_name =$_GET['user_last_name_'.$i];

$user_name= $user_first_name." ".$user_last_name;

      
       
                $ticket_id =  DB::table('tickets')->insertGetId(
    ['event_id' => $event_id , 'user_id' => $user_id , 'organizer_id' => $organizer_id , 'ticket_price' => $ticket_price, 'ticket_type' => $ticket_type , 'payment_status' => $payment_status , 'payment_id' => $payment_id, 'user_email' => $user_email, 'user_first_name' => $user_first_name, 'user_last_name' => $user_last_name, 'ticket_status' => 'Active', 'coupon' => '']);

           array_push($created_ticket_id,$ticket_id);

      if ($user_email!="") {
              $this->sendingmail($event_id,$ticket_price,$payment_id,$user_email,$user_name,$ticket_type,$ticket_id);
           }
        
        
    




    }


          


$created_ticket_id = implode(', ', $created_ticket_id);

return redirect('/my-ticket');

}


    }




    

  
}