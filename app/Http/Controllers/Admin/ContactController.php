<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(5);

        return view('admin.pages._contact', compact('messages'));
    }

    public function reply(Request $request, $id){
        $request->validate([
            'reply_message' => 'required'
        ]);
        return redirect()->back()->with('success', 'Balasan Berhasil dikirim');
    }

    public function destroy(Contact $id){
        $message = Contact::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success','Pesan Berhasil dihapus');
    }
}
