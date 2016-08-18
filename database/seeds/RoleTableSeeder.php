<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_sa = new Role();
        $role_sa->name = 'Superadmin';
        $role_sa->description = 'Access to everything on the system';
        $role_sa->is_active = true;
        $role_sa->save();

        $role_a = new Role();
        $role_a->name = 'Admin';
        $role_a->description = 'To manage admin stuff on the system';
        $role_a->is_active = true;
        $role_a->save();

        $role_s = new Role();
        $role_s->name = 'Staff';
        $role_s->description = 'Assist with system operation';
        $role_s->is_active = true;
        $role_s->save();

        $role_u = new Role();
        $role_u->name = 'User';
        $role_u->description = 'Normal user of system';
        $role_u->is_active = true;
        $role_u->save();
    }
}
