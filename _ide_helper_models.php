<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description 描述
 * @property string $content
 * @property bool $state
 * @property int $sort
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|About newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|About newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|About onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|About query()
 * @method static \Illuminate\Database\Eloquent\Builder|About whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|About withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|About withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAbout {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name 姓
 * @property string $last_name 名
 * @property string|null $first_alias 别名（姓）
 * @property string|null $last_alias 别名（名）
 * @property string $email
 * @property string|null $email_verified_at
 * @property string|null $phone 电话
 * @property mixed $password
 * @property string|null $avatar 头像
 * @property int $gender 性别
 * @property string|null $birthday 生日
 * @property int|null $age 年龄
 * @property int|null $current_team_id
 * @property string|null $introduction 个人简介
 * @property int $notification_count 通知数量
 * @property string|null $last_authed_at 最后认证时间
 * @property string|null $last_actived_at 最后活跃时间
 * @property string|null $remember_token
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name 姓名
 * @property string $alias 别名
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read mixed $format_gender
 * @property-read mixed $full_avatar
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFirstAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastActivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastAuthedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereNotificationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAdmin {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id 自增长 ID
 * @property string $name 类目名称
 * @property int|null $parent_id 父类目 ID
 * @property bool $is_directory 是否拥有子类目
 * @property int $level 当前类目层级
 * @property string $path 该类目所有父类目 id
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $ancestors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read mixed $full_name
 * @property-read Category|null $parent
 * @property-read mixed $path_ids
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsDirectory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCategory {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $name 姓名
 * @property string|null $title
 * @property int|null $user_id
 * @property string $email
 * @property string|null $phone
 * @property int|null $file_id
 * @property string $content
 * @property string $status
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $format_status
 * @property-read mixed $format_type
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussion withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDiscussion {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id 自增长 ID
 * @property string $name 名称
 * @property string|null $slug 别名
 * @property int $used_count 使用次数
 * @property string|null $color 颜色
 * @property string|null $description 描述
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Label newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Label query()
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereUsedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Label withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLabel {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description 描述
 * @property string $content
 * @property bool $state
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Landing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Landing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Landing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Landing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Landing withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Landing withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperLanding {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperMembership {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Model query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Model withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperModel {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name 名称
 * @property string|null $slug 标识
 * @property string|null $description 描述
 * @property string $content 内容
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Privacy withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPrivacy {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $description
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TeamInvitation> $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTeam {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTeamInvitation {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name 名称
 * @property string|null $slug 标识
 * @property string|null $description 描述
 * @property string $content 内容
 * @property bool $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Term newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Term query()
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Term withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTerm {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name 姓
 * @property string $last_name 名
 * @property string|null $first_alias 别名（姓）
 * @property string|null $last_alias 别名（名）
 * @property int $gender 性别
 * @property string|null $birthday 生日
 * @property int|null $age 年龄
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $phone 电话
 * @property string|null $avatar 头像
 * @property mixed $password
 * @property string|null $zip 邮编
 * @property string|null $address 地址
 * @property bool $is_admin 是否为管理员
 * @property string|null $introduction 个人简介
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $ip IP 地址
 * @property string|null $method 请求方式
 * @property string|null $path 请求路径
 * @property string|null $url 请求 URL
 * @property string|null $browser 浏览器
 * @property string|null $browser_version 浏览器版本
 * @property string|null $languages 浏览器语言
 * @property string|null $engine 引擎
 * @property string|null $os 操作系统
 * @property string|null $os_alias 操作系统别名
 * @property string|null $device 设备
 * @property string|null $device_manufacturer 设备制造商
 * @property string|null $device_model 设备型号
 * @property int $notification_count 通知数量
 * @property string|null $last_authed_at 最后认证时间
 * @property string|null $last_actived_at 最后活跃时间
 * @property int $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name 姓名
 * @property string $alias 别名
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\About> $abouts
 * @property-read int|null $abouts_count
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read mixed $format_gender
 * @property-read mixed $full_avatar
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBrowserVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEngine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastActivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastAuthedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNotificationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOsAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id ID
 * @property string $key 标识
 * @property string|null $email 邮箱
 * @property string|null $phone 手机号
 * @property string $code 验证码
 * @property string $type 类型
 * @property int|null $user_id 用户 ID
 * @property \Illuminate\Support\Carbon|null $expired_at 过期时间
 * @property \Illuminate\Support\Carbon|null $used_at 使用时间
 * @property int $state 状态
 * @property int $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VerificationCode withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperVerificationCode {}
}

