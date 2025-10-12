<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CertRequest extends Model
{
    protected $table = 'request_certs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'purok',
        'barangay',
        'city',
        'province',
        'date_of_birth',
        'contact_number',
        'request_type',
        'civilstatus',
        'status',
        'request_purpose'
    ];
    public $timestamps = true;
}