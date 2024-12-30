<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyRequest extends Model
{
    use HasFactory;

    protected $table = 'buy_requests';
    protected $primaryKey = 'requestID'; // Replace 'buyRequestID' with your actual column name if different
    public $incrementing = true; // Set to false if the primary key is not auto-incrementing
    protected $keyType = 'int'; // Use 'string' if your primary key is not an integer
    protected $fillable = [
        'requestID',
        'buyerName',
        'listingID',
        'agentID',
        'transaksiID',
        'listingType',
        'lokasiID',
        'hargaJualMin',
        'hargaJualMax',
        'luasTanahMin',
        'luasTanahMax',
        'luasBangunanMin',
        'luasBangunanMax',
        'kamar_tidur',
        'kamar_mandi',
        'modified_by',
    ];
    public function listing()
    {
        return $this->belongsTo(Property::class, 'listingID');
    }

    // Example: If BuyRequest is associated with an agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'agentID');
    }
}
