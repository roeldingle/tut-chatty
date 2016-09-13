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
        $superadmin->meta()->attach([ 4 => ['value'=>'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p160x160/11825953_1047734388583992_1727016485304329009_n.jpg?oh=5223620e2a770522e3d2982202ea08e3&oe=583EE717&__gda__=1480203752_0696d46fa40b888e6324bd8cafa3e994']]);

        

        $admin = new User();
        $admin->role_id = 2;
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->is_active = true;
        $admin->save();
        $admin->meta()->attach([ 1 => ['value'=>'Megan']]);
        $admin->meta()->attach([ 2 => ['value'=>'Fox']]);
        $admin->meta()->attach([ 3 => ['value'=>'Female']]);
        $admin->meta()->attach([ 4 => ['value'=>'http://wallpapershd3d.com/wp-content/gallery/megan-fox-wallpaper/megan-fox-beautiful-wallpaper-10561-hd-wallpapers.jpg']]);


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
        $staff->meta()->attach([ 4 => ['value'=>'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/c3.46.762.762/s160x160/12821637_10153261809451793_3923111906457878632_n.jpg?oh=a8f0a700cf07bf127535a8cc3695cde7&oe=583E6C83&__gda__=1480777894_c4214b55f875f64ebd66ffa0c0b3b4b0']]);


        $user = new User();
        $user->role_id = 4;
        $user->username = 'user1';
        $user->email = 'user1@gmail.com';
        $user->password = bcrypt('user1');
        $user->is_active = true;
        $user->save();
        $user->meta()->attach([ 1 => ['value'=>'Lebron']]);
        $user->meta()->attach([ 2 => ['value'=>'James']]);
        $user->meta()->attach([ 3 => ['value'=>'Male']]);
        $user->meta()->attach([ 4 => ['value'=>'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/c7.0.160.160/p160x160/1459315_546873965405307_1672016216_n.png?oh=1bdaa7ac98201f222adce9daa975feed&oe=587A7542&__gda__=1480582551_9df546ecaca7a88d920359e967f575dd']]);


        $user = new User();
        $user->role_id = 4;
        $user->username = 'user2';
        $user->email = 'user2@gmail.com';
        $user->password = bcrypt('user2');
        $user->is_active = true;
        $user->save();
        $user->meta()->attach([ 1 => ['value'=>'Stephen']]);
        $user->meta()->attach([ 2 => ['value'=>'Curry']]);
        $user->meta()->attach([ 3 => ['value'=>'Male']]);
        $user->meta()->attach([ 4 => ['value'=>'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xta1/v/t1.0-1/c4.0.160.160/p160x160/13343135_133667173717059_986854916578884971_n.jpg?oh=138b2bb10890918dc83a75f31ad0d8f8&oe=5845A015&__gda__=1484240077_9190ef0e8f6016063ad7a8a351d77469']]);


    }
}
