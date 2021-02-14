<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Profession extends Model
{
    use HasTranslations, LogsActivity, Searchable, SoftDeletes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professions';
    protected $primaryKey = 'uuid';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profession',
    ];
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'profession',
    ];
    
    public $translatable = [
        'profession',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

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
            'profession-en' => $this->getTranslation('profession', 'en'),
            'profession-fr' => $this->getTranslation('profession', 'fr'),
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
        return 'professions';
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
     * Get all the contact working in a episode of a podcast.
     */
    public function workAsInEpisode()
    {
		return $this->hasMany(
            'App\EpisodeHasStaff',
            'profession_uuid',
            'uuid'
		);
    }
	
    /**
     * Get all the contact working in a video game.
     */
    public function workAsInGame()
    {
		return $this->hasMany(
            'App\GameHasStaff',
            'profession_uuid',
            'uuid'
		);
    }

}
