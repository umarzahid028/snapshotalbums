<?php



namespace App\Http\Controllers\User;
use Carbon\Carbon;



use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\CreateFolder;
use App\Models\UserPayment;

use App\Models\User\Order;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        if(Auth::check() && Auth::user()->role->id == 2 || Auth::user()->role->id == 3 || Auth::user()->role->id == 4)

        {

            $recentOrders = Order::latest()->take(5)->get();

        }

        return view('dashboard' , compact( 'recentOrders'));

        // return 'Test';

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

   public function store(Request $request)
{
    $user = Auth::user();

    // Check if user is on the Free Tier
    if ($user->plan === 'free') {
        $folderCount = \App\Models\CreateFolder::where('user_id', $user->id)->count();

        if ($folderCount >= 1) {
            return redirect()->back()->with('error', 'Free plan only allows 1 event. Upgrade to Premium to create more.');
        }
    }

    // Proceed with folder creation here...
    // Example:
    \App\Models\CreateFolder::create([
        'event_title' => $request->input('event_title'),
        'folder_name' => $request->input('folder_name'),
        'folder_id' => $request->input('folder_id'),
        'date_of_event' => $request->input('date_of_event'),
        'user_id' => $user->id,
    ]);

    return redirect()->back()->with('success', 'Event created successfully.');
}



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }

    public function showSecretCodeForm()
    {
        return view('frontend.beforeadminlogin');
    }
    
    public function showEmailForm()
    {
        // Check if secret code is set in the session
        if (!session()->has('secret_code')) {
            return redirect()->route('admin')->with('error', 'Please enter a valid secret code first.');
        }

        // Retrieve users and their payments
        $users = User::with('userPayments')->get();

        return view('frontend.adminlogin', compact('users'));
    }


    public function processAdmin(Request $request)
    {
        $secretCodes = [
            'SECRET123',
            'CODE456',
            'ACCESS789',
        ];
    
        $inputCode = $request->input('secret_code');
    
        if (in_array($inputCode, $secretCodes)) {
            session(['secret_code' => $inputCode]);
    
            return redirect()->route('admin-login');
        } else {
            return redirect()->back()->with('error', 'Invalid secret code.');
        }
    }

    public function processLogin(Request $request)
    {
        // Ensure the secret code is set in the session
        if (!session()->has('secret_code')) {
            return redirect()->route('admin')->with('error', 'Please enter a valid secret code first.');
        }

        $secretCodes = [
            'SECRET123',
            'CODE456',
            'ACCESS789',
        ];

        $inputCode = session('secret_code');
        $email = $request->input('email');

        // Verify if the code matches the session
        if (!in_array($inputCode, $secretCodes)) {
            return redirect()->route('admin')->with('error', 'Invalid session code.');
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $userPayment = UserPayment::where('user_id', $user->id)->first();

            if ($userPayment) {
                return redirect()->back()->with('error', 'Already assigned');
            } else {
                $userPayment = new UserPayment();
                $userPayment->user_id = $user->id;
                $userPayment->name = $user->name;
                $userPayment->payment_id = strtoupper(uniqid('PAYID'));
                $userPayment->save();

                $user->renew_status = 0;
                $user->save();

                return redirect()->back()->with('success', 'Successfully assigned');
            }
        } else {
            return redirect()->back()->with('error', 'Email does not exist.');
        }
    }
        

    public function account()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Count the number of folders created by the user
        $folderCount = CreateFolder::where('user_id', $user->id)->count();
        $latestPayment = UserPayment::where('user_id', $user->id)->latest()->first();
        if ($latestPayment) {
            $subscriptionEndDate = Carbon::parse($latestPayment->updated_at)->addYear()->format('m/d/Y');
        } else {
            $subscriptionEndDate = null;
        }
        // Pass the user and folder count to the view
        return view('admin.account', [
            'user' => $user,
            'folderCount' => $folderCount,
            'subscriptionEndDate' => $subscriptionEndDate,
        ]);
    }


    public function toggleRenewStatus($userId)
    {
        // Find the user
        $user = User::findOrFail($userId);

        // Toggle renew_status field
        $user->renew_status = $user->renew_status == "1" ? "0" : "1";
        $user->save();

        return redirect()->back()->with('status', 'Renew status updated successfully.');
    }


}

