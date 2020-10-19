<?php

use Illuminate\Http\Request;
use App\Message;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_messages', function (Request $request) {
    if ($request->last_id == 0) {
        $data = Message::orderBy('id', 'desc')->paginate(10);
    } else {
        $data = Message::where('id', '>', $request->last_id)->paginate(10);
    }
    return Response::json(['messages' => $data->toArray()], 200);
});

Route::post('insert_message', function (Request $request) {
    $nickname = $request->nickname;
    $message = $request->message;
    $messageObj = new Message();
    $messageObj->nickname = $nickname;
    $messageObj->message = $message;
    $messageObj->save();
    return Response::json(['message' => 'Insert successfully'], 200);
});

