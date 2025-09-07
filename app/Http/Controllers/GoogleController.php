<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Google\Client;
use Google\Service\Drive;

class GoogleController extends Controller
{
    public function loginWithGoogle() 
    {
       return Socialite::driver('google')->redirect();
   
    }

    protected function authenticated(Request $request, $user)
    {
        // Redirect to Google Drive after successful login
        return redirect()->route('google.drive');
    }

    public function accessGoogleDrive()
    {
        $user = Auth::user();
        $accessToken = $user->google_drive_access_token;
    
        // Set up the Google Drive PHP client
        $client = new Client();
        $client->setAccessToken($accessToken);
        // dd($client);
    
        // Create a Google Drive service instance
        $driveService = new Drive($client);
        
        // Call the API to get a list of files
        $files = $driveService->files->listFiles(['fields' => 'files(name, id, mimeType)']);
        dd($files);
        // Process the API response
        $filesList = $files->getFiles();
    
        // Return a view with the user's Google Drive files
        return view('google_drive', ['files' => $filesList]);
    }

    public function callbackFromGoogle() 
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
                        'google_drive_access_token' => $user->token, // Save the access token to the database
                    ]
                );
            } else {
                $existingUser->update(['google_id' => $user->getId(), 'google_drive_access_token' => $user->token]);
                $saveUser = $existingUser;
            }

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('google.drive'); // Redirect to Google Drive access page
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
