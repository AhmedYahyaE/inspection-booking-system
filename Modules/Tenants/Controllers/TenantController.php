<?php

namespace Modules\Tenants\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Tenants\Resources\TenantResource;

class TenantController
{
    public function show()
    {
        $tenant = Auth::user()->tenant;
        return new TenantResource($tenant);
    }
}
