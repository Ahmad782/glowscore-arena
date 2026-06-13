<?php $__env->startSection('content'); ?>
<div class="hero mb-4">
  <div class="row align-items-center g-4">
    <div class="col-md-8">
      <div class="xp-label mb-2">Live class battle dashboard</div>
      <h1 class="battle-title">Student Performance Arena ⚔️</h1>
      <p class="mb-0">Track XP, attendance streaks, marks, bonus points, penalties, ranks and class leaderboard in one competitive portal.</p>
    </div>
    <div class="col-md-4 text-md-end">
      <div class="score spark"><?php echo e($avg); ?>%</div>
      <div class="xp-label">Class XP Average</div>
    </div>
  </div>
</div>
<div class="row g-4 mb-4">
  <div class="col-md-4"><div class="card stat-card p-4"><div class="xp-label">Players</div><div class="score"><?php echo e($students->count()); ?></div><div class="mini">Total students in arena</div></div></div>
  <div class="col-md-4"><div class="card stat-card p-4"><div class="xp-label">Elite Zone</div><div class="score"><?php echo e($students->filter(fn($s)=>$s->score()>=75)->count()); ?></div><div class="mini">High scoring competitors</div></div></div>
  <div class="col-md-4"><div class="card stat-card p-4"><div class="xp-label">Danger Zone</div><div class="score"><?php echo e($students->filter(fn($s)=>$s->score()<60)->count()); ?></div><div class="mini">Need comeback mission</div></div></div>
</div>
<div class="card p-4 mb-4"><div class="d-flex justify-content-between align-items-center mb-3"><h4 class="mb-0">🏆 Leaderboard</h4><span class="rank-badge">XP Ranking</span></div><canvas id="classChart" height="90"></canvas></div>
<div class="row g-4">
<?php $__currentLoopData = $students->sortByDesc(fn($s)=>$s->score()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-4"><div class="card student-card p-4 h-100">
  <div class="d-flex justify-content-between align-items-start"><div><div class="avatar"><?php echo e($s->avatar?:'🎮'); ?></div><span class="rank-badge">#<?php echo e($index+1); ?> Rank</span></div><form method="post" action="/students/<?php echo e($s->id); ?>" onsubmit="return confirm('Delete student?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-sm btn-outline-danger">×</button></form></div>
  <h4 class="mt-3 mb-1"><?php echo e($s->name); ?></h4><p class="text-muted mb-2"><?php echo e($s->roll_no); ?> • <?php echo e($s->class_name); ?></p>
  <div class="fw-bold mb-2"><?php echo e($s->level()); ?></div>
  <div class="progress mb-2"><div class="progress-bar" style="width:<?php echo e($s->score()); ?>%"></div></div>
  <p class="mb-3"><span class="xp-label">Battle XP</span><br><b class="fs-4"><?php echo e($s->score()); ?>/100</b></p>
  <a href="/students/<?php echo e($s->id); ?>" class="btn btn-primary w-100">Enter Arena</a>
</div></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<script>
new Chart(document.getElementById('classChart'),{type:'bar',data:{labels:<?php echo json_encode($students->sortByDesc(fn($s)=>$s->score())->pluck('name')->values(), 15, 512) ?>,datasets:[{label:'XP Score',data:<?php echo json_encode($students->sortByDesc(fn($s)=>$s->score())->map(fn($s)=>$s->score())->values(), 15, 512) ?>,borderWidth:1,borderRadius:12}]},options:{plugins:{legend:{display:false},title:{display:true,text:'Class XP Leaderboard',color:'#fff'},tooltip:{callbacks:{label:(c)=>' XP: '+c.raw+'/100'}}},scales:{x:{ticks:{color:'#dce6ff'},grid:{color:'rgba(255,255,255,.06)'}},y:{beginAtZero:true,max:100,ticks:{color:'#dce6ff'},grid:{color:'rgba(255,255,255,.08)'}}}}});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hclod\Downloads\glowscore_portal\resources\views/students/index.blade.php ENDPATH**/ ?>