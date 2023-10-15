<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMstMembersTable extends Migration
{
    public function up()
    {
        Schema::table('mst_members', function (Blueprint $table) {
            // Make these columns nullable
            $table->string('photo')->nullable()->change();
            $table->date('DOB')->nullable()->change();
            $table->string('address', 200)->nullable()->change();
            $table->string('gender', 50)->nullable()->change();
            $table->string('health_issues', 50)->nullable()->change();
            $table->string('weight')->nullable()->change();
            $table->string('height')->nullable()->change();
            $table->integer('pin_code')->nullable()->change();
            $table->string('occupation', 50)->nullable()->change();
            $table->string('aim', 50)->nullable()->change();
            $table->string('source', 50)->nullable()->change();
            $table->boolean('status')->nullable()->change();
            $table->string('proof_name', 50)->nullable()->change();
            $table->string('proof_photo', 50)->nullable()->change();
            $table->string('emergency_contact', 11)->nullable()->change();
            $table->integer('created_by')->nullable()->change();
            $table->integer('updated_by')->nullable()->change();

            $table->tinyInteger('account_finished');
            $table->string('password');
        });
    }

    public function down()
    {
        Schema::table('mst_members', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
}
