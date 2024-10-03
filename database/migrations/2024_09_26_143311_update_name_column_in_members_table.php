<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateNameColumnInMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update kolom name untuk menghapus kata "PT"
        DB::table('members')->update([
            'name' => DB::raw("REPLACE(name, 'PT', '')")
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Jika diperlukan, tambahkan logika untuk mengembalikan perubahan
        // (Namun, mengembalikan kata 'PT' yang telah dihapus tidak mungkin dilakukan)
    }
}
