@extends('layout')
@section('content')
<div class="hero mb-4">
  <div class="row align-items-center g-4">
    <div class="col-md-8">
      <div class="xp-label mb-2">Live class battle dashboard</div>
      <h1 class="battle-title">Student Performance Arena ⚔️</h1>
      <p class="mb-0">Track XP, attendance streaks, marks, bonus points, penalties, ranks and class leaderboard in one competitive portal.</p>
    </div>
    <div class="col-md-4 text-md-end">
      <div class="score spark">{{$avg}}%</div>
      <div class="xp-label">Class XP Average</div>
    </div>
  </div>
</div>
<div class="row g-4 mb-4">
  <div class="col-md-4"><div class="card stat-card p-4"><div class="xp-label">Players</div><div class="score">{{$students->count()}}</div><div class="mini">Total students in arena</div></div></div>
  <div class="col-md-4"><div class="card stat-card p-4"><div class="xp-label">Elite Zone</div><div class="score">{{$students->filter(fn($s)=>$s->score()>=75)->count()}}</div><div class="mini">High scoring competitors</div></div></div>
  <div class="col-md-4"><div class="card stat-card p-4"><div class="xp-label">Danger Zone</div><div class="score">{{$students->filter(fn($s)=>$s->score()<60)->count()}}</div><div class="mini">Need comeback mission</div></div></div>
</div>
<div class="card p-4 mb-4"><div class="d-flex justify-content-between align-items-center mb-3"><h4 class="mb-0">🏆 Leaderboard</h4><span class="rank-badge">XP Ranking</span></div><canvas id="classChart" height="90"></canvas></div>
<div class="row g-4">
@foreach($students->sortByDesc(fn($s)=>$s->score()) as $index=>$s)
<div class="col-md-4"><div class="card student-card p-4 h-100">
  <div class="d-flex justify-content-between align-items-start"><div><div class="avatar">{{$s->avatar?:'🎮'}}</div><span class="rank-badge">#{{$index+1}} Rank</span></div><form method="post" action="/students/{{$s->id}}" onsubmit="return confirm('Delete student?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">×</button></form></div>
  <h4 class="mt-3 mb-1">{{$s->name}}</h4><p class="text-muted mb-2">{{$s->roll_no}} • {{$s->class_name}}</p>
  <div class="fw-bold mb-2">{{$s->level()}}</div>
  <div class="progress mb-2"><div class="progress-bar" style="width:{{$s->score()}}%"></div></div>
  <p class="mb-3"><span class="xp-label">Battle XP</span><br><b class="fs-4">{{$s->score()}}/100</b></p>
  <a href="/students/{{$s->id}}" class="btn btn-primary w-100">Enter Arena</a>
</div></div>
@endforeach
</div>
<script>
new Chart(document.getElementById('classChart'),{type:'bar',data:{labels:@json($students->sortByDesc(fn($s)=>$s->score())->pluck('name')->values()),datasets:[{label:'XP Score',data:@json($students->sortByDesc(fn($s)=>$s->score())->map(fn($s)=>$s->score())->values()),borderWidth:1,borderRadius:12}]},options:{plugins:{legend:{display:false},title:{display:true,text:'Class XP Leaderboard',color:'#fff'},tooltip:{callbacks:{label:(c)=>' XP: '+c.raw+'/100'}}},scales:{x:{ticks:{color:'#dce6ff'},grid:{color:'rgba(255,255,255,.06)'}},y:{beginAtZero:true,max:100,ticks:{color:'#dce6ff'},grid:{color:'rgba(255,255,255,.08)'}}}}});
</script>
@endsection
