<?php

declare(strict_types=1);

use App\Enums\GenderEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('姓');
            $table->string('last_name')->comment('名');
            $table->string('first_alias')->nullable()->comment('别名（姓）');
            $table->string('last_alias')->nullable()->comment('别名（名）');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable()->comment('电话');
            $table->string('password');
            $table->string('avatar')->nullable()->comment('头像');
            $table->unsignedTinyInteger('gender')->default(GenderEnum::UNKNOWN->value)->comment('性别');
            $table->date('birthday')->nullable()->comment('生日');
            $table->unsignedInteger('age')->nullable()->comment('年龄');
            $table->foreignId('current_team_id')->nullable();
            $table->text('introduction')->nullable()->comment('个人简介');
            $table->unsignedInteger('notification_count')->default(0)->comment('通知数量');
            $table->timestamp('last_authed_at')->nullable()->comment('最后认证时间');
            $table->timestamp('last_actived_at')->nullable()->comment('最后活跃时间');
            $table->rememberToken();
            $table->boolean('state')->default(true)->comment('状态');
            $table->unsignedBigInteger('order')->default(0)->comment('排序');
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
