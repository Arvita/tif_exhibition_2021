<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'group_name', 'group_leader', 'group_leader_nim', 'group_member', 'group_email', 'group_phone',
        'semester', 'group_clas', 'title', 'description', 'category', 'platform', 'featured_picture',
        'link_video', 'link_web', 'link_mobile', 'link_desktop', 'link_ig_poster'
    ];

    public function visits()
    {
        return visits($this)->relation();
    }

    public function kategori()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
}
