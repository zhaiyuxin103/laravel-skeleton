<?php

declare(strict_types=1);

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
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('key')->comment('标识');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('phone')->nullable()->comment('手机号');
            $table->string('code')->comment('验证码');
            $table->string('type')->comment('类型');
            $table->foreignId('user_id')->nullable()->comment('用户 ID')->constrained();
            $table->timestamp('expired_at')->nullable()->comment('过期时间');
            $table->timestamp('used_at')->nullable()->comment('使用时间');
            $table->boolean('state')->default(true)->comment('状态');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_codes');
    }
};
