<?php $__env->startSection('content'); ?>
<div class="hero mb-4">
  <div class="d-flex align-items-center gap-3 flex-wrap">
    <div class="avatar"><?php echo e($student->avatar); ?></div>
    <div><div class="xp-label">Player profile</div><h1><?php echo e($student->name); ?></h1><p class="mb-0"><?php echo e($student->roll_no); ?> • <?php echo e($student->class_name); ?> • <?php echo e($student->level()); ?></p></div>
    <div class="ms-auto text-end"><div class="score spark"><?php echo e($student->score()); ?></div><div class="xp-label">/100 Battle XP</div></div>
  </div>
</div>
<div class="row g-4">
  <div class="col-lg-7">
    <div class="card p-4 mb-4"><div class="d-flex justify-content-between mb-3"><h4 class="mb-0">📊 Power Stats</h4><span class="rank-badge">Live XP</span></div><canvas id="studentChart" height="120"></canvas></div>
    <div class="card p-4"><h4>🧾 Coach Boosts & Penalties</h4><?php $__empty_1 = true; $__currentLoopData = $student->points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><div class="p-3 rounded-4 mb-2 <?php echo e($p->points>=0?'note-pos':'note-neg'); ?>"><b><?php echo e($p->title); ?></b> <span class="badge <?php echo e($p->points>=0?'text-bg-success':'text-bg-danger'); ?>"><?php echo e($p->points>0?'+':''); ?><?php echo e($p->points); ?> XP</span><br><small><?php echo e($p->note); ?></small></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p>No XP events yet.</p><?php endif; ?></div>
  </div>
  <div class="col-lg-5">
    <div class="card p-4 mb-4"><h4>🎯 Add Attendance Move</h4><form method="post" action="/students/<?php echo e($student->id); ?>/attendance"><?php echo csrf_field(); ?><input type="date" name="date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control mb-2"><select name="status" class="form-select mb-2"><option value="present">Present: active mission</option><option value="late">Late: small penalty</option><option value="absent">Absent: missed mission</option></select><button class="btn btn-success w-100">Save Move</button></form></div>
    <div class="card p-4 mb-4"><h4>🧠 Add Challenge Marks</h4><form method="post" action="/students/<?php echo e($student->id); ?>/marks"><?php echo csrf_field(); ?><input name="subject" placeholder="Subject / Challenge" class="form-control mb-2"><input name="score" type="number" placeholder="Score" class="form-control mb-2"><input name="total" type="number" value="100" class="form-control mb-2"><button class="btn btn-info w-100">Add Result</button></form></div>
    <div class="card p-4"><h4>⚡ Add XP Event</h4><form method="post" action="/students/<?php echo e($student->id); ?>/points"><?php echo csrf_field(); ?><input name="title" placeholder="Teamwork win / Homework missed" class="form-control mb-2"><textarea name="note" placeholder="Coach note" class="form-control mb-2"></textarea><input name="points" type="number" placeholder="Use +10 or -5" class="form-control mb-2"><select name="type" class="form-select mb-2"><option value="encourage">Boost</option><option value="discourage">Penalty</option></select><button class="btn btn-warning w-100">Apply XP</button></form></div>
  </div>
</div>
<script>
const attendance=<?php echo e($student->attendances()->where('status','present')->count()); ?>;const absent=<?php echo e($student->attendances()->where('status','absent')->count()); ?>;const late=<?php echo e($student->attendances()->where('status','late')->count()); ?>;const avg=<?php echo e($student->marks->count()?round(($student->marks->sum('score')/$student->marks->sum('total'))*100):0); ?>;const pts=<?php echo e($student->points->sum('points')); ?>;
new Chart(document.getElementById('studentChart'),{type:'bar',data:{labels:['Present','Absent','Late','Marks %','XP Events'],datasets:[{label:'Power stats',data:[attendance,absent,late,avg,pts],borderRadius:12}]},options:{plugins:{legend:{display:false},title:{display:true,text:'Player performance power stats',color:'#fff'}},scales:{x:{ticks:{color:'#dce6ff'},grid:{color:'rgba(255,255,255,.06)'}},y:{beginAtZero:true,ticks:{color:'#dce6ff'},grid:{color:'rgba(255,255,255,.08)'}}}}});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hclod\Downloads\glowscore_portal\resources\views/students/show.blade.php ENDPATH**/ ?>