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

    // category store 
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

    // category update 
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


    // category soft delete 
    public function category_delete($id){
        Category::findOrFail($id)->delete();

        return back()->with('delete','Category Deleted Successfully');
    }

    // category deleted item view 
    public function categoryTrash(){
        $delete_cat= Category::onlyTrashed()->get();
        return view('admin.category.category-trush', compact('delete_cat'));
    }

    // category Restore 
    public function categoryRestore($id){
        Category::withTrashed()->findOrFail($id)->restore();
        return back()->with('retore','Category Restore Successfully');
    }

    // category Permanent Delete 
    public function categoryForceDelete($id){
       
       $del= Category::withTrashed()->findOrFail($id);
       if($del->category_image != ''){
        unlink(public_path('uploads/category/').$del->category_image);
       }
       $del->forceDelete();

         return back()->with('forceDelete','Category Deleted Parmanently');
    }

    // category categoryCheckDelete 
    public function categoryCheckDelete(Request $request){
       foreach($request->category_id as $cat_id){
        Category::findOrFail($cat_id)->delete();
       }
       return back()->with('check_del','Deleted All Category Successfully');
    }

    public function check_restore(Request $request){
        
        if($request->action_btn == 1){
            foreach($request->category_id as $cat_id){
                Category::withTrashed()->findOrFail($cat_id)->restore();
            }
            return back()->with('retore','Category Restore Successfully');
        }
        
        if($request->action_btn == 2){
            foreach($request->category_id as $cat_id){
              $catImage=Category::onlyTrashed()->findOrFail($cat_id)->category_image;
              unlink(public_path('uploads/category/').$catImage);
                Category::withTrashed()->findOrFail($cat_id)->forceDelete();
            }
            return back()->with('forceDelete','Category Restore Successfully');
        }
       
    }
}
