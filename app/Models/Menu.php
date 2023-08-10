<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $table       = 'tbl_menu';
    protected $guarded     = [];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function menuOpen()
    {
        foreach ($this->children as $key) {
            $exp = explode('/', $key->url);
            if (request()->segment(2) == end($exp)) {
                return ' menu-open';
            }
        }
    }
    public function urlActiveParentChild()
    {
        foreach ($this->children as $key) {
            $exp = explode('/', $key->url);
            if (request()->segment(2) == end($exp)) {
                return ' active';
            }
        }
    }
    public function urlActive($navigation)
    {
        $exp = explode('/', $navigation);
        return request()->segment(2) == end($exp)  ? ' active' : '';
    }
}
