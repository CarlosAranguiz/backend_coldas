<?php

namespace App\Http\Resources;

use App\Models\PostDocument;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $documentos = PostDocument::where('post_id', $this->id)->get();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'category' => $this->category,
            'author' => $this->author,
            'content' => $this->content,
            'only_image' => $this->only_image == 0 ? false : true,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => $this->updated_at,
            'documents' => $documentos,
        ];
    }
}
