<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Morpich Design', 
            'email' => 'admin@themesbrand.com',
            'guard_name'=>'web',
            'password' => bcrypt('123456')
        ]);
    
        $role = Role::create(['name' => 'admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        // $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        
    }
}