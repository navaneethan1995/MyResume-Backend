<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'details' => 'required|string',
            'icon' => 'required|string',
        ]);

        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Prepare the data for the email
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        try {
            
            Mail::to('navanee7531@gmail.com')  
                ->send(new ContactMessage($data));  

            return response()->json(['message' => 'Message sent successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send message. Please try again.',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function show($id)
    {
        return Contact::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->only(['type', 'details', 'icon']));
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
