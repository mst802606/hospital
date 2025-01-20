<?php
namespace App\Http\Controllers;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (auth()->user()->role == 1) {
            return view('patient.home');
        } else if (auth()->user()->role == 2) {
            return view('doctor.home');
        } else if (auth()->user()->role == 3) {
            return redirect(route('nurse.patients.index'));
        } else if (auth()->user()->role == 0 && auth()->user()->is_admin == true) {
            $hospital = $this->hospital();
            return view('admin.home', compact('hospital'));
        } else {
            return back()->with('error', "The application cannot proceed because it cannot determine your role");
        }
    }
}
