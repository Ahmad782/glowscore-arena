<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Student extends Model {
 protected $fillable=['name','roll_no','class_name','avatar','email'];
 public function attendances(){return $this->hasMany(Attendance::class);}
 public function marks(){return $this->hasMany(Mark::class);}
 public function points(){return $this->hasMany(PointNote::class);}
 public function score(){
  $attendanceTotal=$this->attendances()->count();
  $present=$this->attendances()->where('status','present')->count();
  $attendanceScore=$attendanceTotal? round(($present/$attendanceTotal)*30):0;
  $marks=$this->marks()->get();
  $performanceScore=$marks->count()? round(($marks->sum('score')/$marks->sum('total'))*50):0;
  $points=$this->points()->sum('points');
  return max(0,min(100,$attendanceScore+$performanceScore+$points));
 }
 public function level(){
  $s=$this->score();
  return $s>=90?'🏆 Legend Rank':($s>=75?'⚔️ Elite Challenger':($s>=60?'🚀 Rising Player':($s>=40?'🛡️ Comeback Mission':'🚨 Danger Zone')));
 }
}
