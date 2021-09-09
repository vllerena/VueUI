<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Info\RoleAttr;

class CreateRolesTable extends Migration
{
    private const ROLE_TABLE = RoleAttr::TABLE_NAME;

    public function up()
    {
        Schema::create(self::ROLE_TABLE, function (Blueprint $table) {
            $table->id(RoleAttr::ID);
            $table->string(RoleAttr::ROLE_NAME);
            $table->text(RoleAttr::PERMISSION)->nullable();
            $table->boolean(RoleAttr::IS_ADMIN)->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::ROLE_TABLE);
    }
}
