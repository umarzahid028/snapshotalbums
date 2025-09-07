<?php

namespace App\Http\Controllers;

use App\Models\CreateFolder;
use App\Models\User;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google\Service\CloudRun\Route;
use Illuminate\Http\Request;
use App\Models\UserPayment;

use Google_Service_Drive_Permission;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

class GoogleDriveController extends Controller
{
    public $gClient;

    function __construct(){
        
        $this->gClient = new \Google_Client();
        
        
        $this->gClient->setApplicationName('snapshot'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId('1021502306713-dlnt415occ7pi1g5gf47bemggb9m3fnf.apps.googleusercontent.com');
        $this->gClient->setClientSecret('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');
        $this->gClient->setRedirectUri(route('google.callback'));
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
    
 
    public function googleLogin(Request $request) {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
    
        // Ensure to set access type to offline to get the refresh token
        $this->gClient->setAccessType('offline');
        $this->gClient->setApprovalPrompt('force');
        \Log::info('Google redirect URI is: ' . $this->gClient->getRedirectUri());

    
        $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
    
        if ($request->get('code')) {
            // $this->gClient->authenticate($request->get('code'));
            // $token = $this->gClient->getAccessToken();
    
            // $request->session()->put('token', $token);
            // $request->session()->put('refresh_token', $this->gClient->getRefreshToken());
            try {
                $this->gClient->authenticate($request->get('code'));
                $token = $this->gClient->getAccessToken();
                $request->session()->put('token', $token);
                $request->session()->put('refresh_token', $this->gClient->getRefreshToken());
            } catch (\Exception $e) {
                Log::error('Google Auth Error: ' . $e->getMessage());
                return redirect('/')->with('error', 'Failed to authenticate with Google. Please try again.');
            }
        }
    
        if ($request->session()->get('token')) {
            $this->gClient->setAccessToken($request->session()->get('token'));
        }
    
        if ($this->gClient->getAccessToken()) {
            // Get the user's profile information
            $googleUserInfo = $google_oauthV2->userinfo->get();
            $googleUserId = $googleUserInfo->getId();
            $googleUserEmail = $googleUserInfo->getEmail();
            $googleUserName = $googleUserInfo->getName();
    
            $user = User::where('google_id', $googleUserId)->first();
    
            if (!$user) {
                // If user does not exist, create a new user
                $user = User::create([
                    'google_id' => $googleUserId,
                    'name' => $googleUserName,
                    'email' => $googleUserEmail,
                ]);
            }
    
            // Get the access token and refresh token
            $accessToken = $this->gClient->getAccessToken();
            $refreshToken = $this->gClient->getRefreshToken();
    
            // Include the refresh token in the access token array if available
            if ($refreshToken) {
                $accessToken['refresh_token'] = $refreshToken;
            } else {
                // Get refresh token from session if it's not available directly
                $refreshToken = $request->session()->get('refresh_token');
                if ($refreshToken) {
                    $accessToken['refresh_token'] = $refreshToken;
                }
            }
    
            // Debugging to check tokens
            // dd($accessToken, $this->gClient->isAccessTokenExpired());
    
            // Update user's access token and save
            $user->access_token = json_encode($accessToken);
            $user->refresh_token = $refreshToken; // Store refresh token separately
            $user->save();
    
            Auth::login($user);
            $user = Auth::user();
    
            // Retrieve folders associated with the user
            $user_payments = UserPayment::where('user_id', $user->id)->get();
            $folders = CreateFolder::where('user_id', $user->id)->get();
            return view('admin.dashboard', compact('folders', 'user', 'user_payments')); // Redirect to the admin dashboard
        } else {
            // Handle the case when access token is not available
            // Redirect the user to the Google login URL
            $authUrl = $this->gClient->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }
    
    
    
    
    
 public function googleCallback(Request $request)
{
    // You can replace this with your real Google login logic later
    return redirect('/dashboard'); // or wherever you want to send the user after login
}

    
    


    // public function googleLogin(Request $request)  {
        
    //     if (Auth::check()) {
    //         return redirect('/dashboard');
    //     }

    //       // Ensure to set access type to offline to get the refresh token
    //         $this->gClient->setAccessType('offline');
    //         $this->gClient->setApprovalPrompt('force');
                
    //     $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);

    //     if ($request->get('code')){

    //         $this->gClient->authenticate($request->get('code'));

    //         $request->session()->put('token', $this->gClient->getAccessToken());
            
    //     }

    //     if ($request->session()->get('token')){

    //         $this->gClient->setAccessToken($request->session()->get('token'));
    //     }
      
    //     if ($this->gClient->getAccessToken()) {
    //       // Get the user's profile information
    //     $googleUserInfo = $google_oauthV2->userinfo->get();

    //     $googleUserId = $googleUserInfo->getId();
    //     $googleUserEmail = $googleUserInfo->getEmail();
    //     $googleUserName = $googleUserInfo->getName();

    //         $user = User::where('google_id', $googleUserId)->first();
        
    //         if (!$user) {
    //             // If user does not exist, create a new user
    //             $userEmail = $google_oauthV2->userinfo->get()->getEmail();
    //             $user = User::create([
    //                 'google_id' => $googleUserId,
    //                 'name' => $googleUserName, // Set a default name
    //                 'email' => $googleUserEmail, // Use the user's email
    //                 // Other user fields as needed
    //             ]);
    //         }
        

    //     // Get the access token and refresh token
    //     $accessToken = $this->gClient->getAccessToken();
    //     $refreshToken = $this->gClient->getRefreshToken();

    //     // Include the refresh token in the access token array if available
    //     if ($refreshToken) {
    //         $accessToken['refresh_token'] = $refreshToken;
    //     }

    //     $isAgainExpired = $this->gClient->isAccessTokenExpired(); // still true (expired)

    //     dd($accessToken);
    //     // Update user's access token and save
    //     $user->access_token = json_encode($accessToken);
    //     $user->save();

    //         // // Update user's access token and save
    //         // $user->access_token = json_encode($request->session()->get('token'));
    //         // $user->save();


        
    //         Auth::login($user);

    //         $user = Auth::user();

    //         // Retrieve folders associated with the user
    //         $user_payments = UserPayment::where('user_id', $user->id)->get();
    //         $folders = CreateFolder::where('user_id', $user->id)->get();
    //         // dd($folders);
    //         return view('admin.dashboard', compact('folders', 'user', 'user_payments')); // Redirect to the admin dashboard
    //     } else {
    //         // Handle the case when access token is not available
    //         // Redirect the user to the Google login URL
    //         $authUrl = $this->gClient->createAuthUrl();
    //         return redirect()->to($authUrl);
    //     }
    // }

    public function googleDriveCreateFolder(Request $request)
    {
        // dd($request);
        $user = Auth::user(); // Get the authenticated user

        $userPaymentExists = UserPayment::where('user_id', $user->id)->exists();

        $folderCount = CreateFolder::where('user_id', $user->id)->count();
 
        if (!$userPaymentExists && $folderCount >= 1) {
             return redirect()->back()->with('error', 'Creating a second album requires upgrading to a paid account. Would you like to upgrade?');
         }

        $service = new \Google_Service_Drive($this->gClient);
        
        $accessToken = json_decode($user->access_token, true); // Get the access token from the user's database record
        
        if ($accessToken) {
            $this->gClient->setAccessToken($accessToken);
        
            if ($this->gClient->isAccessTokenExpired()) {
                // If the access token is expired, refresh it using the refresh token
                $refreshToken = $this->gClient->getRefreshToken();
        
                if ($refreshToken) {
                    $this->gClient->fetchAccessTokenWithRefreshToken($refreshToken);
                    $accessToken = $this->gClient->getAccessToken();
                    $user->access_token = json_encode($accessToken);
                    $user->save();
                } else {
                    // Handle the case when refresh token is not available
                }
            }
        
            // Now you can use the authenticated Google_Service_Drive instance to create a folder or perform other actions
            $folderName = $request->folder_name;
            $folderMetadata = new \Google_Service_Drive_DriveFile([
                'name' => $folderName,
                'mimeType' => 'application/vnd.google-apps.folder',
            ]);
        
            $createdFolder = $service->files->create($folderMetadata, ['fields' => 'id']);
            $folderId = $createdFolder->id;

            $create_folder = new CreateFolder();
            $create_folder->event_title = $request->input('event_title');
            $create_folder->folder_id = $folderId; // Store the Google Drive folder ID
            $create_folder->folder_name = $folderName; // Store the Google Drive folder ID

            $create_folder->date_of_event = $request->input('date_of_event'); // Make sure to use 'input' method
            $create_folder->user_id = Auth::user()->id;

            // Save the record
            $create_folder->save();

            $success = $this->makeFolderPublic($folderId);

            // dd($folderId);
            return redirect('/dashboard')->with('success', 'Folder created successfully!');
            // Do something with the folder ID
        } else {
            // Handle the case when access token is not available
            return redirect()->back()->with('error', 'You are not Authenticated!');
        }
    }

    private function makeFolderPublic($folderId)
{
    // Create a new Google Drive service instance
    $service = new Google_Service_Drive($this->gClient);

    // Set permissions to allow anyone with the link to edit or upload files
    $permission = new Google_Service_Drive_Permission([
        'type' => 'anyone',
        'role' => 'writer', // This allows anyone with the link to edit/upload files
    ]);

    try {
        $service->permissions->create($folderId, $permission);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

    public function googleDriveFileUpload(Request $request)
    {
        // dd($request);
        // Get the authenticated user
        $user = Auth::user();

        // Set the user's access token
        $accessToken = json_decode($user->access_token, true);
        
        // dd($accessToken);
        $this->gClient->setAccessToken($accessToken);
    
        // Initialize the Google Drive service
        $service = new \Google_Service_Drive($this->gClient);

        // Get the folder ID from the form input
        $folderId = $request->input('folder_id');

        // Check if the access token is expired
        if ($this->gClient->isAccessTokenExpired()) {
            // Refresh the access token
            $refreshToken = $this->gClient->getRefreshToken();
            $newAccessToken = $this->gClient->fetchAccessTokenWithRefreshToken($refreshToken);
            // dd($newAccessToken);

            // Update the user's access token in the database
            $user->access_token = json_encode($newAccessToken);
            $user->save();

            // Set the new access token
            $this->gClient->setAccessToken($newAccessToken);
        }

        foreach ($request->file('uploaded_files') as $file) {
            // Set the file metadata for Google Drive
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$folderId], // Set the folder ID as the parent
            ]);

            // Upload the file
           $service->files->create(
            $fileMetadata,
            [
                'data' => file_get_contents($file),
                'mimeType' => $file->getClientMimeType(),
                'uploadType' => 'multipart',
            ]
        );

            // Store the file locally (if needed)
        $fileName = Str::slug($request->name, '-') . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads', $fileName);
        $file->move(public_path('uploads/'), $fileName);

        // Update the CreateFolder record with the new image (if needed)
        if ($request->has('id')) {
            $id = $request->id;
            $folder = CreateFolder::findOrFail($id);
            $existingImages = $folder->images ? explode(',', $folder->images) : [];
            $existingImages[] = $fileName; // Add the new file to existing images
            $uniqueImageNames = array_unique($existingImages);
            $commaSeparatedFileNames = implode(',', $uniqueImageNames);
            $folder->images = $commaSeparatedFileNames;
            $folder->save();
        }
             
            
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }


    // public function Upload($folder_id, $user_id)
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
        
    //     // dd($folder);
    //         $user_payments = UserPayment::all();
    //         // dd($user_payments);
    //         // dd($folder);
    //         return view('admin.album.upload_out_side', compact('folder','user_payments','user_id'));
    // }


    public function Upload($folder_id, $user_id)
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
    
        return view('admin.album.upload_out_side', compact('folder', 'user_payments', 'user_id', 'files'));
    }
    


// final dynamic code for outside uploading


public function googleDriveFileUploadOutSide(Request $request)
{
    // Get the folder ID from the request input
    $folderId = $request->input('folder_id');

    // Retrieve the CreateFolder model using the folder ID
    $folder = CreateFolder::where('folder_id', $folderId)->firstOrFail();

    // Get the user_id from the CreateFolder model
    $userId = $folder->user_id;

    // Retrieve the user using the user_id
    $user = User::findOrFail($userId);


    // Set the user's access token
    $accessToken = json_decode($user->access_token, true);
    $this->gClient->setAccessToken($accessToken);

    // Initialize the Google Drive service
    $service = new \Google_Service_Drive($this->gClient);

    // Check if the access token is expired
    if ($this->gClient->isAccessTokenExpired()) {
        // Refresh the access token
        $this->gClient->fetchAccessTokenWithRefreshToken($user->refresh_token);

        // Get the new access token
        $newAccessToken = $this->gClient->getAccessToken();

        // Ensure the refresh token is included
        if (!isset($newAccessToken['refresh_token'])) {
            $newAccessToken['refresh_token'] = $user->refresh_token;
        }

        // Update the user's access token in the database
        $user->access_token = json_encode($newAccessToken);
        $user->save();

        // Set the new access token
        $this->gClient->setAccessToken($newAccessToken);
    }

    // Loop through each uploaded file and upload it to Google Drive
    foreach ($request->file('uploaded_files') as $file) {
        // Set the file metadata for Google Drive
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $file->getClientOriginalName(),
            'parents' => [$folderId], // Set the folder ID as the parent
        ]);

        // Upload the file
        $service->files->create(
            $fileMetadata,
            [
                'data' => file_get_contents($file),
                'mimeType' => $file->getClientMimeType(),
                'uploadType' => 'multipart',
            ]
        );

        // Store the file locally (if needed)
        // $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . uniqid() . '.' . $file->getClientOriginalExtension();
        // $file->storeAs('public/uploads', $fileName);
        // $file->move(public_path('uploads/'), $fileName);

        // Update the CreateFolder record with the new image (if needed)
        // if ($request->has('id')) {
        //     $id = $request->id;
        //     $existingImages = $folder->images ? explode(',', $folder->images) : [];
        //     $existingImages[] = $fileName; // Add the new file to existing images
        //     $uniqueImageNames = array_unique($existingImages);
        //     $commaSeparatedFileNames = implode(',', $uniqueImageNames);
        //     $folder->images = $commaSeparatedFileNames;
        //     $folder->save();
        // }
    }

    return redirect()->back()->with('success', 'Files uploaded successfully.');
}
  


// below is commented to test above code

// public function googleDriveFileUploadOutSide(Request $request)
// {
//     // Get the folder ID from the request input
//     $folderId = $request->input('folder_id');

//     // Retrieve the CreateFolder model using the folder ID
//     $folder = CreateFolder::where('folder_id', $folderId)->firstOrFail();

//     // Get the user_id from the CreateFolder model
//     $userId = $folder->user_id;

//     // Retrieve the user using the user_id
//     $user = User::findOrFail($userId);

//     // Set the user's access token
//     $accessToken = json_decode($user->access_token, true);
//     $this->gClient->setAccessToken($accessToken);

//     // Initialize the Google Drive service
//     $service = new \Google_Service_Drive($this->gClient);

//     // Check if the access token is expired
//     if ($this->gClient->isAccessTokenExpired()) {
//         // Refresh the access token
        
//         $refreshToken = $this->gClient->getRefreshToken();
//         $newAccessToken = $this->gClient->fetchAccessTokenWithRefreshToken($accessToken);

//         // Update the user's access token in the database
//         $user->access_token = json_encode($newAccessToken);
//         $user->save();

//         // Set the new access token
//         $this->gClient->setAccessToken($newAccessToken);
//     }

//     // Loop through each uploaded file and upload it to Google Drive
//     foreach ($request->file('uploaded_files') as $file) {
//         // Set the file metadata for Google Drive
//         $fileMetadata = new \Google_Service_Drive_DriveFile([
//             'name' => $file->getClientOriginalName(),
//             'parents' => [$folderId], // Set the folder ID as the parent
//         ]);

//         // Upload the file
//         $service->files->create(
//             $fileMetadata,
//             [
//                 'data' => file_get_contents($file),
//                 'mimeType' => $file->getClientMimeType(),
//                 'uploadType' => 'multipart',
//             ]
//         );

//         // Store the file locally (if needed)
//         $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . uniqid() . '.' . $file->getClientOriginalExtension();
//         $file->storeAs('public/uploads', $fileName);
//         $file->move(public_path('uploads/'), $fileName);

//         // Update the CreateFolder record with the new image (if needed)
//         if ($request->has('id')) {
//             $id = $request->id;
//             $existingImages = $folder->images ? explode(',', $folder->images) : [];
//             $existingImages[] = $fileName; // Add the new file to existing images
//             $uniqueImageNames = array_unique($existingImages);
//             $commaSeparatedFileNames = implode(',', $uniqueImageNames);
//             $folder->images = $commaSeparatedFileNames;
//             $folder->save();
//         }
//     }

//     return redirect()->back()->with('success', 'Files uploaded successfully.');
// }





