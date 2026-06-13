<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Student;
class DatabaseSeeder extends Seeder{
 public function run(): void{
  $students=[['Ayesha Khan','IT-001','👩‍🎓'],['Ali Raza','IT-002','👨‍🎓'],['Sara Noor','IT-003','🧕'],['Hamza Malik','IT-004','🧑‍💻']];
  foreach($students as $i=>$row){
   $s=Student::create(['name'=>$row[0],'roll_no'=>$row[1],'class_name'=>'BS ADP IT','avatar'=>$row[2]]);
   for($d=1;$d<=10;$d++) $s->attendances()->create(['date'=>now()->subDays(10-$d),'status'=>($d+$i)%5==0?'absent':(($d+$i)%4==0?'late':'present')]);
   $s->marks()->create(['subject'=>'Web Development','score'=>72+$i*6,'total'=>100]);
   $s->marks()->create(['subject'=>'Database','score'=>68+$i*7,'total'=>100]);
   $s->points()->create(['title'=>'Class participation','note'=>'Good effort and active response.','points'=>8,'type'=>'encourage']);
   if($i==1) $s->points()->create(['title'=>'Homework missing','note'=>'Needs to submit tasks on time.','points'=>-10,'type'=>'discourage']);
  }
 }
}
