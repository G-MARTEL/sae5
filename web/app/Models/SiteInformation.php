<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInformation extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['site_information_id','company_name','logo','linkedin_link','facebook_link','instagram_link'];

    public $timestamps = false;
}