    // below is fine with preset email after sheraz guidance
/*
public function googleDriveFileUploadOutSide(Request $request)
{
    // Retrieve the user with the specified email
    $user = User::where('email', 'jaccyparvez@gmail.com')->firstOrFail();

    // Set the user's access token
    $accessToken = json_decode($user->access_token, true);
    $this->gClient->setAccessToken($accessToken);

    // Initialize the Google Drive service
    $service = new \Google_Service_Drive($this->gClient);

    // Get the folder ID from the request input
    $folderId = $request->input('folder_id');

    // Check if the access token is expired
    if ($this->gClient->isAccessTokenExpired()) {
        // Refresh the access token
        $refreshToken = $this->gClient->getRefreshToken();
        $newAccessToken = $this->gClient->fetchAccessTokenWithRefreshToken($refreshToken);

        // Update the user's access token in the database
        $user->access_token = json_encode($newAccessToken);
        $user->save();

        // Set the new access token
        $this->gClient->setAccessToken($newAccessToken);
    }

    // Loop through each uploaded file and upload it to Google Drive
    foreach ($request->file('uploaded_files') as $file) {
        // Set the file metadata for Google Drive
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $file->getClientOriginalName(),
            'parents' => [$folderId], // Set the folder ID as the parent
        ]);

        // Upload the file
        $service->files->create(
            $fileMetadata,
            [
                'data' => file_get_contents($file),
                'mimeType' => $file->getClientMimeType(),
                'uploadType' => 'multipart',
            ]
        );

        // Store the file locally (if needed)
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads', $fileName);
        $file->move(public_path('uploads/'), $fileName);

        // Update the CreateFolder record with the new image (if needed)
        if ($request->has('id')) {
            $id = $request->id;
            $folder = CreateFolder::findOrFail($id);
            $existingImages = $folder->images ? explode(',', $folder->images) : [];
            $existingImages[] = $fileName; // Add the new file to existing images
            $uniqueImageNames = array_unique($existingImages);
            $commaSeparatedFileNames = implode(',', $uniqueImageNames);
            $folder->images = $commaSeparatedFileNames;
            $folder->save();
        }
    }

    return redirect()->back()->with('success', 'Files uploaded successfully.');
}
*/



// with service account

//     public function googleDriveFileUploadOutSide(Request $request)
//     {

        
//         // Get the folder ID from the form input
//         $folderId = $request->input('folder_id');
//         $ownerEmail = 'kamrannazir901@gmail.com'; // The email address of the owner

//         foreach ($request->file('uploaded_files') as $file) {
//             // Set up a Google Drive API client (you may need to install the client library)
//             $client = new \Google_Client();
    
//             // Set the path to your service account JSON key file
//             $jsonKeyPath = public_path('webuploader-corammers-2fc3bbffc6cc.json');
    
//             // Use the service account JSON key for authentication
//             $client->setAuthConfig($jsonKeyPath);

//             $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
//             // dd($jsonKeyPath);            // Create a Google Drive service
//             $service = new \Google_Service_Drive($client);
//             // dd($service);
//             // Set the file metadata for Google Drive
//             $fileMetadata = new \Google_Service_Drive_DriveFile([
//                 'name' => $file->getClientOriginalName(),
//                 'parents' => [$folderId], // Set the folder ID as the parent
//                 'mimeType' => $file->getClientMimeType(),
//             ]);
//             // dd($fileMetadata);
    
//             // // Upload the file to Google Drive
//             // $service->files->create(
//             //     $fileMetadata,
//             //     [
//             //         'data' => file_get_contents($file),
//             //         'mimeType' => $file->getClientMimeType(),
//             //         'uploadType' => 'multipart',    
//             //     ]
//             // );


//                 $uploadedFile = $service->files->create(
//                     $fileMetadata,
//                     [
//                         'data' => file_get_contents($file),
//                         'mimeType' => $file->getClientMimeType(),
//                         'uploadType' => 'multipart',
//                         'fields' => 'id'
//                     ]
//                 );

//                 // Get the file ID
//                 $fileId = $uploadedFile->id;

//                 // Create a permission for the new owner
//                 $permission = new \Google_Service_Drive_Permission();
//                 $permission->setRole('owner');
//                 $permission->setType('user');
//                 $permission->setEmailAddress($ownerEmail);

//                 // Add permission to the file
//                 $service->permissions->create($fileId, $permission, [
//                     'fields' => 'id',
//                     'transferOwnership' => 'true'
//                 ]);

//                 // Optionally, list all permissions to find and remove the service account’s permission
//                 $permissions = $service->permissions->listPermissions($fileId, [
//                     'fields' => 'permissions(id,emailAddress,role)'
//                 ]);

//                 foreach ($permissions->getPermissions() as $perm) {
//                     if ($perm->getEmailAddress() === 'weduploader@webuploader-corammers.iam.gserviceaccount.com') {
//                         $permissionId = $perm->getId();
//                         // Remove the service account’s permission
//                         $service->permissions->delete($fileId, $permissionId);
//                     }
//   }



