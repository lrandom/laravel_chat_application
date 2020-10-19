<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Contact;
use Illuminate\Http\Request;
use function foo\func;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', function (Request $request) {
    $fullname = $request->fullname;
    $email = $request->email;
    $message = $request->message;

    $contact = new Contact();
    $contact->fullname = $fullname;
    $contact->email = $email;
    $contact->message = $message;
    $contact->save();
});

Route::get('chat', function () {
    return view('chat');
});