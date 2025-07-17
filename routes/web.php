<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservationsController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

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

Route::get('/', [ContentsController::class, 'home']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/new', [ClientController::class, 'newClient']);
Route::post('/clients/new', [ClientController::class, 'create']);
Route::get('/clients/{client_id}', [ClientController::class, 'show']);
Route::post('/clients/{client_id}', [ClientController::class, 'modify']);

Route::get('/reservations/{client_id}', [RoomsController::class, 'checkAvailableRooms']);
Route::post('/reservations/{client_id}', [RoomsController::class, 'checkAvailableRooms']);

Route::get('/book/room/{client_id}/{room_id}/{date_in}/{date_out}', [ReservationsController::class, 'bookRoom']);

Route::get('/about', function () {
    $respose_arr = [];
    $respose_arr['author'] = 'BP';
    $respose_arr['version'] = '0.1.1.1';
    return $respose_arr;
    // return '<h3>About</h3>';
});

Route::get('/home', function () {
    $data = [];
    $data['version'] = '0.1.1';
    return view('welcome',$data);
});

// Route::get('/di', 'ClientController@di');
Route::get('/di', [ClientController::class, 'di']);

Route::get('/facade/db', function () {
    return DB::select('select * from table');
});

Route::get('/facade/encrypt', function () {
    return Crypt::encrypt('123456798');
});

Route::get('/facade/decrypt', function () {
      try {
        $decrypted = Crypt::decrypt('eyJpdiI6Ik04OFhzbWthZFEvZWR1dGMzMit6Nmc9PSIsInZhbHVlIjoiZTZmSjNSOFJUOWJSNE0vZGV1KzJzMVhKYmJsdVpOVldGOHN4bStXYzdZbz0iLCJtYWMiOiIyZWE2NzRlYjZmMTA1OTExMWJjNzViOWVkODM5MmMwY2U5OTYxYjE5ZGZkM2M1OGMwNDJhZmRhY2JjZDg3ODQ2IiwidGFnIjoiIn0');
        return $decrypted;
    } catch (DecryptException $e) {
        return 'Decryption failed: ' . $e->getMessage();
    }
});

