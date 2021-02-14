<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;

class Console extends Model
{
    use LogsActivity, Searchable, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consoles';
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
        'manufacturer_uuid',
        'type',
        'generation',
        'name',
        'released_on',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manufacturer_uuid',
        'type',
        'generation',
        'name',
        'released_on',
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
        'manufacturer_uuid' => 'uuid',
    ];
	
	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'consoles';
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
    
    // Override the toArray function (called by toJson)
    public function toArray() {
        $data = parent::toArray();
        
        if ($this->byManufacturer) {
            $data['manufacturer']['manufacturer_uuid'] = $this->byManufacturer->uuid;
            $data['manufacturer']['manufacturer_name'] = $this->byManufacturer->company;
        } else {
            $data['manufacturer'] = null;
        }
        
        if ($this->hasGames) {
            $data['games'] = count($this->hasGames);
        } else {
            $data['games'] = 0;
        }

        return $data;
    }
	
	/**
     * Get the manufacturer record associated with the console.
     */
    public function byManufacturer()
    {
        return $this->belongsTo(
            'App\Manufacturer',
            'manufacturer_uuid',
            'uuid'
        );
    }
	
	/**
     * Get the video games for the console.
     */
    public function hasGames()
    {
        return $this->hasMany(
            'App\GameHasConsole',
            'console_uuid',
            'uuid'
        );
    }

}