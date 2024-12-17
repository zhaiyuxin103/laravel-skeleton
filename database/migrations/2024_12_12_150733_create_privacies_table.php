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
        Schema::create('privacies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->string('slug')->nullable()->comment('标识');
            $table->string('description')->nullable()->comment('描述');
            $table->text('content')->comment('内容');
            $table->boolean('state')->default(true)->comment('状态');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacies');
    }
};
