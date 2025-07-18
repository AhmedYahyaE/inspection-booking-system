<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Tenants\Models\Tenant;
use Modules\Users\Models\User;

class AuthService
{
    public function register(array $data)
    {
        $tenant = Tenant::create(['name' => $data['tenant_name']]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tenant_id' => $tenant->id,
        ]);
        return $user;
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            return $user;
        }
        return null;
    }
}
