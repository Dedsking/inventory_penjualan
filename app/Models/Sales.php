<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // use HasFactory;
    protected $table = "sales";
    protected $primaryKey = "code_transaksi";
    protected $guarded = ['code_transaksi'];
}
