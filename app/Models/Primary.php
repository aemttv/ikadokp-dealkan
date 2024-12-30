<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Primary extends Model
{
    use HasFactory;

    protected $table = 'primary_listing'; // Ensure this matches your table name
    protected $primaryKey = 'primaryID';
    public $incrementing = true; // Set to false if the primary key is not auto-incrementing
    protected $keyType = 'int'; // Change this to 'string' if the primary key is not an integer

    protected $fillable = ['agentID', 'title', 'link_drive', 'deskripsi', 'image_main', 'image_second', 'image_third', 'statusListing'];

    public function user()
    {
        return $this->belongsTo(User::class, 'agentID'); // Assuming 'agentID' links to 'id' in User model
    }

    public function buyRequests()
    {
        return $this->hasMany(BuyRequest::class);
    }
}
