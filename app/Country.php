<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    protected $primaryKey = 'uuid';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
		'deleted_at',
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    /**
     * The attributes that can be translatable.
     *
     * @var array
     */
    public $translatable = [
        'languages',
        'name_native',
        'name_translations',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'uuid',
    ];
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        
        $array = array(
            'uuid' => $this->uuid,
            'languages-en' => $this->getTranslation('languages', 'en'),
            'languages-fr' => $this->getTranslation('languages', 'fr'),
            'name-native-en' => $this->getTranslation('name_native', 'en'),
            'name-native-fr' => $this->getTranslation('name_native', 'fr'),
            'name-translations-en' => $this->getTranslation('name_translations', 'en'),
            'name-translations-fr' => $this->getTranslation('name_translations', 'fr'),
        );

        return $array;
    }
	
	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'coutries';
    }
	
	/**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    
    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    
    /**
     * Get all the artists for an edition.
     */
    public function artists()
    {
        return $this->hasManyThrough(
            'App\EditionHasArtist',
            'App\Contact',
            'nationality',
            'artist_uuid',
            'uuid',
            'nationality'
        );
    }
}