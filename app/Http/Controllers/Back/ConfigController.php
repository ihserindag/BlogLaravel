<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ConfigController extends Controller
{
    public function index(){
        $config=Config::find(1);
        return view('back.config.index',compact('config'));
    }

    public function update(Request $request)
    {
        $config=Config::find(1);

        if($request->logo)
        {
            if(File::exists($config->logo))
         {
            File::delete(public_path($config->logo));
         }

        }

        if($request->favicon)
        {
            if(File::exists($config->favicon))
         {
            File::delete(public_path($config->favicon));
         }

        }



        $config->title=$request->title;
        $config->active=$request->active;
        $config->facebook=$request->facebook;
        $config->twitter=$request->twitter;
        $config->linkedin=$request->linkedin;
        $config->youtube=$request->youtube;
        $config->github=$request->github;
        $config->instagram=$request->instagram;


        if($request->hasFile('logo')){
            $logo=Str::slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('upload'),$logo);
            $config->logo='upload/'.$logo;
        }

        if($request->hasFile('favicon')){
            $favicon=Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('upload'),$favicon);
            $config->favicon='upload/'.$favicon;
        }
        $config->save();
        toastr()->success('Ayarlar Başarı ile güncellendi');
        return redirect()->back();



    }
}
