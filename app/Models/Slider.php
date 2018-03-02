<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable =[
        'name',
        'img_url',
        'show_status',
        'link_url',
        'light_theme',
        'text_title',
        'text_content',
        'text_button',
        'position',
    ];

    public function addNewSlider($data,$path)
    {
        return Slider::create([
            'name' => $data['name'],
            'img_url' => $path,
            'show_status' => $data['show_status'] ?? false,
            'link_url' => $data['link_url']?? null,
            'light_theme' => $data['light_theme'] ?? false,
            'text_title' => $data['text_title'] ?? '',
            'text_content' => $data['text_content'] ?? '',
            'text_button' => $data['text_button'] ?? '',
            'position' => $data['manager_id']??0,
        ]);
    }

    public function getAllPublishedSlides(){
        return $this->where('show_status', 1)->get();
    }
}
