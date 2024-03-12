<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContantController;
use App\Http\Controllers\DeparmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Models\Appointment;
use App\Models\Contact;
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
// for home
Route::get('/', [UserController::class, 'home'])->name('home');
//for deparment show
Route::get('deparment/show', [DoctorController::class, 'show'])->name('deparment.show');
// doctor
Route::get('doctor/show', [DoctorController::class, 'display'])->name('doctor.show');
Route::get('/doctor/timetable/{id}', [DoctorController::class, 'timetable'])->name('doctor.timetable');
// contact
Route::post('/contact', [ContactController::class, 'contact'])->name('contact');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// admin middleware
Route::middleware(['admin'])->group(function () {
    // for admin
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    // create deparment
    Route::get('/admin/create/deparment', [DeparmentController::class, 'createDeparment'])->name('admin.create.deparment');
    Route::post('/admin/create/data', [DeparmentController::class, 'createData'])->name('admin.create.data');
    Route::get('/deparment/list', [DeparmentController::class, 'list'])->name('admin.deparment.list');
    Route::get('/deparment/detail/{id}', [DeparmentController::class, 'detail'])->name('admin.deparment.detail');
    Route::get('/deparment/edit/{id}', [DeparmentController::class, 'edit'])->name('admin.deparment.edit');
    Route::post('/deparment/update,{id}', [DeparmentController::class, 'update'])->name('admin.deparment.update');
    Route::get('/deparment/delete/{id}', [DeparmentController::class, 'delete'])->name('admin.deparment.delete');
    // doctor
    Route::get('/doctor', [DoctorController::class, 'doctor'])->name('admin.doctor');
    Route::post('/doctor/create', [DoctorController::class, 'create'])->name('admin.doctor.create');
    Route::get('/doctor/list', [DoctorController::class, 'list'])->name('admin.doctor.list');
    Route::get('/doctor/detail/{id}', [DoctorController::class, 'detail'])->name('admin.doctor.detail');
    Route::get('/doctor/eidt/{id}', [DoctorController::class, 'edit'])->name('admin.doctor.edit');
    Route::post('/doctor/update/{id}', [DoctorController::class, 'update'])->name('admin.doctor.update');
    Route::get('/doctor/delete/{id}', [DoctorController::class, 'delete'])->name('admin.doctor.delete');
    // schedule
    Route::get('/doctor/schedule', [AppointmentController::class, 'schedule'])->name('admin.doctor.schedule');
    Route::post('/doctor/schedule/create', [AppointmentController::class, 'create'])->name('admin.doctor.schedule.create');
    Route::get('/doctor/schedule/list', [AppointmentController::class, 'list'])->name('admin.doctor.schedule.list');
    Route::get('/schedule/edit/{id}', [AppointmentController::class, 'edit'])->name('admin.schedule.edit');
    Route::post('/shcedule/update/{id}', [AppointmentController::class, 'update'])->name('admin.shcedule.update');
    Route::get('/shcedule/delete/{id}', [AppointmentController::class, 'delete'])->name('admin.schedule.delete');
    // patient
    Route::get('/patient/list', [PatientController::class, 'list'])->name('patient.list');
    Route::get('/patient/finish/{id}', [PatientController::class, 'finish'])->name('patient.finish');
    Route::get('/patient/delete/{id}', [PatientController::class, 'delete'])->name('patient.delete');
    // user
    Route::get('user/list', [PatientController::class, 'userList'])->name('user.list');
    Route::get('/user/change/{id}', [PatientController::class, 'change'])->name('user.change');
    Route::get('user/delete/{id}', [PatientController::class, 'userDelete'])->name('user.delete');
    // admin
    Route::get('admin/list', [PatientController::class, 'adminList'])->name('admin.list');
    Route::get('/admin/demote/{id}', [PatientController::class, 'demote'])->name('admin.demote');
    Route::get('/admin/delete/{id}', [PatientController::class, 'adminDelete'])->name('admin.delete');
    // contact
    Route::get('contact/list', [ContactController::class, 'contactList'])->name('contact.list');
    Route::get('contact/delete/{id}', [ContactController::class, 'contactDelete'])->name('contact.delete');
});
// user
Route::middleware(['user'])->group(function () {
    Route::post('/appointment', [DoctorController::class, 'appointment'])->name('user.appointment');
});
// profile
Route::middleware(['prevent-back-history'])->group(function () {
    Route::get('/profile', [ContantController::class, 'profile'])->name('profile');
    Route::post('/editProfile', [ContantController::class, 'editProfile'])->name('editProfile');
    Route::post('/changePassword', [ContantController::class, 'changePassword'])->name('changePassword');
});
