<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'replay_count', 'view_count', 'last_replay_user_id', 'order', 'excerpt', 'slug'];
}
