<?php

// use App\Http\Controllers\Admin\AlbumController;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserPayment;
use App\Models\CreateFolder;
use Illuminate\Http\Request;
use Session;
use Stripe;
     
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AlbumController extends Controller
{

    public $gClient;

    function __construct(){
        
        $this->gClient = new \Google_Client();
        
        
        $this->gClient->setApplicationName('snapshot'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId('1021502306713-dlnt415occ7pi1g5gf47bemggb9m3fnf.apps.googleusercontent.com');
        $this->gClient->setClientSecret('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');
        $this->gClient->setRedirectUri(route('google.login'));
        $this->gClient->setDeveloperKey('AIzaSyBILqtwxn5e7RExbFibozAatwyHSAuNS4c');
        $this->gClient->setScopes(array(               
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/userinfo.email'
        ));
        
        $this->gClient->setAccessType('offline'); // Access type offline for refresh token
        $this->gClient->setApprovalPrompt('force'); // Force approval prompt
        $this->gClient->setPrompt('consent'); // Force consent screen to get refresh token
      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = CreateFolder::Where('folder_id', $id)->first();
        $user_payments = UserPayment::all();
        // dd($user_payments);
        // dd($folder);
        return view('admin.album.upload', compact('folder', 'user_payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        // return view('admin.album.customimage');

        $folders = CreateFolder::where('user_id', auth()->id())->get();
        return view('admin.album.customimage', compact('folders'));
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
        // Validate the form data
        $request->validate([
            'custom_image' => 'image|mimes:jpeg,png,jpg,gif', // Maximum size of 2MB
            'folder_id' => 'required|exists:create_folders,id,user_id,' . Auth::id(),
        ]);

        // Find the folder based on the selected option value
        $folderId = $request->folder_id;
        $user = CreateFolder::findOrFail($folderId);

    // Check if an image was uploaded
    if ($request->hasFile('custom_image')) {
        // Get the uploaded file
        $uploadedImage = $request->file('custom_image');

        // Generate a unique name for the image
        $imageName = uniqid() . '.' . $uploadedImage->getClientOriginalExtension();

        // Move the uploaded image to the storage directory
        $uploadedImage->storeAs('custom_images', $imageName, 'public');
        $uploadedImage->move(public_path('uploads/'), $imageName);

        // Update the user's custom_image field
        $user->custom_image = $imageName;
        $user->save();
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Custom image uploaded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     // dd($id);

    //     $folder = CreateFolder::find($id);
    //     if (!$folder) {
    //         return redirect()->back()->with('error', 'Folder not found.');
    //     }
    //     // Delete the folder
    //     $folder->delete();
        
    //     return redirect()->back()->with('success', 'Folder deleted successfully.');
    // }

    // below method delete file by file

    public function destroy($id)
    {
        $folder = CreateFolder::find($id);
        if (!$folder) {
            return redirect()->back()->with('error', 'Folder not found.');
        }
    
        $user = User::where('id', $folder->user_id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        $this->gClient->setAccessToken(json_decode($user->access_token, true));
        $service = new \Google_Service_Drive($this->gClient);
    
        if ($this->gClient->isAccessTokenExpired()) {
            $this->gClient->fetchAccessTokenWithRefreshToken($user->refresh_token);
            $newAccessToken = $this->gClient->getAccessToken();
            if (!isset($newAccessToken['refresh_token'])) {
                $newAccessToken['refresh_token'] = $user->refresh_token;
            }
            $user->access_token = json_encode($newAccessToken);
            $user->save();
            $this->gClient->setAccessToken($newAccessToken);
        }
    
        try {
            $folderId = $folder->folder_id;
    
            // List and delete all files in the folder
            $optParams = [
                'q' => "'" . $folderId . "' in parents",
                'fields' => 'files(id)',
            ];
            $results = $service->files->listFiles($optParams);
            foreach ($results->getFiles() as $file) {
                try {
                    $service->files->delete($file->getId());
                } catch (\Google_Service_Exception $e) {
                    // Log or report error for individual file
                }
            }
    
            // Delete the folder from Google Drive
            $service->files->delete($folderId);
    
            // Delete the folder from the local database
            $folder->delete();
    
            return redirect()->back()->with('success', 'Folder and its contents deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting folder from Google Drive: ' . $e->getMessage());
        }
    }
    
    
    // below method delete complete folder at once


    // public function destroy($id)
    // {
    //     // Find the folder in the local database
    //     $folder = CreateFolder::find($id);
    //     if (!$folder) {
    //         return redirect()->back()->with('error', 'Folder not found.');
    //     }

    //     // Set up the Google Drive service
    //     $user = User::where('id', $folder->user_id)->first();
    //     $this->gClient->setAccessToken(json_decode($user->access_token, true));
    //     $service = new \Google_Service_Drive($this->gClient);

    //     // Check and refresh the access token if it's expired
    //     if ($this->gClient->isAccessTokenExpired()) {
    //         $this->gClient->fetchAccessTokenWithRefreshToken($user->refresh_token);
    //         $newAccessToken = $this->gClient->getAccessToken();
    //         if (!isset($newAccessToken['refresh_token'])) {
    //             $newAccessToken['refresh_token'] = $user->refresh_token;
    //         }
    //         $user->access_token = json_encode($newAccessToken);
    //         $user->save();
    //         $this->gClient->setAccessToken($newAccessToken);
    //     }

    //     try {
    //         // Delete the folder from Google Drive
    //         $service->files->delete($folder->folder_id);

    //         // Delete the folder from the local database
    //         $folder->delete();

    //         return redirect()->back()->with('success', 'Folder deleted successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Error deleting folder from Google Drive: ' . $e->getMessage());
    //     }
    // }


    // public function gallery ($folder_id, $user_id)
    // {
    //     // dd($user_id);
    //     $folder = CreateFolder::Where('folder_id', $folder_id)->first();
    //     if (!$folder) {
    //         // If the folder doesn't exist, show a message
    //         return redirect('/')->with('error', 'This folder does not exist on our server.');
    //     }

    //     $user = User::where('id', $user_id)->first();

    //     if (!$user) {
    //         // If the user doesn't exist, redirect to the home page with an error message
    //         return redirect('/')->with('error', 'This user does not exist on our server.');
    //     }

    //     $user_payments = UserPayment::all();
    //     return view('admin.album.gallery', compact('user_payments', 'folder', 'user_id' ));

    // }


    public function gallery($folder_id, $user_id)
    {
        $folder = CreateFolder::where('folder_id', $folder_id)->first();
        if (!$folder) {
            return redirect('/')->with('error', 'This folder does not exist on our server.');
        }
    
        $user = User::where('id', $user_id)->first();
        if (!$user) {
            return redirect('/')->with('error', 'This user does not exist on our server.');
        }
    
        // Initialize Google Drive service
        $this->gClient->setAccessToken(json_decode($user->access_token, true));
        $service = new \Google_Service_Drive($this->gClient);
    
        if ($this->gClient->isAccessTokenExpired()) {
            $this->gClient->fetchAccessTokenWithRefreshToken($user->refresh_token);
            $newAccessToken = $this->gClient->getAccessToken();
            if (!isset($newAccessToken['refresh_token'])) {
                $newAccessToken['refresh_token'] = $user->refresh_token;
            }
            $user->access_token = json_encode($newAccessToken);
            $user->save();
            $this->gClient->setAccessToken($newAccessToken);
        }
    
        // Retrieve all files from Google Drive folder with pagination
        $files = collect();
        $pageToken = null;
    
        do {
            $optParams = [
                'q' => "'" . $folder_id . "' in parents and trashed=false",
                'fields' => 'nextPageToken, files(id, name, mimeType, webViewLink)',
                'pageToken' => $pageToken,
            ];
    
            $results = $service->files->listFiles($optParams);
            $files = $files->merge($results->getFiles());
            $pageToken = $results->getNextPageToken();
        } while ($pageToken);
    
        $user_payments = UserPayment::all();
    
        return view('admin.album.gallery', compact('user_payments', 'folder', 'user_id', 'files'));
    }
    
    

   
}
