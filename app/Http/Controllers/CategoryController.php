<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        $categories=Category::all();
        return view('admin.category.category',compact('categories'));
    }

    public function category_store(Request $request){
        
        $request->validate([
            'name'=>['required','unique:categories,name'],
            'photo'=>['required','mimes:png,jpg,jpeg','max:2048'],
        ]);
        $cateimage=$request->photo;
        $imageEx=$cateimage->extension();
        $fileName='category'. rand(1111,9999). '.'.$imageEx;
        $manager = new ImageManager(new Driver());

        $image = $manager->read($cateimage);
        $image->resize(200,200);
        $image->save(public_path('uploads/category/').$fileName);

        Category::create([
            'name'=>$request->name,
            'category_image'=>$fileName,
        ]);

        return back()->with('add_cat','Category Added Successfully');
    }

    public function category_edit($id){
        $category=Category::findOrFail($id);
        return view('admin.category.category-edit',compact('category'));
    }

    public function category_update(Request $request,$id){

        $category=Category::findOrFail($id);

        $request->validate([
            'name'=>['required','unique:categories,name,'.$id],
            
        ]);

        if($request->photo != ''){
            
            $request->validate([
                'category_image'=>['mimes:png,jpg','max:2048'],
            ]);
            if($category->category_image !=''){
                $delete=public_path('uploads/category/'.$category->category_image);
                unlink($delete);
            }

            $cateimage=$request->photo;
            $imageEx=$cateimage->extension();
            $fileName='category'. rand(1111,9999). '.'.$imageEx;
            $manager = new ImageManager(new Driver());
            $image = $manager->read($cateimage);
            $image->resize(200,200);
            $image->save(public_path('uploads/category/').$fileName);
                

            $category->update([
                'name'=>$request->name,
                'category_image'=>$fileName,
            ]);
        }else{
            $category->update([
                'name'=>$request->name,
            ]);
        }

        return redirect()->route('category')->with('cat_update','Category Updated Successfully');

    }


    public function category_delete($id){
        Category::findOrFail($id)->delete();

        return back()->with('delete','Category Deleted Successfully');
    }

    public function categoryTrash(){
        $delete_cat= Category::onlyTrashed()->get();
        return view('admin.category.category-trush', compact('delete_cat'));
    }

    public function categoryRestore($id){
        Category::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('category')->with('retore','Category Restore Successfully');
    }
    public function categoryForceDelete($id){
       
       $del= Category::withTrashed()->findOrFail($id);
       if($del->category_image != ''){
        unlink(public_path('uploads/category/').$del->category_image);
       }
       $del->forceDelete();

         return back()->with('forceDelete','Category Deleted Parmanently');
    }
}
