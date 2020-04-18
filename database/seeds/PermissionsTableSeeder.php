<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'setting_access',
            ],
            [
                'id'    => '18',
                'title' => 'user_alert_create',
            ],
            [
                'id'    => '19',
                'title' => 'user_alert_show',
            ],
            [
                'id'    => '20',
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => '21',
                'title' => 'user_alert_access',
            ],
            [
                'id'    => '22',
                'title' => 'contact_management_access',
            ],
            [
                'id'    => '23',
                'title' => 'contact_company_create',
            ],
            [
                'id'    => '24',
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => '25',
                'title' => 'contact_company_show',
            ],
            [
                'id'    => '26',
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => '27',
                'title' => 'contact_company_access',
            ],
            [
                'id'    => '28',
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => '29',
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => '30',
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => '31',
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => '32',
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => '33',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '34',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '35',
                'title' => 'faq_management_access',
            ],
            [
                'id'    => '36',
                'title' => 'faq_category_create',
            ],
            [
                'id'    => '37',
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => '38',
                'title' => 'faq_category_show',
            ],
            [
                'id'    => '39',
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => '40',
                'title' => 'faq_category_access',
            ],
            [
                'id'    => '41',
                'title' => 'faq_question_create',
            ],
            [
                'id'    => '42',
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => '43',
                'title' => 'faq_question_show',
            ],
            [
                'id'    => '44',
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => '45',
                'title' => 'faq_question_access',
            ],
            [
                'id'    => '46',
                'title' => 'modality_create',
            ],
            [
                'id'    => '47',
                'title' => 'modality_edit',
            ],
            [
                'id'    => '48',
                'title' => 'modality_show',
            ],
            [
                'id'    => '49',
                'title' => 'modality_delete',
            ],
            [
                'id'    => '50',
                'title' => 'modality_access',
            ],
            [
                'id'    => '51',
                'title' => 'procedure_create',
            ],
            [
                'id'    => '52',
                'title' => 'procedure_edit',
            ],
            [
                'id'    => '53',
                'title' => 'procedure_show',
            ],
            [
                'id'    => '54',
                'title' => 'procedure_delete',
            ],
            [
                'id'    => '55',
                'title' => 'procedure_access',
            ],
            [
                'id'    => '56',
                'title' => 'procedure_type_create',
            ],
            [
                'id'    => '57',
                'title' => 'procedure_type_edit',
            ],
            [
                'id'    => '58',
                'title' => 'procedure_type_show',
            ],
            [
                'id'    => '59',
                'title' => 'procedure_type_delete',
            ],
            [
                'id'    => '60',
                'title' => 'procedure_type_access',
            ],
            [
                'id'    => '61',
                'title' => 'macro_create',
            ],
            [
                'id'    => '62',
                'title' => 'macro_edit',
            ],
            [
                'id'    => '63',
                'title' => 'macro_show',
            ],
            [
                'id'    => '64',
                'title' => 'macro_delete',
            ],
            [
                'id'    => '65',
                'title' => 'macro_access',
            ],
            [
                'id'    => '66',
                'title' => 'company_create',
            ],
            [
                'id'    => '67',
                'title' => 'company_edit',
            ],
            [
                'id'    => '68',
                'title' => 'company_show',
            ],
            [
                'id'    => '69',
                'title' => 'company_delete',
            ],
            [
                'id'    => '70',
                'title' => 'company_access',
            ],
            [
                'id'    => '71',
                'title' => 'accounts_management_access',
            ],
            [
                'id'    => '72',
                'title' => 'hospital_create',
            ],
            [
                'id'    => '73',
                'title' => 'hospital_edit',
            ],
            [
                'id'    => '74',
                'title' => 'hospital_show',
            ],
            [
                'id'    => '75',
                'title' => 'hospital_delete',
            ],
            [
                'id'    => '76',
                'title' => 'hospital_access',
            ],
            [
                'id'    => '77',
                'title' => 'radiologist_create',
            ],
            [
                'id'    => '78',
                'title' => 'radiologist_edit',
            ],
            [
                'id'    => '79',
                'title' => 'radiologist_show',
            ],
            [
                'id'    => '80',
                'title' => 'radiologist_delete',
            ],
            [
                'id'    => '81',
                'title' => 'radiologist_access',
            ],
            [
                'id'    => '82',
                'title' => 'image_upload_access',
            ],
            [
                'id'    => '83',
                'title' => 'worklist_access',
            ],
            [
                'id'    => '84',
                'title' => 'bill_management_access',
            ],
            [
                'id'    => '85',
                'title' => 'monthly_bill_access',
            ],
            [
                'id'    => '86',
                'title' => 'bill_statement_access',
            ],
            [
                'id'    => '87',
                'title' => 'bill_payment_and_receive_access',
            ],
            [
                'id'    => '88',
                'title' => 'hospital_payment_list_access',
            ],
            [
                'id'    => '89',
                'title' => 'radiologist_payment_list_access',
            ],
            [
                'id'    => '90',
                'title' => 'client_management_setting_access',
            ],
            [
                'id'    => '91',
                'title' => 'currency_create',
            ],
            [
                'id'    => '92',
                'title' => 'currency_edit',
            ],
            [
                'id'    => '93',
                'title' => 'currency_show',
            ],
            [
                'id'    => '94',
                'title' => 'currency_delete',
            ],
            [
                'id'    => '95',
                'title' => 'currency_access',
            ],
            [
                'id'    => '96',
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => '97',
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => '98',
                'title' => 'transaction_type_show',
            ],
            [
                'id'    => '99',
                'title' => 'transaction_type_delete',
            ],
            [
                'id'    => '100',
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => '101',
                'title' => 'income_source_create',
            ],
            [
                'id'    => '102',
                'title' => 'income_source_edit',
            ],
            [
                'id'    => '103',
                'title' => 'income_source_show',
            ],
            [
                'id'    => '104',
                'title' => 'income_source_delete',
            ],
            [
                'id'    => '105',
                'title' => 'income_source_access',
            ],
            [
                'id'    => '106',
                'title' => 'client_status_create',
            ],
            [
                'id'    => '107',
                'title' => 'client_status_edit',
            ],
            [
                'id'    => '108',
                'title' => 'client_status_show',
            ],
            [
                'id'    => '109',
                'title' => 'client_status_delete',
            ],
            [
                'id'    => '110',
                'title' => 'client_status_access',
            ],
            [
                'id'    => '111',
                'title' => 'project_status_create',
            ],
            [
                'id'    => '112',
                'title' => 'project_status_edit',
            ],
            [
                'id'    => '113',
                'title' => 'project_status_show',
            ],
            [
                'id'    => '114',
                'title' => 'project_status_delete',
            ],
            [
                'id'    => '115',
                'title' => 'project_status_access',
            ],
            [
                'id'    => '116',
                'title' => 'client_management_access',
            ],
            [
                'id'    => '117',
                'title' => 'client_create',
            ],
            [
                'id'    => '118',
                'title' => 'client_edit',
            ],
            [
                'id'    => '119',
                'title' => 'client_show',
            ],
            [
                'id'    => '120',
                'title' => 'client_delete',
            ],
            [
                'id'    => '121',
                'title' => 'client_access',
            ],
            [
                'id'    => '122',
                'title' => 'project_create',
            ],
            [
                'id'    => '123',
                'title' => 'project_edit',
            ],
            [
                'id'    => '124',
                'title' => 'project_show',
            ],
            [
                'id'    => '125',
                'title' => 'project_delete',
            ],
            [
                'id'    => '126',
                'title' => 'project_access',
            ],
            [
                'id'    => '127',
                'title' => 'note_create',
            ],
            [
                'id'    => '128',
                'title' => 'note_edit',
            ],
            [
                'id'    => '129',
                'title' => 'note_show',
            ],
            [
                'id'    => '130',
                'title' => 'note_delete',
            ],
            [
                'id'    => '131',
                'title' => 'note_access',
            ],
            [
                'id'    => '132',
                'title' => 'document_create',
            ],
            [
                'id'    => '133',
                'title' => 'document_edit',
            ],
            [
                'id'    => '134',
                'title' => 'document_show',
            ],
            [
                'id'    => '135',
                'title' => 'document_delete',
            ],
            [
                'id'    => '136',
                'title' => 'document_access',
            ],
            [
                'id'    => '137',
                'title' => 'transaction_create',
            ],
            [
                'id'    => '138',
                'title' => 'transaction_edit',
            ],
            [
                'id'    => '139',
                'title' => 'transaction_show',
            ],
            [
                'id'    => '140',
                'title' => 'transaction_delete',
            ],
            [
                'id'    => '141',
                'title' => 'transaction_access',
            ],
            [
                'id'    => '142',
                'title' => 'client_report_create',
            ],
            [
                'id'    => '143',
                'title' => 'client_report_edit',
            ],
            [
                'id'    => '144',
                'title' => 'client_report_show',
            ],
            [
                'id'    => '145',
                'title' => 'client_report_delete',
            ],
            [
                'id'    => '146',
                'title' => 'client_report_access',
            ],
            [
                'id'    => '147',
                'title' => 'expense_management_access',
            ],
            [
                'id'    => '148',
                'title' => 'expense_category_create',
            ],
            [
                'id'    => '149',
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => '150',
                'title' => 'expense_category_show',
            ],
            [
                'id'    => '151',
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => '152',
                'title' => 'expense_category_access',
            ],
            [
                'id'    => '153',
                'title' => 'income_category_create',
            ],
            [
                'id'    => '154',
                'title' => 'income_category_edit',
            ],
            [
                'id'    => '155',
                'title' => 'income_category_show',
            ],
            [
                'id'    => '156',
                'title' => 'income_category_delete',
            ],
            [
                'id'    => '157',
                'title' => 'income_category_access',
            ],
            [
                'id'    => '158',
                'title' => 'expense_create',
            ],
            [
                'id'    => '159',
                'title' => 'expense_edit',
            ],
            [
                'id'    => '160',
                'title' => 'expense_show',
            ],
            [
                'id'    => '161',
                'title' => 'expense_delete',
            ],
            [
                'id'    => '162',
                'title' => 'expense_access',
            ],
            [
                'id'    => '163',
                'title' => 'income_create',
            ],
            [
                'id'    => '164',
                'title' => 'income_edit',
            ],
            [
                'id'    => '165',
                'title' => 'income_show',
            ],
            [
                'id'    => '166',
                'title' => 'income_delete',
            ],
            [
                'id'    => '167',
                'title' => 'income_access',
            ],
            [
                'id'    => '168',
                'title' => 'expense_report_create',
            ],
            [
                'id'    => '169',
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => '170',
                'title' => 'expense_report_show',
            ],
            [
                'id'    => '171',
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => '172',
                'title' => 'expense_report_access',
            ],
            [
                'id'    => '173',
                'title' => 'asset_management_access',
            ],
            [
                'id'    => '174',
                'title' => 'asset_category_create',
            ],
            [
                'id'    => '175',
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => '176',
                'title' => 'asset_category_show',
            ],
            [
                'id'    => '177',
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => '178',
                'title' => 'asset_category_access',
            ],
            [
                'id'    => '179',
                'title' => 'asset_location_create',
            ],
            [
                'id'    => '180',
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => '181',
                'title' => 'asset_location_show',
            ],
            [
                'id'    => '182',
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => '183',
                'title' => 'asset_location_access',
            ],
            [
                'id'    => '184',
                'title' => 'asset_status_create',
            ],
            [
                'id'    => '185',
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => '186',
                'title' => 'asset_status_show',
            ],
            [
                'id'    => '187',
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => '188',
                'title' => 'asset_status_access',
            ],
            [
                'id'    => '189',
                'title' => 'asset_create',
            ],
            [
                'id'    => '190',
                'title' => 'asset_edit',
            ],
            [
                'id'    => '191',
                'title' => 'asset_show',
            ],
            [
                'id'    => '192',
                'title' => 'asset_delete',
            ],
            [
                'id'    => '193',
                'title' => 'asset_access',
            ],
            [
                'id'    => '194',
                'title' => 'assets_history_access',
            ],
            [
                'id'    => '195',
                'title' => 'doctor_create',
            ],
            [
                'id'    => '196',
                'title' => 'doctor_edit',
            ],
            [
                'id'    => '197',
                'title' => 'doctor_show',
            ],
            [
                'id'    => '198',
                'title' => 'doctor_delete',
            ],
            [
                'id'    => '199',
                'title' => 'doctor_access',
            ],
            [
                'id'    => '200',
                'title' => 'patient_create',
            ],
            [
                'id'    => '201',
                'title' => 'patient_edit',
            ],
            [
                'id'    => '202',
                'title' => 'patient_show',
            ],
            [
                'id'    => '203',
                'title' => 'patient_delete',
            ],
            [
                'id'    => '204',
                'title' => 'patient_access',
            ],
            [
                'id'    => '205',
                'title' => 'restore_image_access',
            ],
            [
                'id'    => '206',
                'title' => 'report_management_access',
            ],
            [
                'id'    => '207',
                'title' => 'work_order_create',
            ],
            [
                'id'    => '208',
                'title' => 'work_order_edit',
            ],
            [
                'id'    => '209',
                'title' => 'work_order_show',
            ],
            [
                'id'    => '210',
                'title' => 'work_order_delete',
            ],
            [
                'id'    => '211',
                'title' => 'work_order_access',
            ],
            [
                'id'    => '212',
                'title' => 'work_order_status_create',
            ],
            [
                'id'    => '213',
                'title' => 'work_order_status_edit',
            ],
            [
                'id'    => '214',
                'title' => 'work_order_status_show',
            ],
            [
                'id'    => '215',
                'title' => 'work_order_status_delete',
            ],
            [
                'id'    => '216',
                'title' => 'work_order_status_access',
            ],
            [
                'id'    => '217',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
