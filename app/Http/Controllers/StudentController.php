<?php
namespace App\Http\Controllers;
use App\Models\{Student,Attendance,Mark,PointNote};
use Illuminate\Http\Request;
class StudentController extends Controller{
 public function index(){
  $students=Student::with(['attendances','marks','points'])->latest()->get();
  $avg=round($students->map(fn($s)=>$s->score())->avg()??0);
  return view('students.index',compact('students','avg'));
 }
 public function create(){return view('students.create');}
 public function store(Request $r){Student::create($r->validate(['name'=>'required','roll_no'=>'required|unique:students','class_name'=>'required','email'=>'nullable|email','avatar'=>'nullable']));return redirect('/')->with('ok','Player added to arena ⚡');}
 public function show(Student $student){$student->load(['attendances','marks','points']);return view('students.show',compact('student'));}
 public function addAttendance(Request $r,Student $student){$data=$r->validate(['date'=>'required|date','status'=>'required|in:present,absent,late']);$student->attendances()->create($data);return back()->with('ok','Attendance saved ✅');}
 public function addMark(Request $r,Student $student){$data=$r->validate(['subject'=>'required','score'=>'required|integer|min:0','total'=>'required|integer|min:1']);$student->marks()->create($data);return back()->with('ok','Challenge result added 🧠');}
 public function addPoint(Request $r,Student $student){$data=$r->validate(['title'=>'required','note'=>'nullable','points'=>'required|integer','type'=>'required|in:encourage,discourage']);$student->points()->create($data);return back()->with('ok','XP event added ⚡');}
 public function destroy(Student $student){$student->delete();return redirect('/')->with('ok','Student deleted');}
}
