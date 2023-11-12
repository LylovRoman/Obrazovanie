<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ReportUser extends Model
{
    use HasFactory;

    protected $table = 'report_user';
    protected $guarded = false;

    // Определение связи с моделью Report
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    // Определение связи с моделью User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