            // dd($service);
            // Optionally, you can store the uploaded file locally if needed
    
            // Handle any additional logic, such as updating your database
    
                // Store the file locally (if needed)
        //         $fileName = Str::slug($request->name, '-') . uniqid() . '.' . $file->getClientOriginalExtension();
        //         $file->storeAs('public/uploads', $fileName);
        //         $file->move(public_path('uploads/'), $fileName);

        //         // Update the CreateFolder record with the new image (if needed)
        //         if ($request->has('id')) {
        //             $id = $request->id;
        //             $folder = CreateFolder::findOrFail($id);
        //             $existingImages = $folder->images ? explode(',', $folder->images) : [];
        //             $existingImages[] = $fileName; // Add the new file to existing images
        //             $uniqueImageNames = array_unique($existingImages);
        //             $commaSeparatedFileNames = implode(',', $uniqueImageNames);
        //             $folder->images = $commaSeparatedFileNames;
        //             $folder->save();
        //         }
        // }
    
        // Provide a response to the user
    //     return redirect()->back()->with('success', 'Files uploaded successfully.');
    // }


// with auth token
/*
    public function googleDriveFileUploadOutSide(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Decode the user's access token from the database
        $accessToken = json_decode($user->access_token, true);
    
        // Set the access token to the Google client
        $this->gClient->setAccessToken($accessToken);
    
        // Initialize the Google Drive service
        $service = new \Google_Service_Drive($this->gClient);
    
        // Check if the access token is expired
        if ($this->gClient->isAccessTokenExpired()) {
            // Refresh the access token
            $refreshToken = $this->gClient->getRefreshToken();
            $newAccessToken = $this->gClient->fetchAccessTokenWithRefreshToken($refreshToken);
    
            // Update the user's access token in the database
            $user->access_token = json_encode($newAccessToken);
            $user->save();
    
            // Set the new access token
            $this->gClient->setAccessToken($newAccessToken);
        }
    
        // Get the folder ID from the form input
        $folderId = $request->input('folder_id');
    
        foreach ($request->file('uploaded_files') as $file) {
            // Set the file metadata for Google Drive
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => $file->getClientOriginalName(),
                'parents' => [$folderId], // Set the folder ID as the parent
                'mimeType' => $file->getClientMimeType(),
            ]);
    
            // Upload the file to Google Drive
            $service->files->create(
                $fileMetadata,
                [
                    'data' => file_get_contents($file),
                    'mimeType' => $file->getClientMimeType(),
                    'uploadType' => 'multipart',
                ]
            );
    
            // Store the file locally (if needed)
            $fileName = Str::slug($request->name, '-') . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $fileName);
            $file->move(public_path('uploads/'), $fileName);
    
            // Update the CreateFolder record with the new image (if needed)
            if ($request->has('id')) {
                $id = $request->id;
                $folder = CreateFolder::findOrFail($id);
                $existingImages = $folder->images ? explode(',', $folder->images) : [];
                $existingImages[] = $fileName; // Add the new file to existing images
                $uniqueImageNames = array_unique($existingImages);
                $commaSeparatedFileNames = implode(',', $uniqueImageNames);
                $folder->images = $commaSeparatedFileNames;
                $folder->save();
            }
        }
    
        // Provide a response to the user
        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }
*/

// auth with modify try

// public function googleDriveFileUploadOutSide(Request $request)
// {
//     // Get the authenticated user
//     // $user = Auth::user();
//     $folder = CreateFolder::where('folder_id', $request->folder_id)->firstOrFail();
    
//     $user = User::findOrFail($folder->user_id);
    
//     $accessToken = json_decode($user->access_token, true);

//     // Set the access token to the Google client
//     $this->gClient->setAccessToken($accessToken);

//     // Initialize the Google Drive service
//     $service = new \Google_Service_Drive($this->gClient);

//     // Check if the access token is expired
//     if ($this->gClient->isAccessTokenExpired()) {
//         // Refresh the access token
//         $refreshToken = $this->gClient->getRefreshToken();
//         dd($refreshToken);
//         $newAccessToken = $this->gClient->fetchAccessTokenWithRefreshToken($refreshToken);

//         // Update the user's access token in the database
//         $user->access_token = json_encode($newAccessToken);
//         $user->save();

//         // Set the new access token
//         $this->gClient->setAccessToken($newAccessToken);
//     }

//     // Get the folder ID from the form input
//     $folderId = $request->input('folder_id');

//     foreach ($request->file('uploaded_files') as $file) {
//         // Set the file metadata for Google Drive
//         $fileMetadata = new \Google_Service_Drive_DriveFile([
//             'name' => $file->getClientOriginalName(),
//             'parents' => [$folderId], // Set the folder ID as the parent
//             'mimeType' => $file->getClientMimeType(),
//         ]);

//         // Upload the file to Google Drive
//         $service->files->create(
//             $fileMetadata,
//             [
//                 'data' => file_get_contents($file),
//                 'mimeType' => $file->getClientMimeType(),
//                 'uploadType' => 'multipart',
//             ]
//         );

//         // Store the file locally (if needed)
//         $fileName = Str::slug($request->name, '-') . uniqid() . '.' . $file->getClientOriginalExtension();
//         $file->storeAs('public/uploads', $fileName);
//         $file->move(public_path('uploads/'), $fileName);

//         // Update the CreateFolder record with the new image (if needed)
//         if ($request->has('id')) {
//             $id = $request->id;
//             $folder = CreateFolder::findOrFail($id);
//             $existingImages = $folder->images ? explode(',', $folder->images) : [];
//             $existingImages[] = $fileName; // Add the new file to existing images
//             $uniqueImageNames = array_unique($existingImages);
//             $commaSeparatedFileNames = implode(',', $uniqueImageNames);
//             $folder->images = $commaSeparatedFileNames;
//             $folder->save();
//         }
//     }

//     // Provide a response to the user
//     return redirect()->back()->with('success', 'Files uploaded successfully.');
// }



