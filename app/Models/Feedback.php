<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = ['title', 'description', 'rating'];

    public const RATING_POSITIVO = 'positivo';
    public const RATING_NEGATIVO = 'negativo';

    public function isPositivo(): bool
    {
        return $this->rating === self::RATING_POSITIVO;
    }

    public function isNegativo(): bool
    {
        return $this->rating === self::RATING_NEGATIVO;
    }
}
