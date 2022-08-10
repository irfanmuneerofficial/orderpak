<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Admin;

class MigrateDataAdminFromUsersToAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];
        $users = User::where('is_admin','=', 1)->get();
        foreach($users as $oldRecord){


            $newData = 
                array(
                    'first_name' => $oldRecord->fullname,
                    'email'=> $oldRecord->email,
                    'password'=> $oldRecord->password,
                    'created_at'=> $oldRecord->created_at,
                    'updated_at'=> $oldRecord->updated_at
                );
                array_push($data, $newData);
            // $oldRecord->delete();
        }

        Admin::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_to_admins', function (Blueprint $table) {
            //
        });
    }
}