    // public function googleDriveFileUploadOutSide(Request $request)
    // {
    //     try {
           
    //         // Get the folder record
    //         $folder = CreateFolder::where('folder_id', $request->folder_id)->firstOrFail();
    
    //         // Get the user based on the user_id from the folder record
    //         $user = User::findOrFail($folder->user_id);
    
    //         // Decode the user's access token from the database
    //         $accessToken = json_decode($user->access_token, true);
    
    //         // Set the access token and refresh token to the Google client
    //         $this->gClient->setAccessToken($accessToken);
    //         if (isset($accessToken['refresh_token'])) {
    //             $this->gClient->refreshToken($accessToken['refresh_token']);
    //         }
    
    //         // Initialize the Google Drive service
    //         $service = new \Google_Service_Drive($this->gClient);
    
    //         // Check if the access token is expired
    //         if ($this->gClient->isAccessTokenExpired()) {
    //             // Refresh the access token
    //             $refreshToken = $this->gClient->getRefreshToken();
    //             $newAccessToken = $this->gClient->fetchAccessTokenWithRefreshToken($refreshToken);
    
    //             // Ensure the refresh token is included in the new access token array
    //             if (!isset($newAccessToken['refresh_token'])) {
    //                 $newAccessToken['refresh_token'] = $refreshToken;
    //             }
    
