<?php

namespace App\Http\Controllers;

use File;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller
{
  public function __construct()
  {
    $this->middleware("auth")->except(["index"]);
  }

  public function index(): \Inertia\Response
  {
    return Inertia::render('Posts/Index', [
      "posts" => Post::orderBy('id', 'DESC')->paginate(10),
    ]);
  }

  public function create(): \Inertia\Response
  {
    return Inertia::render('Posts/Create');
  }

  /**
   * @throws ValidationException
   */
  public function store(Request $request): \Illuminate\Http\RedirectResponse
  {
    $this->getValidate($request);
    $post = new Post();
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    if ($request->file('image')) {
      $post->image = $this->upload($request);
    }
    $post->save();
    $request->session()->flash('success', 'Post created successfully!');
    return redirect()->route('post.index');
  }

  /**
   * @param Request $request
   * @param null    $id
   *
   * @throws ValidationException
   */
  private function getValidate(Request $request, $id = null): void
  {
    $data = [
      'title' => 'required',
      'content' => 'required',
    ];
    $this->validate($request, $data);
  }

  private function upload($request)
  {
    $image = $request->file('image');
    $imageName = md5(uniqid()) . "." . $image->getClientOriginalExtension();
    $image->move(public_path('storage/uploads'), $imageName);
    return $imageName;
  }

  public function edit($id): \Inertia\Response
  {
    return Inertia::render('Posts/Edit', [
      'post' => Post::findOrFail($id),
    ]);
  }

  /**
   * @throws ValidationException
   */
  public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
  {
    $this->getValidate($request, $id);
    $post = Post::find($id);
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    if ($request->file('image')) {
      $post->image = $this->upload($request);
    }
    $post->save();
    $request->session()->flash('success', 'Post updated successfully!');
    return redirect()->route('post.index');
  }

  public function destroy(Request $request, Post $post): \Illuminate\Http\RedirectResponse
  {
    $post->delete();
    File::delete(public_path('storage/uploads/' . $post->image));
    $request->session()->flash('success', 'Post deleted successfully!');
    return redirect()->route('post.index');
  }
}
