<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\User;
use Auth;
use App\Handlers\ImageuploadHandler;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, User $user)
	{
		$topics = Topic::withOrder($request->order)->paginate();
		return view('topics.index', compact('topics'), compact('user'));
	}

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
		$category = Category::all();
		return view('topics.create_and_edit', compact('topic', 'category'));
	}

	public function store(TopicRequest $request)
	{
		$topic = Topic::create($request->all());
		$topic->user_id = Auth::id();
		$topic->save();
		return redirect()->route('topics.show', $topic->id)->with('message', 'Created successfully.');
	}

	public function edit(Topic $topic)
	{
		$this->authorize('update', $topic);
		$categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', '更新成功.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}

	// 上传图片
	public function uploadImage(Request $request, ImageUploadHandler $uploader)
	{
		// 初使化返回数组
		$data = [
			'success' => false,
			'msg' => '上传失败!',
			'file_path' => ''
		];
		// 判断是否有上传文件并赋值给$file
		if ($file = $request->upload_file) {
			// 保存文件到本地
			$result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
			// 图片保存成功的话
			if ($result) {
				$data['success'] = true;
				$data['msg'] = '上传成功!';
				$data['file_path'] = $result['path'];
			}
		}
		return $data;	
	}
}