<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'created_at', 'excerpt', 'slug'];
    public function category()
    {

        return $this->belongsTo(Category::class);
    }
    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order){
        switch ($order){
            case 'recent':
                $query->recent();
                back;
            
            default:
            $query->recentReplied(); 
            break;
        }
    }
    
    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    public function scopeRecentReplied($query){
        return $query->orderBy('created_at','desc');
    }

    public function recentReplied(){
        return $query->orderBy('created_at','desc');
    }
}
