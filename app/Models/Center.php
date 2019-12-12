<?php

namespace App\Models;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @SWG\Definition()
 */
class Center extends BaseModel
{
    use SoftDeletes,SearchableTrait;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'website',
        'image',
        'email',
    ];
    protected $dates = ['deleted_at'];
    protected $appends = ['stars', 'rated', 'star'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

    public function getStarsAttribute()
    {
        return $this->teachers->reduce(function ($tart1, $item) {
            $num = $item->reviews->count() == 0 ? $item->reviews->count() : 1;
            return $tart1 += $item->reviews->reduce(function ($tart2, $item2) use ($num){
                return $tart2 += $item2->rating / $num;
            });
        });
    }
    public function getRatedAttribute()
    {
        return $this->teachers->reduce(function ($teachers, $item) {
            if ($item->reviews->count() > 0) {
                return $teachers += 1;
            }
            return $teachers;
        }, 0);
    }
    public function getStarAttribute()
    {
        return $this->getStarsAttribute() / $this->getRatedAttribute() == 0 ? 1 : $this->getRatedAttribute();
    }
}
