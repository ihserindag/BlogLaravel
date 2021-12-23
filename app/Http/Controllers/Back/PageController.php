<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index() {
        $pages=Page::all();
        return view('back.pages.index',compact('pages'));
    }

    public function create(){

        return view('back.pages.create');
    }

    public function post(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:png,jpg,jpeg|max:3000'
        ]);

        $isExist=Page::whereSlug(Str::slug($request->title,'-'))->first();
        if($isExist){
            toastr()->error($request->title.' adında bir sayfa zaten var');
            return redirect()->back();
        }
        $last=Page::orderBy('order','desc')->first();

        $page=new Page;
        $page->title=$request->title;
        $page->content=$request->content;
        $page->order=$last->order+1;
        $page->slug=Str::slug($request->title,'-');

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title,'-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'),$imageName);
            $page->image='upload/'.$imageName;

        }

        $page->save();

        toastr()->success('Başarılı', 'Sayfa Başarı İle Oluşturuldu');
        return redirect()->route('admin.pages.index');
    }
    public function edit($id)
    {
        $page=Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function update(Request $request, $id)
    {

        $isExist=Page::whereSlug(Str::slug($request->title,'-'))->whereNotIn('id',[$id])->first();
        if($isExist){
            toastr()->error($request->title.' adında bir sayfa zaten var');
            return redirect()->back();
        }

        $page=Page::findOrFail($id);


        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:png,jpg,jpeg|max:3000'
        ]);



        if($request->image)
        {
            if(File::exists($page->image))
         {
            File::delete(public_path($page->image));
         }

        }

        $page->title=$request->title;

        $page->content=$request->content;
        $page->slug=Str::slug($request->title,'-');



        if($request->hasFile('image')){
            $imageName=Str::slug($request->title,'-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'),$imageName);
            $page->image='upload/'.$imageName;

        }
        $page->save();
        toastr()->success('Başarılı', 'Sayfa Başarı İle Güncellendi');
        return redirect()->route('admin.pages.index');
    }
    public function delete($id)
     {

        $page=Page::find($id);
        if(File::exists($page->image))
        {
           File::delete(public_path($page->image));
        }
        $page->forceDelete();

        toastr()->success('Sayfa Silindi.');
        return redirect()->route('admin.pages.index');
     }


    public function switch(Request $request)
    {
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1 : 0 ;
        $page->save();

    }

    public function orders(Request $request){
        $orders=$request->get('page');
        foreach($orders as $key=>$order){
           Page::where('id',$order)->update(['order'=>$key]);
        }
    }
}
