<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Contact Companies
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Faq Categories
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Questions
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Modalities
    Route::post('modalities/media', 'ModalityApiController@storeMedia')->name('modalities.storeMedia');
    Route::apiResource('modalities', 'ModalityApiController');

    // Procedures
    Route::apiResource('procedures', 'ProcedureApiController');

    // Procedure Types
    Route::apiResource('procedure-types', 'ProcedureTypeApiController');

    // Macros
    Route::post('macros/media', 'MacrosApiController@storeMedia')->name('macros.storeMedia');
    Route::apiResource('macros', 'MacrosApiController');

    // Companies
    Route::post('companies/media', 'CompanyApiController@storeMedia')->name('companies.storeMedia');
    Route::apiResource('companies', 'CompanyApiController');

    // Hospitals
    Route::post('hospitals/media', 'HospitalApiController@storeMedia')->name('hospitals.storeMedia');
    Route::apiResource('hospitals', 'HospitalApiController');

    // Radiologists
    Route::post('radiologists/media', 'RadiologistApiController@storeMedia')->name('radiologists.storeMedia');
    Route::apiResource('radiologists', 'RadiologistApiController');

    // Currencies
    Route::apiResource('currencies', 'CurrencyApiController');

    // Transaction Types
    Route::apiResource('transaction-types', 'TransactionTypeApiController');

    // Income Sources
    Route::apiResource('income-sources', 'IncomeSourceApiController');

    // Client Statuses
    Route::apiResource('client-statuses', 'ClientStatusApiController');

    // Project Statuses
    Route::apiResource('project-statuses', 'ProjectStatusApiController');

    // Clients
    Route::apiResource('clients', 'ClientApiController');

    // Projects
    Route::apiResource('projects', 'ProjectApiController');

    // Notes
    Route::apiResource('notes', 'NoteApiController');

    // Documents
    Route::post('documents/media', 'DocumentApiController@storeMedia')->name('documents.storeMedia');
    Route::apiResource('documents', 'DocumentApiController');

    // Transactions
    Route::apiResource('transactions', 'TransactionApiController');

    // Expense Categories
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Categories
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expenses
    Route::apiResource('expenses', 'ExpenseApiController');

    // Incomes
    Route::apiResource('incomes', 'IncomeApiController');

    // Asset Categories
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Locations
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Statuses
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Assets
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Doctors
    Route::post('doctors/media', 'DoctorApiController@storeMedia')->name('doctors.storeMedia');
    Route::apiResource('doctors', 'DoctorApiController');

    // Patients
    Route::post('patients/media', 'PatientsApiController@storeMedia')->name('patients.storeMedia');
    Route::apiResource('patients', 'PatientsApiController');

    // Work Orders
    Route::post('work-orders/media', 'WorkOrderApiController@storeMedia')->name('work-orders.storeMedia');
    Route::apiResource('work-orders', 'WorkOrderApiController');

    // Work Order Statuses
    Route::apiResource('work-order-statuses', 'WorkOrderStatusApiController');

});