    //             // Update the user's access token in the database
    //             $user->access_token = json_encode($newAccessToken);
    //             $user->save();
    
    //             // Set the new access token
    //             $this->gClient->setAccessToken($newAccessToken);
    //         }
    
    //         // Get the folder ID from the form input
    //         $folderId = $request->input('folder_id');
    
    //         foreach ($request->file('uploaded_files') as $file) {
    //             // Set the file metadata for Google Drive
    //             $fileMetadata = new \Google_Service_Drive_DriveFile([
    //                 'name' => $file->getClientOriginalName(),
    //                 'parents' => [$folderId], // Set the folder ID as the parent
    //                 'mimeType' => $file->getClientMimeType(),
    //             ]);
    
    //             // Upload the file to Google Drive
    //             $service->files->create(
    //                 $fileMetadata,
    //                 [
    //                     'data' => file_get_contents($file),
    //                     'mimeType' => $file->getClientMimeType(),
    //                     'uploadType' => 'multipart',
    //                 ]
    //             );
    
    //             // Store the file locally (if needed)
    //             $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '-') . uniqid() . '.' . $file->getClientOriginalExtension();
    //             $file->storeAs('public/uploads', $fileName);
    //             $file->move(public_path('uploads/'), $fileName);
    
    //             // Update the CreateFolder record with the new image (if needed)
    //             $existingImages = $folder->images ? explode(',', $folder->images) : [];
    //             $existingImages[] = $fileName; // Add the new file to existing images
    //             $uniqueImageNames = array_unique($existingImages);
    //             $commaSeparatedFileNames = implode(',', $uniqueImageNames);
    //             $folder->images = $commaSeparatedFileNames;
    //             $folder->save();
    //         }
    
