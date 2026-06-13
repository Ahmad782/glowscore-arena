<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PointNote extends Model {protected $fillable=['student_id','title','note','points','type']; public function student(){return $this->belongsTo(Student::class);} }
