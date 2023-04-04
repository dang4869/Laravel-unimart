<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next){
           session(['module_active'=>'post']);
           return $next($request);
        });
    }
    function list(Request $request)
    {
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $posts = Post::where('title', 'LIKE', "%{$keyword}%")->paginate(10);
        return view('admin.post.list', compact('posts'))->with('i',(request()->input('page',1)-1)*10);
    }
    function add()
    {
        $category_posts = CategoryPost::all();
        return view('admin.post.add', compact('category_posts'));
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:100|min:5',
                'content' => 'required',
                'category_post_id' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'title' => 'Tiêu đề',
                'content' => 'Nội dung',
                'category_post_id' => 'Danh mục bài viết',
                'slug'=>'Link thân thiện',
            ]
            );

        $input = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file;
            //    Lấy tên file
            $filename = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            // Upload file lên server
            $path = $file->move('public/uploads/post', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/post/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }
        // $input['slug']='Bảo-rất-sề';
        // dd($input);
        if($input['category_post_id'] == 0){
            Toastr::error('Bạn thêm bài viết thất bại vì chưa chọn danh mục bài viết', 'Thông báo');
            return redirect()->back();
        }
        Post::create($input);
        // return $request->input();
        Toastr::success('Thêm mới bài viết thành công', 'Thông báo');
        return redirect('admin/post/list');
    }
    function delete($id){
          $post = Post::find($id);
          $post_image = $post->thumbnail;
          if($post_image){
            unlink($post_image);
          }
          $post->delete();
          Toastr::success('Bạn đã xóa bài viết thành công', 'Thông báo');
            return redirect('admin/post/list');
    }
    function action(Request $request){
        $list_check = $request->input('list_check');
        if($list_check){
            if(!empty($list_check)){
                $act = $request->input('act');
                if($act == 'delete'){
                    Post::destroy($list_check);
                    Toastr::success('Bạn đã xóa bài viết thành công', 'Thông báo');
                    return redirect('admin/post/list');
                }
            }
        }else{
            Toastr::error('Bạn cần chọn phần tử để thực hiện', 'Thông báo');
            return redirect()->back();
        }
    }
    function edit($id){
        $post = Post::find($id);
        $category_posts = CategoryPost::all();
        return view('admin.post.edit', compact('post','category_posts'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'title' => 'required|max:100|min:5',
                'content' => 'required',
                'category_post_id' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'title' => 'Tiêu đề',
                'content' => 'Nội dung',
                'category_post_id' => 'Danh mục bài viết',
                'slug' => 'Danh mục bài viết',
            ]
            );
        $post = Post::find($id);
        // $input = $request->all();
        if ($request->hasFile('file')) {
            $post_image_old = $post->thumbnail;
            // $path = 'public/uploads/post/' . $post_image_old;
            unlink($post_image_old);
            $file = $request->file;
            //    Lấy tên file
            $filename = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            // Upload file lên server
            $path = $file->move('public/uploads/post', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/post/' . $filename;

            // $input['thumbnail'] = isset($thumbnail) ? $thumbnail: $post->thumbnail;
        }
        if(request()->input('category_post_id') == 0){
            Toastr::error('Bạn chỉnh sửa bài viết thất bại', 'Thông báo');
            return redirect()->back();
        }
        // $input['category_post_id']=3;
        Post::where('id',$id)->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'thumbnail'=>isset($thumbnail) ? $thumbnail: $post->thumbnail,
            'category_post_id'=>$request->category_post_id,
            'slug'=>$request->slug
        ]);
        // return $request->input();
        Toastr::success('Chỉnh sửa bài viết thành công', 'Thông báo');
        return redirect('admin/post/list');
    }
}
