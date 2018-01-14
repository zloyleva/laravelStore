<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title','slug','content','product_id','type_news','type_shares','type_reviews','type_articles','thumbnail',
    ];

    public function addNewNote($data)
    {
        return Note::create([
            'title' => $data['title'],
            'slug' => str_slug($data['title'], '-'),
            'content' => $data['content'] ?? null,
            'product_id' => $data['product_id'] ?? null,
            'type_news' => $data['type_news'] ?? false,
            'type_shares' => $data['type_shares'] ?? false,
            'type_reviews' => $data['type_reviews'] ?? false,
            'type_articles' => $data['type_articles'] ?? true,
            'thumbnail' => $data['thumbnail'] ?? 'thumbnail',
        ]);
    }
}
