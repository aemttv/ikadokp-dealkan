<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'listing'; // Ensure this matches your table name
    protected $primaryKey = 'listingID';
    public $incrementing = true; // Set to false if the primary key is not auto-incrementing
    protected $keyType = 'int'; // Change this to 'string' if the primary key is not an integer

    protected $fillable = ['title', 'agentID', 'transaksiID', 'ownershipID', 'listingType', 'sertifikatType', 'kondisiType', 'komisi', 'vendorName', 'VendorPhone', 'alamat', 'lantai', 'lokasiID', 'orientasiID', 'posisiID', 'hargaJual', 'hargaJualMax', 'luasTanah', 'luasBangunan', 'dimPanjang', 'dimeLebar', 'ktUtama', 'ktLain', 'kmUtama', 'kmLain', 'carport', 'deskripsi', 'alasan', 'kondisiPerabotanID', 'listrikID', 'image_main', 'image_second', 'image_third', 'ownershipListingID', 'isPrimary', 'statusListing', 'created_at', 'updated_at', 'modified_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'agentID'); // Assuming 'agentID' links to 'id' in User model
    }

    public function buyRequests()
    {
        return $this->hasMany(BuyRequest::class);
    }
}
