<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function tag(){
        $tags=Tag::all();
        return view('admin.tag.tag',compact('tags'));
    }
    public function tag_store(Request $request){
        Tag::create([
            'name'=>$request->name,
        ]);
        
        return back()->with('tag_add','Tag Added Successfully');
    }

    public function tag_softdelete($id){
        Tag::findOrFail($id)->delete();
        return back()->with('tag_delete','Tag Deleted Successfully');
    }

    public function tag_checkdelete(Request $request){
        foreach($request->tag_id as $tadId){
            Tag::findOrFail($tadId)->delete();
        }
        return back()->with('tag_delete','Tag Deleted Successfully');
    }

    public function trash(){
        $tags=Tag::onlyTrashed()->get();
        return view('admin.tag.tag-trash',compact('tags'));
    }

    public function checkrestoredelete(Request $request){
        if($request->action_btn == 1){
            foreach($request->tag_id as $tadId){
                Tag::onlyTrashed()->findOrFail($tadId)->restore();
            }
        }else{
            foreach($request->tag_id as $tadId){
                Tag::onlyTrashed()->findOrFail($tadId)->forceDelete();
            }
        }
        return back()->with('tag','Your Work successfully Completed');
    }

    // tag update 
    public function tagEdit($id){
        $tag=Tag::findOrFail($id);
        return view('admin.tag.tag-edit',compact('tag'));
    }
    public function tagUpdate(Request $request, $id){
        Tag::findOrFail($id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('tag')->with('tag_update','Tag Updated Successfully');
    }

}
