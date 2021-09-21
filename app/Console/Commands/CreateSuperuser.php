<?php

namespace App\Console\Commands;

use App\Models\Info\RoleAttr;
use App\Models\Info\UserAttr;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperuser extends Command
{
    protected $signature = 'make:superuser {fullName} {email} {password}';
    protected $description = 'Crea un superusuario o actualiza acorde a un nombre, email y password';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $args = $this->arguments();
        $fullName = $args['fullName'];
        $email = $args['email'];
        $password = $args['password'];

        $role = Role::create([
            RoleAttr::ROLE_NAME => 'Master',
            RoleAttr::IS_ADMIN => true,
            RoleAttr::PERMISSION => '[
                {"resourceName":"Home","read":true,"write":true,"update":true,"delete":true,"name":"/"},
                {"resourceName":"Tags","read":true,"write":true,"update":true,"delete":true,"name":"tags"},
                {"resourceName":"Admin users","read":true,"write":true,"update":true,"delete":true,"name":"adminusers"},
                {"resourceName":"Role","read":true,"write":true,"update":true,"delete":true,"name":"role"},
                {"resourceName":"Permission","read":true,"write":true,"update":true,"delete":true,"name":"permission"}
            ]'
        ]);

        $user = User::updateOrCreate(
            [UserAttr::EMAIL => $email],
            [
                UserAttr::FULLNAME => $fullName,
                UserAttr::EMAIL => $email,
                UserAttr::PASSWORD => Hash::make($password),
                UserAttr::USER_TYPE => 'Admin',
                UserAttr::ROLE => $role->id
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        $this->info("Se ha actualizado o creado el usuario.");

        return 0;
    }
}
