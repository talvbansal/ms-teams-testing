<?php

use App\Notifications\PolicyPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function (): void {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/notification', function(Request $request){
        /** @var \App\User $user */
        $user = $request->user();

        $user->notify(new PolicyPlaced());

        return redirect()->route('home')
            ->with('notification', 'New notification sent to teams');

    })->name('notification.send');
});
