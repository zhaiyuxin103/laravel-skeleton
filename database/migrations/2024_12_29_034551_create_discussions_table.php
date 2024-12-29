<?php

declare(strict_types=1);

use App\Enums\DiscussionStatusEnum;
use App\Enums\DiscussionTypeEnum;
use App\Models\User;
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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', DiscussionTypeEnum::values())->default(DiscussionTypeEnum::FEED->value);
            $table->string('name')->comment('姓名');
            $table->string('title')->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->foreignId('file_id')->nullable();
            $table->text('content');
            $table->enum('status', DiscussionStatusEnum::values())->default(DiscussionStatusEnum::PENDING->value);
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
        Schema::dropIfExists('discussions');
    }
};
