<?php

declare(strict_types=1);

use App\Enums\GenderEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id')->comment('姓');
            $table->string('last_name')->after('first_name')->comment('名');
            $table->dropColumn('name');
            $table->string('first_alias')->nullable()->after('last_name')->comment('别名（姓）');
            $table->string('last_alias')->nullable()->after('first_alias')->comment('别名（名）');
            $table->unsignedTinyInteger('gender')->default(GenderEnum::UNKNOWN->value)->after('last_alias')->comment('性别');
            $table->date('birthday')->nullable()->after('gender')->comment('生日');
            $table->unsignedInteger('age')->nullable()->after('birthday')->comment('年龄');
            $table->string('phone')->nullable()->after('email_verified_at')->comment('电话');
            $table->string('avatar')->nullable()->after('phone')->comment('头像');
            $table->string('zip')->nullable()->after('password')->comment('邮编');
            $table->string('address')->nullable()->after('zip')->comment('地址');
            $table->text('introduction')->nullable()->after('is_admin')->comment('个人简介');
            $table->ipAddress('ip')->nullable()->after('profile_photo_path')->comment('IP 地址');
            $table->string('method')->nullable()->after('ip')->comment('请求方式');
            $table->string('path')->nullable()->after('method')->comment('请求路径');
            $table->string('url')->nullable()->after('path')->comment('请求 URL');
            $table->string('browser')->nullable()->after('url')->comment('浏览器');
            $table->string('browser_version')->nullable()->after('browser')->comment('浏览器版本');
            $table->json('languages')->default(new Expression('(JSON_ARRAY())'))->nullable()->after('browser_version')->comment('浏览器语言');
            $table->string('engine')->nullable()->after('languages')->comment('引擎');
            $table->string('os')->nullable()->after('engine')->comment('操作系统');
            $table->string('os_alias')->nullable()->after('os')->comment('操作系统别名');
            $table->string('device')->nullable()->after('os_alias')->comment('设备');
            $table->string('device_manufacturer')->nullable()->after('device')->comment('设备制造商');
            $table->string('device_model')->nullable()->after('device_manufacturer')->comment('设备型号');
            $table->unsignedInteger('notification_count')->default(0)->after('device_model')->comment('通知数量');
            $table->timestamp('last_authed_at')->nullable()->after('notification_count')->comment('最后认证时间');
            $table->timestamp('last_actived_at')->nullable()->after('last_authed_at')->comment('最后活跃时间');
            $table->boolean('state')->default(true)->after('last_actived_at')->comment('状态');
            $table->unsignedBigInteger('sort')->default(0)->after('state')->comment('排序');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn([
                'first_name', 'last_name', 'first_alias', 'last_alias', 'gender', 'birthday', 'age', 'phone', 'avatar',
                'zip', 'address', 'introduction',
                'ip', 'method', 'path', 'url', 'browser', 'browser_version', 'languages', 'engine', 'os', 'os_alias', 'device',
                'device_manufacturer', 'device_model', 'notification_count', 'last_authed_at', 'last_actived_at',
                'state', 'sort', 'deleted_at',
            ]);
        });
    }
};
