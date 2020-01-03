<?php
namespace App\Handlers;
use Image;

class ImageuploadHandler
{
    // 允许后缀
    protected $allow_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $file_prefix, $max_width = false)
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

        // 裁减
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => "/$folder_name/$filename"
        ];
    }

    /**
     * 裁减图片
     */
    public function reduceSize($file_path, $max_width)
    {
        // 传参, 磁盘路径
        $image = Image::make($file_path);

        // 进行大小的调整
        $image->resize($max_width, null, function ($constrait) {
            // 等比例缩放
            $constrait->aspectRatio();
            // 防止图片尺寸变大
            $constrait->upsize();
        });
        // 保存
        $image->save();
    }
}