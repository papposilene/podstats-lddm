<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First user
		$adminUname = env('ADMIN_UNAME', 'admin');
        $adminMail = env('ADMIN_EMAIL', 'example@example.com');
        $adminPassword = env('ADMIN_PASSWORD', 'laravel');
        $adminFname = env('ADMIN_FNAME', 'admin');
        $adminMname = env('ADMIN_MNAME', null);
        $adminLname = env('ADMIN_LNAME', 'admin');


		// Drop the table
        DB::table('users')->delete();
        // Seed the table
        User::create(
            [
                'uname' => $adminUname,
                'fname' => $adminFname,
                'mname' => $adminMname,
                'lname' => $adminLname,
                'email' => $adminMail,
                'password' => Hash::make($adminPassword)
            ]);
        $user = User::where('uname', $adminUname)->first();
        $user->assignRole('superAdmin');
    }
}
