<?php

namespace App\Domain\Importacao\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    use HasFactory;

    protected $table = 'importacoes';
    protected $guarded = [];
}
