<?php

namespace App\Models;

use App\Core\MediaLib;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'media_id'
    ];
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function media()
    {
        return $this->belongsTo(MediaFile::class, 'media_id', 'media_id');
    }
    public static function store($request, $id = null)
    {
        $data = $request->only(['title', 'description']);

        // $data['media_id'] = MediaLib::generateImageBase64($request->image);
        if (filled($request->image)) {
            $data['media_id'] = MediaLib::generateImageBase64($request->image);
        }
        $data = self::updateOrCreate(['id' => $id], $data);

        return $data;
    }
}
