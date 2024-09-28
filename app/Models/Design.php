<?php

namespace App\Models;

use App\Enums\DesignPrintType;
use App\Enums\UserRole;
use App\Models\Traits\Fileable;
use App\Models\Traits\Filterable;
use App\Models\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DesignFile;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Design extends Model
{
    use HasFactory, Filterable, Taggable, Fileable;
    use HasJsonRelationships;

    protected $fillable = [
        'code',
        'name',
        'print_type',
        'design_type',
        'downloadable',
        'status',
        'private',
        'designer_id',
        'package',
        'category_id',
        'color_ids',
        'related_ids',
        'pinterest_link',
        'colored_fabric',
    ];

    protected $appends = ['tag_ids'];
    protected $attributes = ['downloadable' => 1, 'code' => 33];
    protected $casts = [
        'color_ids' => 'array',
        'related_ids' => 'array',
        'colored_fabric' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function siteFiles()
    {
        return $this->files()

            ->withPivotValue('section', 'site')
        ;
    }

    public function colors()
    {
        return $this->belongsToJson(Palette::class, 'color_ids');
    }
    public function related()
    {
        return $this->belongsToJson(self::class, 'related_ids');
    }

    public function printFiles()
    {
        return $this->belongsToMany(DesignFile::class, 'design_design_file', 'design_id', 'design_file_id');
        return $this->hasMany(DesignFile::class, 'design_id');
    }

    public function accessorySupplier()
    {
        return $this->hasMany(AccessorySupplier::class, 'design_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'design_users', 'design_id', 'user_id');
    }

    protected static function boot()
    {

        parent::boot();
        static::creating(function ($model) {
            $print_file_name = $model->print_type == 'sub' ? ($model->design_type == 'single' ? 'SO' : 'ST') : 'DT';
            $model->fill([
                'code' => $print_file_name . rand(100000, 999999)
            ]);
        });

        static::updating(function ($model) {
            $print_file_name = $model->print_type == 'sub' ? ($model->design_type == 'single' ? 'SO' : 'ST') : 'DT';
            $model->fill([
                'code' => $print_file_name . substr($model->code, 2)
            ]);
        });
    }

    protected static function booted(): void
    {
        static::addGlobalScope('access', function (Builder $builder) {
            $user = request()->user('sanctum');

            if ($user && $user->role == UserRole::ADMIN->value)
                return $builder;
            else
                $builder->where('private', false)->orWhereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id ?? null);
                });
        });
    }
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    protected function tagIds(): Attribute
    {
        return new Attribute(
            get: fn() => $this->tags->pluck('id')
        );
    }





    // protected function colors(): Attribute
    // {

    //     return new Attribute(
    //         set: fn($value) => json_encode($value),
    //         get: fn($value) => Palette::whereIn('id', json_decode($value, true) ?? [])->get()->toArray(),

    //     );
    // }



    public function jsonSerialize(): mixed
    {

        return [

            ...$this->toArray(),
            'print_type_fa' => trans("messages.print_type." . $this->print_type),
            'design_type_fa' => trans("messages.design_type." . $this->design_type)

        ];
    }

    public function scopeModelFilter($query)
    {
        $request = request();
        $search = $request->input('search');

        if ($request->filled('search')) {
            $query->whereHas('tags', function ($query) use ($search) {

                $search_array = array_filter(explode(' ', $search), function ($item) {

                    return (strlen($item) > 2 && $item);
                });

                // dd($search_array) ;
                $query->where('name', 'like', "%$search%")->orWhere('name', 'in', $search_array);
            });
        }
        if ($request->filled('color_ids')) {
            $query->where(function ($query) use ($request) {

                foreach ($request->input('color_ids') as $k => $color)
                    $k == 0 ? $query->whereJsonContains('color_ids', (int) $color) : $query->orWhereJsonContains('color_ids', (int) $color);


                //->whereJsonContains('color_ids',array_map(function($item){return (int)$item ;},$request->input('color_ids')))
            });
        }
    }
}
