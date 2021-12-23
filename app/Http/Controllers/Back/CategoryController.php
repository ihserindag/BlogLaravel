<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Article;


class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function switch(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0 ;
        $category->save();
    }

    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);

    }

    public function create(Request $request)
    {


        $isExist=Category::whereSlug(Str::slug($request->category,'-'))->first();
        if($isExist){
            toastr()->error($request->category.' adında bir kategori zaten var');
            return redirect()->back();
        }

        $category=new Category;
        $category->name=$request->category;
        $category->slug=Str::slug($request->category,'-');
        $category->save();
        toastr()->success('Başarılı', 'Kategori Başarı ile Oluşturuldu.');
        return redirect()->back();
    }
    public function update(Request $request)
    {


        $isExist=Category::whereSlug(Str::slug($request->category,'-'))->whereNotIn('id',[$request->id])->first();

        if($isExist){
            toastr()->error($request->category.' adında bir kategori zaten var');
            return redirect()->back();
        }

        $category=Category::find($request->id);
        $category->name=$request->category;
        $category->slug=Str::slug($request->category,'-');
        $category->save();
        toastr()->success('Başarılı', 'Kategori Başarı ile Güncellendi.');
        return redirect()->back();
    }

    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        if($category->id==1){
            toastr()->error('Bu Kategori Silinemez');
            return redirect()->back();
        }
        $message='';
        $count=$category->articleCount();
        if($count>0){
           Article::where('category_id',$category->id)->update(['category_id'=>1]);
           $defaultCategory=Category::find(1);
           $message='Bu Kategoriye Ait '.$count.' makale '.$defaultCategory->name.' Kategorisine Taşındı';
        }
        toastr()->success('Kategori Başarı ile Silindi.',$message );
        $category->delete();
        return redirect()->back();
    }
}
