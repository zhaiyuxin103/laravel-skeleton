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
        Schema::create('labels', function (Blueprint $table) {
            $table->id()->comment('自增长 ID');
            $table->string('name')->comment('名称');
            $table->string('slug')->nullable()->comment('别名');
            $table->unsignedInteger('used_count')->default(0)->comment('使用次数');
            $table->string('color')->nullable()->comment('颜色');
            $table->text('description')->nullable()->comment('描述');
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
        Schema::dropIfExists('labels');
    }
};
