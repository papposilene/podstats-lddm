<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class GameHasConsole extends Model
{
    use LogsActivity, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videogames_has_consoles';
    protected $primaryKey = 'uuid';
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are loggable.
     *
     * @var array
     */
    protected static $logAttributes = [
        'game_uuid',
        'console_uuid',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_uuid',
        'console_uuid',
    ];

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'uuid',
        'game_uuid' => 'uuid',
        'console_uuid' => 'uuid',
    ];
	
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
     * Get the console.
     */
    public function hasConsole()
    {
        return $this->hasOne(
            'App\Console',
            'uuid',
            'console_uuid'
        );
    }
    
    /**
     * Get the game.
     */
    public function hasGame()
    {
        return $this->hasOne(
            'App\Game',
            'uuid',
            'game_uuid'
        );
    }
    
    /**
     * Get the genres of a game.
     */
    public function hasGenres()
    {
        return $this->hasMany(
            'App\GameHasGenre',
            'game_uuid',
            'game_uuid'
        );
    }
}