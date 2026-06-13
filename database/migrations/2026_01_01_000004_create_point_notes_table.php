<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up(){Schema::create('point_notes',function(Blueprint $t){$t->id();$t->foreignId('student_id')->constrained()->cascadeOnDelete();$t->string('title');$t->text('note')->nullable();$t->integer('points');$t->enum('type',['encourage','discourage'])->default('encourage');$t->timestamps();});}public function down(){Schema::dropIfExists('point_notes');}};
