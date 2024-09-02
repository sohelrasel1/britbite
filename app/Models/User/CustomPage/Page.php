<?php

namespace App\Models\User\CustomPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
    use HasFactory;

    public $table = "user_pages";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'status'];

    public function content(): HasMany
    {
        return $this->hasMany(PageContent::class, 'page_id', 'id');
    }
}
