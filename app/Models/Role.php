<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    const ROLE_SUPERADMIN = "superadmin";
    const ROLE_ADMIN = "admin";
    const ROLE_SUPPORT = "support";
    const ROLE_CUSTOMER = "customer";

    const ROLE_SUPERADMIN_ID = 1;
    const ROLE_ADMIN_ID = 2;
    const ROLE_SUPPORT_ID = 3;
    const ROLE_CUSTOMER_ID = 4;

    public $guarded = [];
}
