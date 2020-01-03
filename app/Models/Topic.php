<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'replay_count', 'view_count', 'last_replay_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序, 使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        // 预加载
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 有新回复,编写逻辑来更新模型的 reply_count 属性
        // 按照更新时间排序
        return $query->orderBy('updated_at', 'desc');
    }

    public function socpeRecent($query)
    {
        // 按时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
