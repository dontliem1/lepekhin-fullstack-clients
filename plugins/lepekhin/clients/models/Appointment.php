<?php

namespace Lepekhin\Clients\Models;

use Illuminate\Support\Carbon;
use Winter\Storm\Database\Model;

/**
 * Appointment Model
 *
 * @property Argon $starts_at Время записи
 * @property Client $client Клиент
 */
class Appointment extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'lepekhin_clients_appointments';

    public array $rules = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'starts_at',
    ];

    protected $appends = [
        'beauty_start_at'
    ];

    public $belongsTo = [
        'client' => Client::class,
    ];

    /**
     * @return string|null
     */
    public function getBeautyStartAtAttribute(): ?string
    {
        if (!$this->starts_at) {
            return null;
        }

        return Carbon::parse($this->starts_at)->isoFormat('DD MMMM YYYY [г] HH:mm');
    }
}
