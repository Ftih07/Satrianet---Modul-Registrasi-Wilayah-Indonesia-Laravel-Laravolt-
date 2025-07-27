<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('product_subcategories', function (Blueprint $table) {
            $table->json('features')->nullable()->after('sub_title'); // optional: ubah after() sesuai kebutuhan
        });
    }

    public function down()
    {
        Schema::table('product_subcategories', function (Blueprint $table) {
            $table->dropColumn('features');
        });
    }
};
