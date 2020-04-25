<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Contact Companies
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Modalities
    Route::delete('modalities/destroy', 'ModalityController@massDestroy')->name('modalities.massDestroy');
    Route::post('modalities/media', 'ModalityController@storeMedia')->name('modalities.storeMedia');
    Route::post('modalities/ckmedia', 'ModalityController@storeCKEditorImages')->name('modalities.storeCKEditorImages');
    Route::post('modalities/parse-csv-import', 'ModalityController@parseCsvImport')->name('modalities.parseCsvImport');
    Route::post('modalities/process-csv-import', 'ModalityController@processCsvImport')->name('modalities.processCsvImport');
    Route::resource('modalities', 'ModalityController');

    // Procedures
    Route::delete('procedures/destroy', 'ProcedureController@massDestroy')->name('procedures.massDestroy');
    Route::post('procedures/parse-csv-import', 'ProcedureController@parseCsvImport')->name('procedures.parseCsvImport');
    Route::post('procedures/process-csv-import', 'ProcedureController@processCsvImport')->name('procedures.processCsvImport');
    Route::resource('procedures', 'ProcedureController');

    // Procedure Types
    Route::delete('procedure-types/destroy', 'ProcedureTypeController@massDestroy')->name('procedure-types.massDestroy');
    Route::post('procedure-types/parse-csv-import', 'ProcedureTypeController@parseCsvImport')->name('procedure-types.parseCsvImport');
    Route::post('procedure-types/process-csv-import', 'ProcedureTypeController@processCsvImport')->name('procedure-types.processCsvImport');
    Route::resource('procedure-types', 'ProcedureTypeController');

    // Macros
    Route::delete('macros/destroy', 'MacrosController@massDestroy')->name('macros.massDestroy');
    Route::post('macros/media', 'MacrosController@storeMedia')->name('macros.storeMedia');
    Route::post('macros/ckmedia', 'MacrosController@storeCKEditorImages')->name('macros.storeCKEditorImages');
    Route::post('macros/parse-csv-import', 'MacrosController@parseCsvImport')->name('macros.parseCsvImport');
    Route::post('macros/process-csv-import', 'MacrosController@processCsvImport')->name('macros.processCsvImport');
    Route::resource('macros', 'MacrosController');

    // Companies
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompanyController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompanyController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::post('companies/parse-csv-import', 'CompanyController@parseCsvImport')->name('companies.parseCsvImport');
    Route::post('companies/process-csv-import', 'CompanyController@processCsvImport')->name('companies.processCsvImport');
    Route::resource('companies', 'CompanyController');

    // Hospitals
    Route::delete('hospitals/destroy', 'HospitalController@massDestroy')->name('hospitals.massDestroy');
    Route::post('hospitals/media', 'HospitalController@storeMedia')->name('hospitals.storeMedia');
    Route::post('hospitals/ckmedia', 'HospitalController@storeCKEditorImages')->name('hospitals.storeCKEditorImages');
    Route::post('hospitals/parse-csv-import', 'HospitalController@parseCsvImport')->name('hospitals.parseCsvImport');
    Route::post('hospitals/process-csv-import', 'HospitalController@processCsvImport')->name('hospitals.processCsvImport');
    Route::resource('hospitals', 'HospitalController');

    // Radiologists
    Route::delete('radiologists/destroy', 'RadiologistController@massDestroy')->name('radiologists.massDestroy');
    Route::post('radiologists/media', 'RadiologistController@storeMedia')->name('radiologists.storeMedia');
    Route::post('radiologists/ckmedia', 'RadiologistController@storeCKEditorImages')->name('radiologists.storeCKEditorImages');
    Route::post('radiologists/parse-csv-import', 'RadiologistController@parseCsvImport')->name('radiologists.parseCsvImport');
    Route::post('radiologists/process-csv-import', 'RadiologistController@processCsvImport')->name('radiologists.processCsvImport');
    Route::resource('radiologists', 'RadiologistController');

    // Monthly Bills
    Route::resource('monthly-bills', 'MonthlyBillController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Bill Statements
    Route::resource('bill-statements', 'BillStatementController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Bill Payment And Receives
    Route::resource('bill-payment-and-receives', 'BillPaymentAndReceiveController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Hospital Payment Lists
    Route::resource('hospital-payment-lists', 'HospitalPaymentListController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Radiologist Payment Lists
    Route::resource('radiologist-payment-lists', 'RadiologistPaymentListController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Currencies
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Transaction Types
    Route::delete('transaction-types/destroy', 'TransactionTypeController@massDestroy')->name('transaction-types.massDestroy');
    Route::resource('transaction-types', 'TransactionTypeController');

    // Income Sources
    Route::delete('income-sources/destroy', 'IncomeSourceController@massDestroy')->name('income-sources.massDestroy');
    Route::resource('income-sources', 'IncomeSourceController');

    // Client Statuses
    Route::delete('client-statuses/destroy', 'ClientStatusController@massDestroy')->name('client-statuses.massDestroy');
    Route::resource('client-statuses', 'ClientStatusController');

    // Project Statuses
    Route::delete('project-statuses/destroy', 'ProjectStatusController@massDestroy')->name('project-statuses.massDestroy');
    Route::resource('project-statuses', 'ProjectStatusController');

    // Clients
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Projects
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::resource('projects', 'ProjectController');

    // Notes
    Route::delete('notes/destroy', 'NoteController@massDestroy')->name('notes.massDestroy');
    Route::resource('notes', 'NoteController');

    // Documents
    Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');
    Route::post('documents/ckmedia', 'DocumentController@storeCKEditorImages')->name('documents.storeCKEditorImages');
    Route::resource('documents', 'DocumentController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionController');

    // Client Reports
    Route::delete('client-reports/destroy', 'ClientReportController@massDestroy')->name('client-reports.massDestroy');
    Route::resource('client-reports', 'ClientReportController');

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Categories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Reports
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Doctors
    Route::delete('doctors/destroy', 'DoctorController@massDestroy')->name('doctors.massDestroy');
    Route::post('doctors/media', 'DoctorController@storeMedia')->name('doctors.storeMedia');
    Route::post('doctors/ckmedia', 'DoctorController@storeCKEditorImages')->name('doctors.storeCKEditorImages');
    Route::post('doctors/parse-csv-import', 'DoctorController@parseCsvImport')->name('doctors.parseCsvImport');
    Route::post('doctors/process-csv-import', 'DoctorController@processCsvImport')->name('doctors.processCsvImport');
    Route::resource('doctors', 'DoctorController');

    // Patients
    Route::delete('patients/destroy', 'PatientsController@massDestroy')->name('patients.massDestroy');
    Route::post('patients/media', 'PatientsController@storeMedia')->name('patients.storeMedia');
    Route::post('patients/ckmedia', 'PatientsController@storeCKEditorImages')->name('patients.storeCKEditorImages');
    Route::post('patients/parse-csv-import', 'PatientsController@parseCsvImport')->name('patients.parseCsvImport');
    Route::post('patients/process-csv-import', 'PatientsController@processCsvImport')->name('patients.processCsvImport');
    Route::resource('patients', 'PatientsController');

    // Restore Images
    Route::resource('restore-images', 'RestoreImageController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Work Orders
    Route::delete('work-orders/destroy', 'WorkOrderController@massDestroy')->name('work-orders.massDestroy');
    Route::post('work-orders/media', 'WorkOrderController@storeMedia')->name('work-orders.storeMedia');
    Route::post('work-orders/ckmedia', 'WorkOrderController@storeCKEditorImages')->name('work-orders.storeCKEditorImages');
    Route::post('work-orders/parse-csv-import', 'WorkOrderController@parseCsvImport')->name('work-orders.parseCsvImport');
    Route::post('work-orders/process-csv-import', 'WorkOrderController@processCsvImport')->name('work-orders.processCsvImport');
    Route::resource('work-orders', 'WorkOrderController');

    // Work Order Statuses
    Route::delete('work-order-statuses/destroy', 'WorkOrderStatusController@massDestroy')->name('work-order-statuses.massDestroy');
    Route::post('work-order-statuses/parse-csv-import', 'WorkOrderStatusController@parseCsvImport')->name('work-order-statuses.parseCsvImport');
    Route::post('work-order-statuses/process-csv-import', 'WorkOrderStatusController@processCsvImport')->name('work-order-statuses.processCsvImport');
    Route::resource('work-order-statuses', 'WorkOrderStatusController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
