<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login', 'App\Http\Controllers\cont@userlog');
Route::post('/user/register','App\Http\Controllers\cont@usereg');
Route::post('/send/code', 'App\Http\Controllers\cont@sendcode');
Route::post('/change/password','App\Http\Controllers\cont@changepass');
Route::post('/admin/login', 'App\Http\Controllers\cont@adminlog');
Route::post('/add/new', 'App\Http\Controllers\cont@addnew');
Route::post('/add/event', 'App\Http\Controllers\cont@addevent');
Route::post('/add/link', 'App\Http\Controllers\cont@addlink');
Route::post('/add/seminar', 'App\Http\Controllers\cont@addsem');
Route::post('/add/seminar', 'App\Http\Controllers\cont@addsem');
Route::post('/add/astro', 'App\Http\Controllers\cont@addastro');
Route::post('/add/lect', 'App\Http\Controllers\cont@addlect');
Route::post('/add/video', 'App\Http\Controllers\cont@addvideo');
Route::post('/add/photo', 'App\Http\Controllers\cont@addphoto');
Route::post('/user/news','App\Http\Controllers\cont@getnews');
Route::get('/user/news/{id}','App\Http\Controllers\cont@getnewsid');
Route::get('/user/event','App\Http\Controllers\cont@getevent');
Route::get('/user/event/{id}', 'App\Http\Controllers\cont@geteventid');
Route::get('/user/links', 'App\Http\Controllers\cont@getlink');
Route::post('/user/links/search', 'App\Http\Controllers\cont@getlinksearch');
Route::get('/user/seminars', 'App\Http\Controllers\cont@getseminar');
Route::post('/user/seminars/search', 'App\Http\Controllers\cont@getseminarsearch');
Route::get('/user/astro/nights', 'App\Http\Controllers\cont@getastronights');
Route::get('/user/lectures', 'App\Http\Controllers\cont@getlectures');
Route::get('/user/videos', 'App\Http\Controllers\cont@getvideos');
Route::post('/user/videos/search', 'App\Http\Controllers\cont@getvideosid');
Route::get('/user/videos/{id}', 'App\Http\Controllers\cont@getvideosbyid');
Route::get('/user/photos', 'App\Http\Controllers\cont@getphotos');
Route::post('/user/photos/search', 'App\Http\Controllers\cont@getphotosid');
Route::get('/chat/get', 'App\Http\Controllers\cont@getchat');
Route::post('/chat/admin/post', 'App\Http\Controllers\cont@postchatadmin');
Route::post('/chat/user/post', 'App\Http\Controllers\cont@postchatuser');
Route::post('/admin/delete/event/{id}', 'App\Http\Controllers\cont@dltevent');
Route::post('/admin/delete/news/{id}', 'App\Http\Controllers\cont@dltnews');
Route::post('/admin/delete/links/{id}', 'App\Http\Controllers\cont@dltlinks');
Route::post('/admin/delete/seminars/{id}', 'App\Http\Controllers\cont@dltseminars');
Route::post('/admin/delete/astro/{id}', 'App\Http\Controllers\cont@dltastro');
Route::post('/admin/delete/lectures/{id}', 'App\Http\Controllers\cont@dltlectures');
Route::post('/admin/delete/photos/{id}', 'App\Http\Controllers\cont@dltphotos');
Route::post('/admin/delete/videos/{id}', 'App\Http\Controllers\cont@dltvideos');
Route::get('/admin/edit/news/{id}', 'App\Http\Controllers\cont@edtnews');
Route::post('/admin/edit/news/update/{id}', 'App\Http\Controllers\cont@updnews');
Route::get('/admin/edit/events/{id}', 'App\Http\Controllers\cont@edtevent');
Route::post('/admin/edit/events/update/{id}', 'App\Http\Controllers\cont@updevents');
Route::get('/admin/edit/links/{id}', 'App\Http\Controllers\cont@edtlink');
Route::post('/admin/edit/links/update/{id}', 'App\Http\Controllers\cont@updlinks');
Route::get('/admin/edit/seminars/{id}', 'App\Http\Controllers\cont@edtsem');
Route::post('/admin/edit/seminars/update/{id}', 'App\Http\Controllers\cont@updsem');
Route::get('/admin/edit/astro/night/{id}', 'App\Http\Controllers\cont@edtastr');
Route::post('/admin/edit/astro/night/update/{id}', 'App\Http\Controllers\cont@updastr');
Route::get('/admin/edit/lectures/{id}', 'App\Http\Controllers\cont@edtlec');
Route::post('/admin/edit/lectures/update/{id}', 'App\Http\Controllers\cont@updlec');
Route::get('/admin/edit/photo/{id}', 'App\Http\Controllers\cont@edtpho');
Route::post('/admin/edit/photo/update/{id}', 'App\Http\Controllers\cont@updpho');
Route::get('/admin/edit/video/{id}', 'App\Http\Controllers\cont@edtvid');
Route::post('/admin/edit/video/update/{id}', 'App\Http\Controllers\cont@updvid');
Route::post('/admin/delete/message/{id}', 'App\Http\Controllers\cont@deletemessage');
