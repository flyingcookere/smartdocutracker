<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Models\DocumentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\MailableName;
use App\Mail\Nudge;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class DocumentLogController extends Controller
{
    
      // Update document status
      public function updateStatus(Request $request, $uuid)
      {    
        $validate = $request->validate([
            'recipient' => 'required|string|max:255',
            'recipient_email' => 'required|email|max:255',
            'recipient_dept' => 'required|string|max:255',
            'status' => 'required|in:Pending,Processing,Done,Returned',
            'remarks' => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
          
        try {
                $document = Document::where('uuid', $uuid)->firstOrFail();
                
                $lastTouch = DocumentLog::where('uuid', $uuid)->latest()->first();
                $logs = DocumentLog::create([
                    'uuid' => $document->uuid,
                    'title' => $document->title,
                    'sender' => $document->sender,
                    'sender_email' => $document->sender_email,
                    'sender_dept' => $document->sender_dept,
                    'sender_id' => $document->sender_id,
                    'recipient' => $validate['recipient'],
                    'recipient_id' => $request->user()->id,
                    'recipient_email' => $validate['recipient_email'],
                    'recipient_dept' => $validate['recipient_dept'],
                    'communication' => $document->communication,
                    'status' => $validate['status'],
                    'remarks' => $validate['remarks'],
                ]);
                
                //debugging algorithm to test if lastTouch is one update behind to the incoming log
                // echo "Last Touch sender: ". $lastTouch->sender_email . "<br>";
                // echo "Last Touch email: ". $lastTouch->recipient_email . "<br>";
                // echo "Future recipient's email: ". $logs['recipient_email'] . "<br>";
                
                DB::commit();
                if($logs['sender_id'] === $logs['recipient_id']){
                  Mail::to($lastTouch->recipient_email)->cc($document->sender_email)->send(new MailableName($logs));
                } else{ 
                  Mail::to($document->sender_email)->cc($logs['recipient_email'])->send(new MailableName($logs));
                }
                
                return redirect()->route('document.logs', ['uuid' => $logs->uuid]);
                // return redirect()->route('document.logs', $logs->uuid)->with('success', 'Document status updated successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Failed to log changes', 'message' => $e->getMessage()], 500);
            }
      }

      public function showLogsEdit($uuid){
        $logs = DocumentLog::orderByDesc('created_at')
        ->where('uuid', $uuid)
        ->get();
        if ($logs->isEmpty()) {
            return redirect()->route('document.logs')->with('error', 'No logs found for this document.');
        }
        return view('document.logs', compact('logs'));
      }

      public function showLogFromSearch(Request $request)
      {
        $validate = $request->validate([
            'uuid' => 'required|string|max:255',
        ]);
        $logs = DocumentLog::orderByDesc('created_at')->where('uuid', $validate['uuid'])->get();

        if( $logs->isEmpty()) {
            return redirect()->route('document.logs')->with('error', 'No logs found for this document.');
        }
        return view('document.logs',['uuid' => $validate['uuid']] ,compact('logs'))->with('success', 'Logs found for this document.');
      }

      public static function nudgeDocument(){
        $logs = DocumentLog::select('document_logs.*')
          ->whereIn('id', function ($query) {
              $query->selectRaw('MAX(id)')
                    ->from('document_logs')
                    ->groupBy('uuid');
          })
          ->where('sender', Auth::user()->name)
          ->get();
          
          $needsNotification = [];
          foreach($logs as $log){
            if(in_array($log->status, ['Pending','Returned'])){
              $needsNotification[] = $log;
            }
          }
          foreach($needsNotification as $item){
              $document = Document::where('uuid',$item['uuid'])->firstOrFail();
              $timediff = abs(Carbon::now()->diffInDays(date: $document->last_nudge_sent_at));
              $statusTimeDiff = abs(Carbon::now()->diffInDays($item['created_at']));
              
              $isOnCooldown = $timediff <= 1.00 && $document->last_nudge_sent_at;
              $isRecipientIsSender = $item['sender_id'] === $item['recipient_id'];
              
              if($isOnCooldown || $isRecipientIsSender){
                continue;
              }
              
              $threeDays = 3.00;
              $isOverDue = $statusTimeDiff >= $threeDays;
              if ($isOverDue) {
                if($item['recipient_dept']===''){ 
                  Mail::to($item['sender_email'])->cc(self::fetchEmailAddressFrom($item['sender_dept']))->send(new Nudge($item));
                } else{
                  Mail::to($item['sender_email'])->send(new Nudge($item));
                }
                $document->update(['last_nudge_sent_at' => now()]);
                $document->save();

                // echo "<p>There is an overdue</p>";
                // echo $item->title;
                // echo $item ->status;
              } 
          }
        return view('dashboard');
    
      }
      public function view($uuid){
        $document = Document::where('uuid', $uuid)->firstOrFail();
        $log = DocumentLog::where('uuid', $uuid)->latest()->first();
        return view('document.view', compact('document', 'log')); 
    }

    public static function fetchEmailAddressFrom($department){
      $users = User::where('department', $department)
      ->where('email', '!=', Auth::user()->email)
      ->get();
      $userEmails = array();
      foreach ($users as $user) {
          $userEmails[] = $user->email;
      }
      return $userEmails;
    }
}
