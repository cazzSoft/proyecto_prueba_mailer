<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $inserttUserAdmin=new User();
        $inserttUserAdmin->name='Administrador';
        $inserttUserAdmin->email='admin@gmail.com';
        $inserttUserAdmin->tipo_user='AD';
        $inserttUserAdmin->dni='1313893242';
        $inserttUserAdmin->num_celular='0998378517';
        $inserttUserAdmin->fecha_na='1995-07-14';
        $inserttUserAdmin->codigo_ci='1995';
        
        $inserttUserAdmin->password=bcrypt('12345678');
        $inserttUserAdmin->save();
    }
}
