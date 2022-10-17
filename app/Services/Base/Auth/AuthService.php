<?php
namespace App\Services\Base\Auth;

use App\Services\BaseService;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AuthService extends BaseService
{

    /**
     * Create a new AuthService instance
     *
     * @param User $user
     *
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($data)
    {
        $user = $this->user->where('email', $data['email'])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => [trans('response.errors.auth.validate_password')],
             ]);
        }

        if ($user->verify_at) {
            throw ValidationException::withMessages([
                'verify' => [trans('response.errors.verify.name',['name' => "name"])],
             ]);
        }

        return [
            'token' => $user->createToken('authTokens')->plainTextToken,
            'expiration' => config('sanctum.expiration'),
            'data' => $user,
        ];

    }

    public function register($req_user)
    {
        $data = array(
            'verify_code' => time().uniqid(true),
            'status' => 'active',
            'avatar' => '',
            'password' => Hash::make($req_user['password'])
        );
        $user = User::create($data);

        return $user;
    }

    public function verifyEmail($userId, $verifyCode)
    {
        $user = User::find($userId);
        if ($user && $user->verify_code === $verifyCode ) {
            $user->update([
                'verify_code' => null,
                'verify_at' => Carbon::now()
            ]);
            return $user;
        }
        throw ValidationException::withMessages([
            'verify' => [trans('auth.verify')],
         ]);
    }

    public function resetPassword($email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'verify' => [trans('messages.email_not_match')],
             ]);
        }
        $password = Str::random(20);
        $user->update([
            'password' => Hash::make($password)
        ]);
        $dataEmail = [
            'email' => $user->email,
            'password' => $password,
            'first_name' => $user->first_name
        ];
        $this->sendMail('mail.resetpassword_email',
                        $dataEmail,
                        trans('passwords.reset'),
                        $dataEmail['email'],
                        $dataEmail['first_name']);
        return $user;
    }

    public function logout($user) {
        return $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    }
}
