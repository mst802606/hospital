<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Messages;
use App\Notifications\DoctorMessageNotification;
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
        $messages = $this->user()->messages()->get();
        $messagesdata['messages'] = $messages;
        $messagesdata['message'] = $messages->first();
        return view('patient.messages.messages', compact('messagesdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $messages = Messages::all();
        $messagesdata['messages'] = $messages;
        return view('patient.messages.index', compact('messagesdata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //   dd( $request->all());
        $result = $this->patient()->messages()
            ->create(
                $request->all(),
            );
        if (!$result)
            return back()->with('Sorry! We could not send your message');


        $this->sendNotification($result);

        return redirect(route('patient.messages.index'))->with('Success! Message sent. Await response');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $message = Messages::where('id', $id)->with('doctor')->with('patient')->first();

        $messages = $this->user()->messages()->get();
        $messagesdata['messages'] = $messages;
        $messagesdata['message'] = $message;
        return view('patient.messages.messages', compact('messagesdata'));
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
            "key" => "patient",
            "message" => $request->text_reply,
            "time" => now(),
        );
        $message = $this->patient()->messages()->where('id', $id)->first();

        $replies = array();
        if ($message->replies) {
            $replies = json_decode($message->replies);
        }

        array_push($replies, $response);
        $replies = json_encode($replies);
        $result = $message->update(
            ['replies' => $replies],
        );

        $this->sendNotification($message);

        if (!$result)
            return back()->with('error', 'Message cannot be sent');
        return redirect(route('patient.messages.show', ['message' => $id]))->with('success', 'Message sent');
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
        return redirect(route('patient.messages.index'))->with('success', 'This item has been deleted successfully');
    }

    public function sendNotification($message)
    {
        if($message->doctor_id){
           $this->notifyDoctor($message->doctor_id,$message);
        }else{
            $this->notifyDoctors($message);
        }

        return true;
    }

    public function notifyDoctor($doctor_id, $message)
    {
       $doctor = Doctor::where('id',$doctor_id)->with('user')->first();
        $doctor->user->notify(new DoctorMessageNotification($message));
        return true;
    }

    public function notifyDoctors($message)
    {
        # code...
        $doctors = Doctor::with('user')->get();
        foreach ($doctors as $doctor) {
            // dd($doctor->user);
            $doctor->user->notify(new DoctorMessageNotification($message));
        }
        return true;
    }
}
