<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\DocumentLog;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validate(
            ['name' => ['required', 'string', 'max:255'],
                    'department' => ['string', 'max:255'],
                    'email' => ['required', 'email', 'max:255']
            ]
        );

        if($request->user()->hasVerifiedEmail()){
            $request->user()->fill($validatedData);
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
            
            $document = Document::where('sender_id', $request->user()->id)->get();
            $documentLog = DocumentLog::where('sender_id', $request->user()->id)->get();

            foreach ($document as $doc) {
                $doc->update([
                    'sender' => $validatedData['name'],
                    'sender_email' => $validatedData['email'],
                ]);
            }
            foreach ($documentLog as $docLog) {
                $docLog->update([
                    'sender' => $validatedData['name'],
                    'sender_email' => $validatedData['email'],
                ]);
            }

        
            $documentLog = DocumentLog::where('recipient_id', $request->user()->id)->get();
            
            foreach ($documentLog as $docLog) {
                $docLog->update([
                    'recipient' => $validatedData['name'],
                    'recipient_email' => $validatedData['email'],
                ]);
            } 
            
            $request->user()->save();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }

        return Redirect::route('profile.edit')->with('error', 'You need a verified email address to update your profile.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    DB::beginTransaction();
    try {
        // Delete all documents and logs associated with the user
        $documents = Document::where('sender_id', $user->id)->get();
        foreach ($documents as $doc) {
            $doc->delete();
        }

        DocumentLog::where('sender_id', $user->id)
            ->orWhere('recipient_id', $user->id)
            ->delete();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        DB::commit();

        return Redirect::to('/');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Failed to delete the account: ' . $e->getMessage());
    }
}

}
