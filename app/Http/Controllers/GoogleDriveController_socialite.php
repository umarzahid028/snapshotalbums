<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Google\Client;
use Google\Service\Drive;
use Google_Client;
use Google_Service_Drive;


class GoogleDriveController extends Controller
{
    public function googleLogin()
{
    return Socialite::driver('google')->redirect();
}

public function googleCallback()
{
   try {

        session()->forget('state');

        $user = Socialite::driver('google')->stateless()->user();

        $existingUser = User::where('email', $user->getEmail())->first();
        
        if (!$existingUser) {
            $saveUser = User::updateOrCreate(
                [
                    'google_id' => $user->getId(),
                ],
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName() . '@' . $user->getId()),
                    'access_token' => $user->token, // Save the access token to the database
                ]
            );
        } else {
            $existingUser->update(['google_id' => $user->getId(), 'access_token' => $user->token]);
            $saveUser = $existingUser;
        }
        if ($saveUser->access_token) {
            // Authenticating Google Drive API
            $client = new Google_Client();

            // Explicitly set the scopes
            $scopes = [
                'https://www.googleapis.com/auth/userinfo.profile',
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/drive.file',
            ];
          $client->setScopes($scopes);

    $client->setAccessToken($saveUser->access_token);

    // Get the scopes from the access token
    $accessTokenScopes = isset($saveUser->access_token['scope'])
        ? explode(' ', $saveUser->access_token['scope'])
        : [];

    // Check if the required scopes are present in the token
    $missingScopes = array_diff($scopes, $accessTokenScopes);

    if (empty($missingScopes)) {
        // All required scopes are present
        dd('User has access to required scopes.');
    } else {
        // Some required scopes are missing
        dd('User is missing the following required scopes:', $missingScopes);
    }

    // Check if the user has access to Google Drive
    $driveService = new Google_Service_Drive($client);
    try {
        $files = $driveService->files->listFiles();
        dd('User has access to Google Drive.');  // User has access
    } catch (\Google_Service_Exception $e) {
        dd('User does not have access to Google Drive.');  // No access
    } 


            Auth::loginUsingId($saveUser->id);
            return view('admin.dashboard');
        }
        // return redirect()->route('google.drive'); // Redirect to Google Drive access page
    } catch (\Throwable $th) {
        throw $th;
    }
}

public function googleDriveFileUpload()
{
    // Your existing code for file upload using Google Drive
}

}