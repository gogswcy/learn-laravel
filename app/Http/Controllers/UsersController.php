<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageuploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
        if (config('app.subdir'))
            $user->avatar = config('app.subdir') . $user->avatar;
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        if (config('app.subdir'))
            $user->avatar = config('app.subdir') . $user->avatar;
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageuploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if ($request->avatar) {
            $result =  $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功');
    }
}