    //         // Provide a response to the user
    //         return redirect()->back()->with('success', 'Files uploaded successfully.');
    
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('File upload failed: ' . $e->getMessage(), ['exception' => $e]);
    
    //         // Provide a response to the user
    //         return redirect()->back()->with('error', 'An error occurred while uploading files.');
    //     }
    // }
   

    // public function googleDriveFileUploadOutSide(Request $request)
    // {
    //     try {
    //         // Get the folder ID from the form input
    //         $folderId = $request->input('folder_id');
             
    //         // Get the new owner email from the form input
    //         $newOwnerEmail = "k@gmail.com";
     
    //         foreach ($request->file('uploaded_files') as $file) {
    //             // Set up a Google Drive API client
    //             $client = new \Google_Client();
    
    //             // Set the path to your service account JSON key file
    //             $jsonKeyPath = public_path('webuploader-corammers-2fc3bbffc6cc.json');
    
    //             // Use the service account JSON key for authentication
    //             $client->setAuthConfig($jsonKeyPath);
    //             $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
    
    //             // Create a Google Drive service
    //             $service = new \Google_Service_Drive($client);
    
    //             // Set the file metadata for Google Drive
    //             $fileMetadata = new \Google_Service_Drive_DriveFile([
    //                 'name' => $file->getClientOriginalName(),
    //                 'parents' => [$folderId], // Set the folder ID as the parent
    //                 'mimeType' => $file->getClientMimeType(),
    //             ]);
    
