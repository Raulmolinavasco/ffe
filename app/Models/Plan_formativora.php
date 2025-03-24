<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Testing\Fluent\Concerns\Has;

class Plan_formativora extends Pivot
{
    use HasFactory;
}
