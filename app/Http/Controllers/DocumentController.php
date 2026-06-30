<?php

namespace App\Http\Controllers;

use App\Models\DocumentLog;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
class DocumentController extends Controller
{
    // Form to create document
    public function create()
    {
        return view('document.create');
    }

    // Store document and generate QR
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'sender_email' => 'required|string|max:255',
            'sender_dept' => 'required|string|max:255',
            'recipient_dept' => 'required|string|max:255',
            'communication' => 'required|in:IC,EC'
        ]);

        $uuid = (string) Str::uuid();
        
        DB::beginTransaction();

        try{
            $document = Document::create([
                'uuid' => $uuid,
                'title' => $validated['title'],
                'sender' => $validated['sender'],
                'sender_id' => $request->user()->id,
                'sender_email' => $validated['sender_email'],
                'sender_dept' => $validated['sender_dept'],
                'recipient_dept' => $validated['recipient_dept'],
                'communication' => $validated['communication'],
            ]);
    
     
            // Log document creation
            DocumentLog::create([
                'uuid' => $uuid,
                'title' => $validated['title'],
                'sender' => $validated['sender'],
                'sender_id' => $request->user()->id,
                'sender_email' => $validated['sender_email'],
                'sender_dept' => $validated['sender_dept'],
                'recipient_dept' => '',
                'communication' => $validated['communication'],
            ]);
            
            DB::commit();
            // Redirect to document show page
            return redirect()->route('document.show', $document->uuid);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Failed to create document', 'message' => $e->getMessage()], 500);
        }
        
    }

    // View document details by scanning QR
    public function show($uuid)
    {
        $document = Document::where('uuid', $uuid)->firstOrFail();
        $log = DocumentLog::where('uuid', $uuid)->orderByDesc('created_at')->first();

            // Generate QR pointing to document show URL
        $url = route('document.view', $document->uuid);

        $qrCode = new QrCode($url);
        
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        $qrCodeDataURI = $result->getDataUri();
        $qrCodeBinary = $result->getString();

        return view('document.show', compact('document', 'log', 'qrCodeDataURI', 'qrCodeBinary'));
    }

  
    public function showUserDocs(Request $request)
    {
        // Fetch documents for the authenticated user
        $user = $request->user();
        $documents = Document::where('sender_email', $user->email)->get();
        return view('document.myDocs', compact('documents'));
    }
    
    public function deleteEntry($uuid)
    {
        DB::beginTransaction();
        try {
        
            $document = Document::where('uuid', $uuid)->firstOrFail();
            DB::table('document_logs')->where('uuid', $uuid)->delete();

          
            $document->delete();

            DB::commit();
            return redirect()->route('document.myDocs')->with('success', 'Document deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete document', 'message' => $e->getMessage()], 500);
        }
    }
 
}
