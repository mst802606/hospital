<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends BaseController
{
    //
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function show($id)
    {
        $notification = $this->user()->notifications()->where('id', $id)->first();
        $notification->markAsRead();
        return redirect($notification->data['link']);
    }
}
