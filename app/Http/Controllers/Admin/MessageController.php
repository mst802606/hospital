<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Patient;
use App\Notifications\PatientMessageNotification;
use Illuminate\Http\Request;

class MessageController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $messages = Messages::where('doctor_id', auth()->id())->orWhere('doctor_id', null)->orderBy('created_at', 'DESC')->orderBy('doctor_id', 'ASC')->get();
        $messagesdata['messages'] = $messages;
        $messagesdata['message'] = $messages->where('doctor_id', auth()->id())->first();
        return view('admin.messages.messages', compact('messagesdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $messages = Messages::all();
        $messagesdata['messages'] = $messages;
        return view('admin.messages.index', compact('messagesdata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    //  dd( $request->all());
        $result = Messages::create(
            $request->all(),
        );
        if (!$result)
            return back()->with('Sorry! We could not send your message');

        $this->sendNotification($result);

        return redirect(route('admin.messages.index'))->with('Success! Message sent. Await response');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Messages::where('id', $id)->orderBy('created_at', 'ASC')->with('patient.user')->first();
        $messages = Messages::where('doctor_id', auth()->id())->orWhere('doctor_id', null)->orderBy('created_at', 'DESC')->orderBy('doctor_id', 'ASC')->get();
        $messagesdata['messages'] = $messages;
        $messagesdata['message'] = $message;
        return view('admin.messages.messages', compact('messagesdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //
        $response = array(
            "key" => "Admin",
            "message" => $request->text_reply,
            "time" => now(),
        );
        $message = Messages::where('id', $id)->first();
        $replies = array();
        if ($message->replies) {
            $replies = json_decode($message->replies);
        }
        array_push($replies, $response);
        $replies = json_encode($replies);
        $result = $message->update(
            [
                'replies' => $replies
            ],
        );
        if (!$result)
            return back()->with('error', 'Message cannot be sent');

        $this->sendNotification($message);
        return redirect(route('admin.messages.show', ['message' => $id]))->with('success', 'Message sent');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result = Messages::destroy($id);
        if (!$result)
            return back()->with('error', 'This item could not be deleted');
        return redirect(route('admin.messages.index'))->with('success', 'This item has been deleted successfully');
    }

    public function sendNotification($message)
    {
        if ($message->patient_id) {
           // dd("patient");
            $this->notifyPatient($message->patient_id, $message);
        } else {

            $this->notifyPatients($message);
        }

        return true;
    }

    public function notifyPatient($patient_id, $message)
    {
        $patient = Patient::where('id', $patient_id)->with('user')->first();
        $patient->user->notify(new PatientMessageNotification($message));
        return true;
    }

    public function notifyPatients($message)
    {
        # code...
        $patients = Patient::with('user')->get();
        foreach ($patients as $patients) {
            // dd($patients->user);
            $patients->user->notify(new PatientMessageNotification($message));
        }
        return true;
    }
}
