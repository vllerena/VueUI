<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\UserAttr;
use App\Models\Info\RoleAttr;

class CreateUsersTable extends Migration
{
    private const USERS_TABLE = UserAttr::TABLE_NAME;

    public function up()
    {
        Schema::create(self::USERS_TABLE, function (Blueprint $table) {
            $table->id(UserAttr::ID);
            $table->string(UserAttr::FULLNAME);
            $table->string(UserAttr::EMAIL)->unique();
            $table->string(UserAttr::PASSWORD);
            $table->string(UserAttr::USER_TYPE)->default('user');
            $table->boolean(UserAttr::IS_ACTIVATED)->default(0);
            $table->string(UserAttr::PASSWORD_RESET_CODE)->nullable();
            $table->string(UserAttr::ACTIVATION_CODE)->nullable();
            $table->string(UserAttr::SOCIAL_TYPE)->nullable();
            $table->boolean(UserAttr::IS_ACTIVE)->default(1);
            $table->foreignId(UserAttr::ROLE)
                ->unique()
                ->constrained(RoleAttr::TABLE_NAME, RoleAttr::ID)
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::USERS_TABLE);
    }
}
