<?php

namespace App\Http\Controllers;

use App\Mail\sendastro;
use App\Mail\sendcode;
use App\Mail\sendinv;
use App\Mail\sendinvchg;
use App\Mail\sendinvdlt;
use App\Mail\wlcmail;
use App\Models\admin;
use App\Models\astro;
use App\Models\codes;
use App\Models\events;
use App\Models\lectures;
use App\Models\links;
use App\Models\messages;
use App\Models\news;
use App\Models\photos;
use App\Models\seminars;
use App\Models\users;
use App\Models\videos;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class cont extends Controller
{

function userlog(Request $request){
   $users=users::query()
                  ->where('email','=',$request->input('email'))
                  ->where('pass','=',$request->input('pass'))
                  ->get();
    if(count($users)>0) return response()->json(['status'=>200,'user'=>$users]);
    else return response()->json(['status'=>300]);
}

function usereg(Request $request){

    $email=$request->input('email');
    $phone=$request->input('phone');
    $mail=users::query()
                 ->where('email','=',$email)
                 ->get();

    $mobile=users::query()
                   ->where('phone','=',$phone)
                   ->get();

    if(count($mail)>0 && count($mobile)==0) return response()->json(['status'=>300]);
    if(count($mobile)>0 && count($mail)==0) return response()->json(['status'=>400]);
    if(count($mail)>0 && count($mobile)>0) return response()->json(['status'=>500]);
    if(count($mail)==0 && count($mobile)==0){
    $user=new users();
    $user->first_name=$request->input('fname');
    $user->last_name=$request->input('lname');
    $user->email=$request->input('email');
    $user->phone=$request->input('phone');
    $user->pbirth=$request->input('pbirth');
    $user->dbirth=$request->input('dbirth');
    $user->pass=$request->input('pass');
    $user->save();
    $message=[
        'title'=>'test',
        'body'=>'test email'
    ];
    Mail::to($email)->send(new wlcmail($message));
    return response()->json(['status'=>200]);
}
}

    public function sendcode(Request $request){
        $email=$request->input('email');
        $code=rand(1000,9999);
        $check=users::query()
                      ->where('email','=',$email)
                      ->get();
        if(count($check)>0)
        {
            $message=[
                'title'=>'test',
                'body'=>$code
            ];
            session(['code'=>$code]);
            Mail::to($email)->send(new sendcode($message));
            return response()->json(['status'=>200,'code'=>$code]);
        }
        else return response()->json(['status'=>300]);
    }

    function changepass(Request $request){
        $email=$request->input('email');
        $pass=$request->input('pass');
        DB::update('update users set pass = ? where email = ?', [$pass,$email]);
        return response()->json(['status'=>200]);
    }

    function adminlog(Request $request){
        $email=$request->input('email');
        $pass=$request->input('pass');
        $admin=admin::query()
                      ->where('email','=',$email)
                      ->where('password','=',$pass)
                      ->get();
        if(count($admin)>0){
            return response()->json(['status'=>200,'admin'=>$admin]);
        }
        else return response()->json(['status'=>300]);
    }

    function addnew(Request $request){
        $title=$request->input('title');
        $parag=$request->input('parag');
        $file=$request->input('photo');
        $date=$request->input('date');
        $rand=rand(100000,1000000);
        $code=codes::query()
                    ->where('code','=',$rand)
                    ->get();
        if(count($code)>0) $rand=rand(100000,1000000);
        $file=str_replace(['data:image/png;base64','data:image/jpeg;base64','data:image/jpg;base64'],'',$file);
        $file=str_replace(' ','+',$file);
        file_put_contents(storage_path('app/public').'/newphotos/'.$rand.'.jpg',base64_decode($file));
        $news=new news();
        $news->title=$title;
        $news->parag=$parag;
        $news->photo=$rand.'.jpg';
        $news->date=$date;
        $news->save();
        $code=new codes();
        $code->code=$rand;
        $code->save();
        return response()->json(['status'=>200]);
    }

    function addevent(Request $request){
        $title=$request->input('title');
        $parag=$request->input('parag');
        $file=$request->input('file');
        $start=$request->input('startdate');
        $end=$request->input('endate');
        $rand=rand(100000,1000000);
        $code=codes::query()
                    ->where('code','=',$rand)
                    ->get();
        if(count($code)>0) $rand=rand(100000,1000000);
        $file=str_replace(['data:image/png;base64','data:image/jpeg;base64','data:image/jpg;base64'],'',$file);
        $file=str_replace(' ','+',$file);
        file_put_contents(storage_path('app/public').'/eventphotos/'.$rand.'.jpg',base64_decode($file));
        $event=new events();
        $event->title=$title;
        $event->parag=$parag;
        $event->file=$rand.'.jpg';
        $event->start_date=$start;
        $event->end_date=$end;
        $event->save();
        $code=new codes();
        $code->code=$rand;
        $code->save();
        return response()->json(['status'=>200]);
    }

    function addlink(Request $request){
        $title=$request->input('title');
        $url=$request->input('url');
        $link=new links();
        $link->title=$title;
        $link->url=$url;
        $link->save();
        return response()->json(['status'=>200]);
    }
    function addsem(Request $request){
        $title=$request->input('title');
        $desc=$request->input('desc');
        $link=$request->input('link');
        $date=$request->input('date');
        $seminar=new seminars();
        $seminar->title=$title;
        $seminar->description=$desc;
        $seminar->link=$link;
        $seminar->date=$date;
        $seminar->save();
        return response()->json(['status'=>200]);
    }
    function addastro(Request $request){
        $title=$request->input('title');
        $desc=$request->input('desc');
        $place=$request->input('place');
        $date=$request->input('date');
        $dt=explode('T',$date);
        session(['date'=>$dt[0]]);
        session(['time'=>$dt[1]]);
        session(['place'=>$place]);
        $astro=new astro();
        $astro->title=$title;
        $astro->description=$desc;
        $astro->place=$place;
        $astro->date=$date;
        $astro->save();
        $msg=[
            'title'=>'test',
            'body'=>'test email'
        ];
        $count=DB::table('users')->select('*')->get();
            foreach($count as $key){
                $email=$key->email;
                Mail::to($email)->send(new sendinv($msg));
            }

        return response()->json(['status'=>200]);
    }
    function addlect(Request $request){
        $title=$request->input('title');
        $link=$request->input('link');
        $date=$request->input('date');
        $lecture=new lectures();
        $lecture->title=$title;
        $lecture->link=$link;
        $lecture->date=$date;
        $lecture->save();
        return response()->json(['status'=>200]);
    }
    function addvideo(Request $request){
        $title=$request->input('title');
        $name=$request->input('name');
        $rand=rand(100000,1000000);
        $code=codes::query()
                    ->where('code','=',$rand)
                    ->get();
        if(count($code)>0) $rand=rand(100000,1000000);
        $name=str_replace(['data:video/mp4;base64'],'',$name);
        $name=str_replace(' ','+',$name);
        file_put_contents(storage_path('app/public').'/videos/'.$rand.'.mp4',base64_decode($name));
        $video=new videos();
        $video->title=$title;
        $video->name=$rand.'.mp4';
        $video->save();
        $code=new codes();
        $code->code=$rand;
        $code->save();
        return response()->json(['status'=>200]);
    }
    function addphoto(Request $request){
        $title=$request->input('title');
        $name=$request->input('name');
        $rand=rand(100000,1000000);
        $code=codes::query()
                    ->where('code','=',$rand)
                    ->get();
        if(count($code)>0) $rand=rand(100000,1000000);
        $name=str_replace(['data:image/png;base64','data:image/jpeg;base64','data:image/jpg;base64'],'',$name);
        $name=str_replace(' ','+',$name);
        file_put_contents(storage_path('app/public').'/photos/'.$rand.'.jpg',base64_decode($name));
        $photo=new photos();
        $photo->title=$title;
        $photo->name=$rand.'.jpg';
        $photo->save();
        $code=new codes();
        $code->code=$rand;
        $code->save();
        return response()->json(['status'=>200]);
    }
    function getnews(Request $request){
        $news=DB::table('news')->select('*')->whereDate('date','<',$request->input('date'))->orderByDesc('id')->get();
        $today=DB::table('news')->select('*')->whereDate('date','=',$request->input('date'))->orderByDesc('id')->get();
        return response()->json(['status'=>200,'news'=>$news,'today'=>$today]);
    }
    function getnewsid($id){
        $news=news::find($id);
        return response()->json(['status'=>200,'news'=>$news]);
    }
    function getevent(Request $request){
        $event=DB::table('events')->select('*')->orderByDesc('id')->get();
        return response()->json(['status'=>200,'event'=>$event]);
    }

    function geteventid($id){
        $event=events::find($id);
        return response()->json(['status'=>200,'event'=>$event]);
    }
    function getlink(){
        $link=links::all();
        return response()->json(['status'=>200,'links'=>$link]);
    }
    function getlinksearch(Request $request){
        $title=$request->input('text');
        $link=links::query()
                    ->where('title','like','%'.$title.'%')
                    ->get();
        return response()->json(['status'=>200,'links'=>$link]);
    }
    function getseminar(){
        $seminar=seminars::query()
                        ->orderByDesc('id', 'DESC')
                        ->get();
        return response()->json(['status'=>200,'seminars'=>$seminar]);
    }
    function getseminarsearch(Request $request){
        $seminar=seminars::query()
                            ->where('title','like','%'.$request->input('text').'%')
                            ->orWhere('description','like','%'.$request->input('text').'%')
                            ->orderByDesc('id', 'DESC')
                            ->get();
        return response()->json(['status'=>200,'seminars'=>$seminar]);
    }
    function getastronights(){
        $astro=astro::query()
                        ->orderByDesc('id', 'DESC')
                        ->get();
        return response()->json(['status'=>200,'astro'=>$astro]);
    }
    function getlectures(){
        $lecture=lectures::query()
                            ->orderByDesc('id','DESC')
                            ->get();
        return response()->json(['status'=>200,'lectures'=>$lecture]);
    }
    function getvideos(){
        $video=videos::all();
        return response()->json(['status'=>200,'videos'=>$video]);
    }
    function getvideosid(Request $request){
        $video=videos::query()
                        ->where('title','like','%'.$request->input('text').'%')
                        ->get();
        return response()->json(['status'=>200,'videos'=>$video]);
    }
    function getvideosbyid($id){
        $video=videos::find($id);
        return response()->json(['status'=>200,'video'=>$video]);
    }
    function getphotos(){
        $photo=photos::all();
        return response()->json(['status'=>200,'photo'=>$photo]);
    }
    function getphotosid(Request $request){
        $photo=photos::query()
                        ->where('title','like','%'.$request->input('text').'%')
                        ->get();
    return response()->json(['status'=>200,'photo'=>$photo]);
    }
    function postchatadmin(Request $request){
        $message=$request->input('message');
        $sender=$request->input('sender');
        $date=$request->input('date');
        $chat=new messages();
        $chat->sender=$sender;
        $chat->message=$message;
        $chat->date=$date;
        $chat->save();
        return response()->json(['status'=>200]);
    }
    function postchatuser(Request $request){
        $message=$request->input('message');
        $sender=$request->input('sender');
        $date=$request->input('date');
        $chat=new messages();
        $chat->sender=$sender;
        $chat->message=$message;
        $chat->date=$date;
        $chat->save();
        return response()->json(['status'=>200]);
    }
    function getchat(){
        $chat=messages::all();
        return response()->json(['status'=>200,'chat'=>$chat]);
    }

    function dltevent($id){
        $dlt=events::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function dltnews($id){
        $dlt=news::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function dltlinks($id){
        $dlt=links::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function dltseminars($id){
        $dlt=seminars::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function dltastro($id){
        $dlt=astro::find($id);
        $date=$dlt->date;
        $dt=explode('T',$date);
        session(['date'=>$dt[0]]);
        session(['time'=>$dt[1]]);
        session(['place']);
        $dlt->delete();
        $count=DB::table('users')->select('*')->get();
        $msg=[
            'title'=>'test',
            'body'=>'test email'
        ];
        foreach($count as $key){
            $email=$key->email;
            Mail::to($email)->send(new sendinvdlt($msg));
        }
        return response()->json(['status'=>200]);
    }
    function dltlectures($id){
        $dlt=lectures::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function dltphotos($id){
        $dlt=photos::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function dltvideos($id){
        $dlt=videos::find($id);
        $dlt->delete();
        return response()->json(['status'=>200]);
    }
    function edtnews($id){
        $news=news::find($id);
        return response(['status'=>200,'news'=>$news]);
    }
    function updnews(Request $request,$id){
        $news=news::find($id);
        $news->title=$request->input('title');
        $news->parag=$request->input('parag');
        $news->update();
        return response()->json(['status'=>200]);
    }
    function edtevent($id){
        $event=events::find($id);
        return response()->json(['status'=>200,'event'=>$event]);
    }
    function updevents(Request $request,$id){
        $event=events::find($id);
        $event->title=$request->input('title');
        $event->parag=$request->input('parag');
        $event->start_date=$request->input('start_date');
        $event->end_date=$request->input('end_date');
        $event->update();
        return response()->json(['status'=>200]);
    }
    function edtlink($id){
        $link=links::find($id);
        return response()->json(['status'=>200,'link'=>$link]);
    }
    function updlinks(Request $request,$id){
        $link=links::find($id);
        $link->title=$request->input('title');
        $link->url=$request->input('link');
        $link->update();
        return response()->json(['status'=>200]);
    }
    function edtsem($id){
        $seminar=seminars::find($id);
        return response()->json(['status'=>200,'sem'=>$seminar]);
    }
    function updsem(Request $request,$id){
        $sem=seminars::find($id);
        $sem->title=$request->input('title');
        $sem->description=$request->input('desc');
        $sem->link=$request->input('link');
        $sem->date=$request->input('date');
        $sem->update();
        return response()->json(['status'=>200]);
    }
    function edtastr($id)
    {
        $astro=astro::find($id);
        return response()->json(['status'=>200,'astro'=>$astro]);
    }
    function updastr(Request $request,$id){
        $astro=astro::find($id);
        $astro->title=$request->input('title');
        $astro->description=$request->input('desc');
        $astro->place=$request->input('place');
        $astro->date=$request->input('date');
        $astro->update();
        $dt=explode("T",$request->input('date'));
        session(['date'=>$dt[0]]);
        session(['time'=>$dt[1]]);
        session(['place'=>$request->input('place')]);
        $count=DB::table('users')->select('*')->get();
        $msg=[
            'title'=>'test',
            'body'=>'test email'
        ];
        foreach($count as $key){
            $email=$key->email;
            Mail::to($email)->send(new sendinvchg($msg));
        }
        return response()->json(['status'=>200]);
    }
    function edtlec($id){
        $lecture=lectures::find($id);
        return response()->json(['status'=>200,'lecture'=>$lecture]);
    }
    function updlec(Request $request,$id){
        $lecture=lectures::find($id);
        $lecture->title=$request->input('title');
        $lecture->link=$request->input('link');
        $lecture->date=$request->input('date');
        $lecture->update();
        return response()->json(['status'=>200]);
    }
    function edtpho($id){
        $photo=photos::find($id);
        return response()->json(['status'=>200,'photo'=>$photo]);
    }
    function updpho(Request $request,$id){
        $photo=photos::find($id);
        $photo->title=$request->input('title');
        $photo->update();
        return response()->json(['status'=>200]);
    }
    function edtvid($id){
        $video=videos::find($id);
        return response()->json(['status'=>200,'video'=>$video]);
    }
    function updvid(Request $request,$id){
        $video=videos::find($id);
        $video->title=$request->input('title');
        $video->update();
        return response()->json(['status'=>200]);
    }
    function deletemessage($id){
        $message=messages::find($id);
        $message->delete();
        return response()->json(['status'=>200]);
    }
}
