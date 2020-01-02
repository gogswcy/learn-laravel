<?php
namespace App\Handlers;

class ImageuploadHandler
{
    // 允许后缀
    protected $allow_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // 文件的切割让查找更有效率
        $folder_name = "uploads/images/$folder/" . date('Ym/d', time());

        // public_path() 获取的是文件夹的物理路径
        $upload_path = public_path() . '/' . $folder_name;

        // 后缀
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $file_prefix . '_' . time() . \Str::random(10) . '.' . $extension;

        if (! in_array($extension, $this->allow_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        return [
            'path' => "/$folder_name/$filename"
        ];
    }
}