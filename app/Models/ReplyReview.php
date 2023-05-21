<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyReview extends Model
{
    use HasFactory;
    protected $table = "replyreview";
    protected $fillable = ["id_review", "id_user", "des", "image"];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(Account::class, "id_user");
    }
    public function review()
    {
        return $this->belongsTo(ReviewFood::class, "id_review");
    }

}
