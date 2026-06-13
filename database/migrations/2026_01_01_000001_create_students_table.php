<?php
use Illuminate\Database\Migrations\Migration;use Illuminate\Database\Schema\Blueprint;use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up(){Schema::create('students',function(Blueprint $t){$t->id();$t->string('name',120);$t->string('roll_no',50)->unique();$t->string('class_name',80)->default('BS ADP IT');$t->string('avatar',20)->default('🎮');$t->string('email',120)->nullable();$t->timestamps();});}public function down(){Schema::dropIfExists('students');}};