    //             // Upload the file to Google Drive
    //             $uploadedFile = $service->files->create(
    //                 $fileMetadata,
    //                 [
    //                     'data' => file_get_contents($file),
    //                     'mimeType' => $file->getClientMimeType(),
    //                     'uploadType' => 'multipart',
    //                 ]
    //             );
    
    //             // Log the uploaded file ID for debugging
    //             Log::info('Uploaded file ID: ' . $uploadedFile->id);
    
    //             // Transfer ownership to the user's email using permissions.create
    //             $newOwnerPermission = new \Google_Service_Drive_Permission([
    //                 'type' => 'user',
    //                 'role' => 'owner',
    //                 'emailAddress' => $newOwnerEmail,
    //             ]);
    
    //             $service->permissions->create($uploadedFile->id, $newOwnerPermission, ['transferOwnership' => true]);
    
    //             // Get the current permissions of the file
    //             $currentPermissions = $service->permissions->listPermissions($uploadedFile->id);
    
    //             // Find the existing permission ID for the service account
    //             $serviceAccountPermissionId = null;
    //             foreach ($currentPermissions->getPermissions() as $currentPermission) {
    //                 if ($currentPermission->getEmailAddress() === 'weduploader@webuploader-corammers.iam.gserviceaccount.com') {
    //                     $serviceAccountPermissionId = $currentPermission->getId();
    //                     break;
    //                 }
    //             }
    
