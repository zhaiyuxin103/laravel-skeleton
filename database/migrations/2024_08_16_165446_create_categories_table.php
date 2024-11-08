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
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->comment('自增长 ID');
            $table->string('name')->comment('类目名称');
            $table->foreignId('parent_id')->nullable()->comment('父类目 ID')->constrained('categories')->onDelete('cascade');
            $table->boolean('is_directory')->comment('是否拥有子类目');
            $table->unsignedInteger('level')->comment('当前类目层级');
            $table->string('path')->comment('该类目所有父类目 id');
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
        Schema::dropIfExists('categories');
    }
};
