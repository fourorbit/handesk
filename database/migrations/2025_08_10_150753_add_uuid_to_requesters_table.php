<?php

use App\Requester;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class AddUuidToRequestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requesters', function (Blueprint $table) {
            $table->uuid('uuid');
        });

        foreach (Requester::all() as $requester) {
            $requester->update(
                [
                    'uuid' => Uuid::uuid4()->toString(),
                ]
            );
        }

        Schema::table('requesters', function (Blueprint $table) {
            $table->unique('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requesters', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
}
