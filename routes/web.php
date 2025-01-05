<?php

use App\Http\Controllers\Admin\AdmitPatientsToWardController;
use App\Http\Controllers\Admin\AllocateNursesToWardController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\DiagnosisController as AdminDiagnosisController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\HospitalController as AdminHospitalController;
use App\Http\Controllers\Admin\MedicationController as AdminMedicationController;
use App\Http\Controllers\Admin\MedicationPlanController as AdminMedicationPlanController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\NurseController as AdminNurseController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientMedicationAllocationController as AdminPatientMedicationAllocationController;
use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use App\Http\Controllers\Admin\WardController as AdminWardController;
use App\Http\Controllers\Auth\DoctorRegisterController;
use App\Http\Controllers\Auth\NurseRegisterController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DiagnosisController;
use App\Http\Controllers\Doctor\DonationController as DoctorDonationController;
use App\Http\Controllers\Doctor\HospitalController;
use App\Http\Controllers\Doctor\MedicationController as DoctorMedicationController;
use App\Http\Controllers\Doctor\MedicationPlanController as DoctorMedicationPlanController;
use App\Http\Controllers\Doctor\MessageController;
use App\Http\Controllers\Doctor\NurseController as DoctorNurseController;
use App\Http\Controllers\Doctor\PatientMedicationAllocationController as DoctorPatientMedicationAllocationController;
use App\Http\Controllers\Doctor\VisitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hospital\DonationController as HospitalDonationController;
use App\Http\Controllers\Hospital\VisitController as HospitalVisitController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Nurse\AppointmentController as NurseAppointmentController;
use App\Http\Controllers\Nurse\MedicationController as NurseMedicationController;
use App\Http\Controllers\Nurse\MedicationPlanController as NurseMedicationPlanController;
use App\Http\Controllers\Nurse\PatientController as NursePatientController;
use App\Http\Controllers\Nurse\WardController;
use App\Http\Controllers\Patient\AppointmentController as PatientAppointmentController;
use App\Http\Controllers\Patient\DiagnosisController as PatientDiagnosisController;
use App\Http\Controllers\Patient\DonationController;
use App\Http\Controllers\Patient\HospitalController as PatientHospitalController;
use App\Http\Controllers\Patient\MessageController as PatientMessageController;
use App\Http\Controllers\Patient\VisitController as PatientVisitController;
use App\Repositories\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/schedule', function () {
    $schedule = new Schedule();
    $schedule->schedule();

    return view('datepicker');
});
Auth::routes();

Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/doctor')->name('doctor.')->middleware(['auth', 'doctor'])->group(
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        //Appointments
        Route::resource('appointments', AppointmentController::class);

        //Hospital
        Route::resource('hospitals', HospitalController::class);

        //Visits
        Route::resource('visits', VisitController::class);
        Route::get('visits/create/{appointment}', [VisitController::class, 'create'])->name('visits.create');

        //diagnosis
        Route::resource('diagnoses', DiagnosisController::class);
        Route::get('diagnoses/create/{visit}', [DiagnosisController::class, 'create'])->name('diagnoses.create');

        //messages
        Route::resource('messages', MessageController::class);

        //donantion
        Route::resource('donations', DoctorDonationController::class);

        //nurses
        Route::resource('nurses', DoctorNurseController::class);

        // medications
        Route::resource('medications', DoctorMedicationController::class);
        Route::resource('medication_plans', DoctorMedicationPlanController::class);
        Route::get('allocations/create', [DoctorPatientMedicationAllocationController::class, 'create'])->name('allocations.create');
        Route::post('allocations', [DoctorPatientMedicationAllocationController::class, 'store'])->name('allocations.store');
    }
);

Route::prefix('/nurse')->name('nurse.')->middleware(['nurse', 'auth'])->group(
    function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        //patients
        Route::resource('patients', NursePatientController::class);

        //wards
        Route::resource('wards', WardController::class);

        //Appointments
        Route::resource('appointments', NurseAppointmentController::class);

        //Hospitals
        Route::resource('hospitals', HospitalController::class);

        //Visits
        Route::resource('visits', VisitController::class);
        Route::get('visits/create/{appointment}', [VisitController::class, 'create'])->name('visits.create');

        //diagnosis
        Route::resource('diagnoses', DiagnosisController::class);
        Route::get('diagnoses/create/{visit}', [DiagnosisController::class, 'create'])->name('diagnoses.create');

        //messages
        Route::resource('messages', MessageController::class);

        //donantion
        Route::resource('donations', DoctorDonationController::class);

        //nurses
        Route::resource('nurses', DoctorNurseController::class);

        // medications
        Route::resource('medications', NurseMedicationController::class);
        Route::resource('medication_plans', NurseMedicationPlanController::class);
    }
);
Route::prefix('/patient')->name('patient.')->middleware(['patient', 'auth'])->group(
    function () {
        //home
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //Appointments
        Route::resource('appointments', PatientAppointmentController::class);

        //Hospital
        Route::resource('hospitals', PatientHospitalController::class);

        //Visits
        Route::resource('visits', PatientVisitController::class);

        //diagnosis
        Route::resource('diagnoses', PatientDiagnosisController::class);

        //messages
        Route::resource('messages', PatientMessageController::class);

        //donantion
        Route::resource('donations', DonationController::class);
    }
);
Route::prefix('/hospital')->name('hospital.')->middleware(['hospital', 'auth'])->group(
    function () {
        //visits
        Route::resource('visits', HospitalVisitController::class);
        //donantion
        Route::resource('donations', HospitalDonationController::class);
    }
);

Route::prefix('/admin')->name('admin.')->middleware(['admin', 'auth'])->group(
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //patients
        Route::resource('patients', PatientController::class);

        //wards
        Route::resource('wards', AdminWardController::class);

        //allocate wards
        Route::resource('allocate_wards', AllocateNursesToWardController::class);

        //admit_to_wards
        Route::resource('admit_to_wards', AdmitPatientsToWardController::class);

        //Appointments
        Route::resource('appointments', AdminAppointmentController::class);

        //Hospital
        Route::resource('hospitals', AdminHospitalController::class);

        //Visits
        Route::resource('visits', AdminVisitController::class);
        Route::get('visits/create/{appointment}', [AdminVisitController::class, 'create'])->name('visits.create');

        //diagnosis
        Route::get('diagnoses/create/{visit}', [AdminDiagnosisController::class, 'create'])->name('diagnoses.create-diagnoses');
        Route::resource('diagnoses', AdminDiagnosisController::class);

        //messages
        Route::resource('messages', AdminMessageController::class);

        //donantion
        Route::resource('donations', AdminDonationController::class);

        //doctor
        Route::resource('doctors', DoctorController::class);

        //nurses
        Route::get('nurse/register', [NurseRegisterController::class, 'create'])->name('nurses.register');
        Route::post('nurse/register', [NurseRegisterController::class, 'store'])->name('nurses.register');

        Route::resource('nurses', AdminNurseController::class);

        // medications
        Route::resource('medications', AdminMedicationController::class);
        Route::resource('medication_plans', AdminMedicationPlanController::class);
        Route::get('allocations/create', [AdminPatientMedicationAllocationController::class, 'create'])->name('allocations.create');
        Route::post('allocations', [AdminPatientMedicationAllocationController::class, 'store'])->name('allocations.store');

    }
);

//doctor register account
Route::get('doctor/register', [DoctorRegisterController::class, 'create'])->name('admin.doctors.register');
Route::post('doctor/register', [DoctorRegisterController::class, 'store'])->name('admin.doctors.register');
