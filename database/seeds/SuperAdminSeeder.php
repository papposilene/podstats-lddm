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
		$adminUname = 'papposilene';
		$adminGender = 'masculine';
		$adminFname = 'Philippe-Alexandre';
		$adminMname = 'JBM';
		$adminLname = 'Pierre';
		$adminMail = 'dev@psln.nl';
		$adminPassword = 'laraveltest';
		
		
		// Drop the table
        DB::table('users')->delete();
        // Seed the table
        User::create(
            [
                'uname' => $adminUname,
                'gender' => $adminGender,
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
