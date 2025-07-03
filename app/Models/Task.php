<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Task extends Model {

    protected $fillable = ['name', 'description', 'due_date', 'status_id', 'priority_id'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function priority() {
        return $this->belongsTo(Priority::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function generatePublicToken(): void {
        $this->public_token = Str::random(40);
        $threeDaysLater = Carbon::now()->addDays(3);
        $this->public_token_expires_at = $threeDaysLater;
        $this->save();
    }

    public function revokePublicToken() {
        $this->public_token = null;
        $this->public_token_expires_at = null;
        $this->save();
    }
}
