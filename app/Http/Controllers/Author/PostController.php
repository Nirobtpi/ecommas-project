<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use function Pest\Laravel\post;



class PostController extends Controller
{
    public function post(){
        $categories=Category::get();
        $tags=Tag::get();
        return view('frontend.author.post.add-post',compact('categories','tags'));
    }

    public function post_store(Request $request){
        $request->validate([
            'title'=>['required','unique:posts,title'],
            'description'=>['required'],
            'category'=>['required','exists:categories,id'],
            'read_time'=>['required','numeric'],
            'tag'=>['required'],
            'preview_image'=>['required','mimes:jpeg,png,jpg,svg'],
            'thumbnail_image'=>['required','mimes:jpeg,png,jpg,svg'],
        ]);

        $slug=Str::lower(str_replace(' ','-',$request->title).'-'.random_int(1111,9999));

        // preview Image 
        $preview=$request->preview_image;

        $previewEx=$preview->extension();

        $previewImageFileName='post-preview'.rand(1111,9999).'.'.$previewEx;

        $PreviewManager = new ImageManager(new Driver());

        $PreviewImage = $PreviewManager->read($preview);

        $PreviewImage->resize(1000,600);

        $PreviewImage->save(public_path('uploads/post/preview/').$previewImageFileName);


        // Thumbnail Image 
        $thumbnail_image=$request->thumbnail_image;

        $thumbnail_image_Ex=$thumbnail_image->extension();

        $thumbnail_image_name='post-thumbnail'.rand(1111,9999).'.'.$thumbnail_image_Ex;

        $thumbnail_image_manager = new ImageManager(new Driver());

        $thumbnail_image_read = $thumbnail_image_manager->read($thumbnail_image);
        $thumbnail_image_read->resize(300,300);

        $thumbnail_image_read->save(public_path('uploads/post/thumbnail/').$thumbnail_image_name);

        $tagid=$request->tag;

       
        

        Post::create([
            'author_id'=>Auth::guard('author')->id(),
            'title'=>$request->title,
            'slug'=>$slug,
            'description'=>$request->description,
            'category_id'=>$request->category,
            'read_time'=>$request->read_time,
            'tag_id'=>implode(',',$tagid),
            'preview_image'=>$previewImageFileName,
            'thumbnail_image'=>$thumbnail_image_name,

        ]);
        
        return back()->with('add_post','Your Post Added Successfully!');
        
        
    }
    public function my_post(){
         $authorId = Auth::guard('author')->id();
        $posts=Post::where('author_id',$authorId)->paginate(2);
        return view('frontend.author.post.my-post',compact('posts'));
    }

    public function active_post($id){
       $post= Post::findOrFail($id);

       if($post->status == 1){
        $post->update([
            'status'=>0,
        ]);
        return back()->with('post_deactive','Your Post Deactived!');
       }else{
        $post->update([
            'status'=>1,
        ]);
        return back()->with('post_active','Your Post Published Now');
       }
    }
    public function post_delete($id){
       $post= Post::findOrFail($id);

    //    preview image delete 

        if($post->preview_image !=''){
            unlink(public_path('uploads/post/preview/').$post->preview_image);
        }
    //    thumbnail image delete 

        if($post->thumbnail_image !=''){
            unlink(public_path('uploads/post/thumbnail/').$post->thumbnail_image);
        }

        $post->forceDelete();

        return back()->with('delete','Post Deleted Successfully');
    }
}