    //             // If found, delete the service account's permission
    //             if ($serviceAccountPermissionId) {
    //                 $service->permissions->delete($uploadedFile->id, $serviceAccountPermissionId);
    //                 Log::info('Deleted service account permission for file ID: ' . $uploadedFile->id);
    //             } else {
    //                 // Log an error if the service account permission is not found
    //                 Log::error('Service account permission not found for file ID: ' . $uploadedFile->id);
    //             }
    
    //             // Optionally, you can store the uploaded file locally if needed
    
    //             // Handle any additional logic, such as updating your database
    
    //             // Store the file locally (if needed)
    //             $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '-') . uniqid() . '.' . $file->getClientOriginalExtension();
    //             $file->storeAs('public/uploads', $fileName);
    //             $file->move(public_path('uploads/'), $fileName);
    
    //             // Update the CreateFolder record with the new image (if needed)
    //             if ($request->has('id')) {
    //                 $id = $request->id;
    //                 $folder = CreateFolder::findOrFail($id);
    //                 $existingImages = $folder->images ? explode(',', $folder->images) : [];
    //                 $existingImages[] = $fileName; // Add the new file to existing images
    //                 $uniqueImageNames = array_unique($existingImages);
    //                 $commaSeparatedFileNames = implode(',', $uniqueImageNames);
    //                 $folder->images = $commaSeparatedFileNames;
    //                 $folder->save();
    //             }
    //         }
    
    //         // Provide a response to the user
    //         return redirect()->back()->with('success', 'Files uploaded and ownership transferred successfully.');
    //     } catch (\Google_Service_Exception $e) {
    //         // Log the error from Google Service
    //         Log::error('Google Service error: ' . $e->getMessage(), ['exception' => $e]);
    //         return redirect()->back()->with('error', 'An error occurred while uploading files to Google Drive.');
    //     } catch (\Exception $e) {
    //         // Log any other errors
    //         Log::error('File upload failed: ' . $e->getMessage(), ['exception' => $e]);
    //         return redirect()->back()->with('error', 'An error occurred while uploading files.');
    //     }
    // }
    
    
    

    



}