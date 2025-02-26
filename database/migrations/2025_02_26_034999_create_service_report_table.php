<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('machine_id')->constrained()->onDelete('cascade');
            $table->string('job_order_no')->unique();
            $table->date('date');
            $table->string('type'); 
            $table->string('otherType')->nullable();
            $table->string('department'); 
            $table->text('problem_concern');
            $table->text('causes')->nullable();
            $table->text('action_taken')->nullable(); 
            $table->text('remark_recommendation')->nullable();
            $table->string('reported_by'); 
            $table->timestamp('reported_date_time')->nullable();
            $table->string('serviced_by')->nullable();
            $table->timestamp('serviced_date_time')->nullable(); 
            $table->string('approval')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_reports');
    }
};
