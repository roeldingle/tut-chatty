<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $superadmin = new User();
        $superadmin->role_id = 1;
        $superadmin->username = 'superadmin';
        $superadmin->email = 'superadmin@gmail.com';
        $superadmin->password = bcrypt('superadmin');
        $superadmin->is_active = true;
        $superadmin->save();
        $superadmin->meta()->attach([ 1 => ['value'=>'Roel']]);
        $superadmin->meta()->attach([ 2 => ['value'=>'Dingle']]);
        $superadmin->meta()->attach([ 3 => ['value'=>'Male']]);

        

        $admin = new User();
        $admin->role_id = 2;
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->is_active = true;
        $admin->save();
        $admin->meta()->attach([ 1 => ['value'=>'Jaymie']]);
        $admin->meta()->attach([ 2 => ['value'=>'Martin']]);
        $admin->meta()->attach([ 3 => ['value'=>'Female']]);


        $staff = new User();
        $staff->role_id = 3;
        $staff->username = 'staff';
        $staff->email = 'staff@gmail.com';
        $staff->password = bcrypt('staff');
        $staff->is_active = true;
        $staff->save();
        $staff->meta()->attach([ 1 => ['value'=>'Jennifer']]);
        $staff->meta()->attach([ 2 => ['value'=>'Lawrence']]);
        $staff->meta()->attach([ 3 => ['value'=>'Female']]);


        $user = new User();
        $user->role_id = 4;
        $user->username = 'user1';
        $user->email = 'user1@gmail.com';
        $user->password = bcrypt('user1');
        $user->is_active = true;
        $user->save();
        $user->meta()->attach([ 1 => ['value'=>'Tony']]);
        $user->meta()->attach([ 2 => ['value'=>'Parker']]);
        $user->meta()->attach([ 3 => ['value'=>'Male']]);


        $user = new User();
        $user->role_id = 4;
        $user->username = 'user2';
        $user->email = 'user2@gmail.com';
        $user->password = bcrypt('user2');
        $user->is_active = true;
        $user->save();
        $user->meta()->attach([ 1 => ['value'=>'Tim']]);
        $user->meta()->attach([ 2 => ['value'=>'Duncan']]);
        $user->meta()->attach([ 3 => ['value'=>'Male']]);


    }
}
