<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'clients'
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        Schema::table('content_documents', function (Blueprint $table) {
            $table->foreign('FK_createdocument_id')->references('createdocument_id')->on('create_documents')->onDelete('cascade');
        });

        Schema::table('create_documents', function (Blueprint $table) {
            $table->foreign('FK_client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });
        
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('FK_client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
        
        // Table 'employees'
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_function_id')->references('function_id')->on('functions')->onDelete('cascade');
        });

        // Table 'log_accounts'
        Schema::table('log_accounts', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_action_type_id')->references('action_type_id')->on('actions_type')->onDelete('cascade');
        });

        // Table 'log_clients'
        Schema::table('log_clients', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_action_type_id')->references('action_type_id')->on('actions_type')->onDelete('cascade');
            $table->foreign('FK_client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('set null');
        });

        // Table 'log_employees'
        Schema::table('log_employees', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_action_type_id')->references('action_type_id')->on('actions_type')->onDelete('cascade');
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('FK_function_id')->references('function_id')->on('functions')->onDelete('cascade');
        });

        // Table 'log_reviews'
        Schema::table('log_reviews', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_action_type')->references('action_type_id')->on('actions_type')->onDelete('cascade');
            $table->foreign('FK_review_id')->references('review_id')->on('reviews')->onDelete('cascade');
        });

        // Table 'quotes_request'
        Schema::table('quotes_request', function (Blueprint $table) {
            // Pas de clés étrangères spécifiées pour cette table, mais vous pouvez en ajouter si nécessaire
        });

        // Table 'reviews'
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('FK_account_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });

        // Table 'services'
        Schema::table('services', function (Blueprint $table) {
            // Pas de clés étrangères spécifiées pour cette table
        });

        // Table 'team_services'
        Schema::table('team_services', function (Blueprint $table) {
            $table->foreign('FK_service_id')->references('service_id')->on('services')->onDelete('cascade');
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });
        // Table 'contracts'
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('FK_client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->foreign('FK_service_id')->references('service_id')->on('services')->onDelete('cascade');
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        Schema::table('messages' , function (Blueprint $table) {
            $table->foreign('FK_sender_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_recipient_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreign('FK_conversation_id')->references('conversation_id')->on('conversations')->onDelete('cascade');
            $table->foreign('FK_message_content_id')->references('message_content_id')->on('message_contents')->onDelete('cascade');
        });

        Schema::table('conversations' , function (Blueprint $table) {
            $table->foreign('FK_employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('FK_client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Table 'clients'
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
            $table->dropForeign(['FK_employee_id']);
        });

        // Table 'contracts'
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['FK_client_id']);
            $table->dropForeign(['FK_service_id']);
            $table->dropForeign(['FK_employee_id']);
        });

        // Table 'employees'
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
            $table->dropForeign(['FK_function_id']);
        });

        // Table 'log_accounts'
        Schema::table('log_accounts', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
            $table->dropForeign(['FK_action_type_id']);
        });

        // Table 'log_clients'
        Schema::table('log_clients', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
            $table->dropForeign(['FK_action_type_id']);
            $table->dropForeign(['FK_client_id']);
            $table->dropForeign(['FK_employee_id']);
        });

        // Table 'log_employees'
        Schema::table('log_employees', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
            $table->dropForeign(['FK_action_type_id']);
            $table->dropForeign(['FK_employee_id']);
            $table->dropForeign(['FK_function_id']);
        });

        // Table 'log_reviews'
        Schema::table('log_reviews', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
            $table->dropForeign(['FK_action_type']);
            $table->dropForeign(['FK_review_id']);
        });

        // Table 'reviews'
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['FK_account_id']);
        });

        // Table 'team_services'
        Schema::table('team_services', function (Blueprint $table) {
            $table->dropForeign(['FK_service_id']);
            $table->dropForeign(['FK_employee_id']);
        });



        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['FK_sender_id']);
            $table->dropForeign(['FK_recipient_id']);
            $table->dropForeign(['FK_conversation_id']);
            $table->dropForeign(['FK_message_content_id']);
        });

        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['FK_employee_id']);
            $table->dropForeign(['FK_client_id']);
        });
        
        

        Schema::table('content_documents', function (Blueprint $table) {
            $table->dropForeign(['FK_createdocument_id']);
        });

        Schema::table('create_documents', function (Blueprint $table) {
            $table->dropForeign(['FK_client_id']);
            $table->dropForeign(['FK_employee_id']);
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['FK_client_id']);
        });
    }
};

