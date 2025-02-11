<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\VerificationCodeEnum;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use App\Traits\HasCreateTeam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Jiannei\Enum\Laravel\Support\Enums\HttpStatusCode;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Throwable;
use WhichBrowser\Parser;

class UserController extends Controller
{
    use HasCreateTeam;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        $cache_key   = $request->input('verification_key');
        $verify_data = Cache::get($cache_key);
        if (! $verify_data) {
            return Response::fail(trans('messages.failed.verification_code_expired'), 403);
        }
        if (! hash_equals(data_get($verify_data, 'code', ''), $request->input('verification_code'))) {
            return Response::fail(trans('messages.failed.verification_code_not_match'), 422);
        }
        try {
            $user = DB::transaction(function () use ($request, $cache_key, $verify_data) {
                $agent = new Parser(getallheaders());
                $user  = tap(User::create(array_merge($request->validated(), [
                    'avatar'              => $request->input('avatar'),
                    'ip'                  => $request->ip(),
                    'method'              => $request->method(),
                    'path'                => $request->path(),
                    'url'                 => $request->url(),
                    'browser'             => $agent->browser->name,
                    'browser_version'     => optional($agent->browser->version)->value,
                    'language'            => $request->getLanguages(),
                    'engine'              => $agent->engine->name,
                    'os'                  => $agent->os->name,
                    'os_alias'            => $agent->os->alias,
                    'device_type'         => $agent->device->type,
                    'device_manufacturer' => $agent->device->manufacturer,
                    'device_model'        => $agent->device->model,
                ])), function (User $user) {
                    $this->createTeam($user);
                });
                VerificationCode::where('key', $cache_key)
                    ->where('email', data_get($verify_data, 'email'))
                    ->where('type', VerificationCodeEnum::REGISTER->value)
                    ->update(['used_at' => now()]);

                return $user;
            });
        } catch (Throwable $th) {
            return Response::fail($th->getMessage() ?: trans('messages.failed.register'));
        }
        // 清除验证码缓存
        Cache::forget($cache_key);

        return Response::success([
            'user'         => new UserResource($user),
            'token_type'   => 'Bearer',
            'expires_in'   => config('sanctum.expiration') * 60,
            'access_token' => $user->createToken('web')->plainTextToken,
        ], trans('messages.success.register'), HttpStatusCode::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return Response::success(new UserResource($user->setAppends([
            'format_gender',
        ])), trans('messages.success.fetch'));
    }

    public function me(Request $request): JsonResponse
    {
        return Response::success((new UserResource($request->user()->setAppends([
            'format_gender',
        ])))->showSensitiveFields(), trans('messages.success.fetch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request): JsonResponse
    {
        $user = $request->user();

        $user->update($request->validated());

        return Response::success((new UserResource($user->setAppends([
            'format_gender',
        ])))->showSensitiveFields());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return Response::noContent();
    }
}
