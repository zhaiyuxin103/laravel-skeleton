<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\VerificationCodeEnum;
use App\Http\Requests\VerificationCodeRequest;
use App\Mail\ForgotPassword;
use App\Mail\Register;
use App\Models\VerificationCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Random\RandomException;
use Throwable;

class VerificationCodeController extends Controller
{
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
     *
     * @throws RandomException
     */
    public function store(VerificationCodeRequest $request): JsonResponse
    {
        $email = $request->input('email');

        // 生成 6 位随机数，左侧补 0
        $code = Str::padLeft((string) random_int(1, 999999), 6, '0');
        $type = $request->input('type');

        try {
            // TODO: 本地化邮件
            match ($type) {
                VerificationCodeEnum::REGISTER->value        => Mail::to($email)->send(new Register($code)),
                VerificationCodeEnum::FORGOT_PASSWORD->value => Mail::to($email)->send(new ForgotPassword($code)),
                default                                      => null,
            };
        } catch (Throwable $th) {
            return Response::fail($th->getMessage() ?: trans('messages.failed.verification_code_issued'));
        }

        $key        = 'verification_code_' . $type . '_' . Str::random(15);
        $expired_at = now()->addMinutes((int) config('auth.verification_code_ttl', 5));

        Cache::put($key, ['email' => $email, 'code' => $code], $expired_at);

        VerificationCode::create([
            'key'        => $key,
            'email'      => $email,
            'code'       => $code,
            'type'       => $type,
            'user_id'    => optional($request->user())->id,
            'expired_at' => $expired_at,
        ]);

        return Response::created([
            'key'        => $key,
            'expired_at' => $expired_at->toDateTimeString(),
        ], trans('messages.success.verification_code_issued'));
    }

    /**
     * Display the specified resource.
     */
    public function show(VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VerificationCodeRequest $request, VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VerificationCode $verificationCode)
    {
        //
    }
}
