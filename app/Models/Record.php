<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'records';

    private static int $report_id = 1;

    static function getReportId() : int {
        return self::$report_id;
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfessionCode()
    {
        $array = explode(' - ', $this->profession);
        return $array[0];
    }
    public function getProfessionName()
    {
        $array = explode(' - ', $this->profession);
        return $array[1];
    }
}
