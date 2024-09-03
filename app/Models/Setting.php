<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{ 

    protected $table="settings";
    protected $fillable = [
        'logo',
        'login_logo',
        'logo_invoice',
        'favicon',
        'logo_sm',
        'company_name',
        'company_address',
        'company_phone',
        'company_email',

        'commission_row_start',
        'commission_invoice_number_start',
        'commission_reference_start',
        'commission_description_start',
        'commission_payment_amount_start',
        'commission_invoice_date_start',


        'mailreport_row_start',
        'mailreport_BoxNumber',
        'mailreport_BoxSize',
        'mailreport_BoxHolder',
        'mailreport_AgreementStatus',
        'mailreport_Address1',
        'mailreport_Address2',
        'mailreport_BusinessName',
        'mailreport_CustomerType',
        'mailreport_BoxHolderType',
        'mailreport_BoxHolderStatus',
        'mailreport_MailHandlingStatus',
        'mailreport_PhoneNumber',
        'mailreport_BusinessPhoneNumber',
        'mailreport_OriginalContractStart',
        'mailreport_CurrentContractStart',
        'mailreport_RenewalDate',
        'mailreport_NumberofKeys',
        'mailreport_AgreementRate',
        'mailreport_ServiceRate',
        'mailreport_TotalMonthlyRate',
        'mailreport_AutomaticRenewal',
        'mailreport_EmailNotification',
        'mailreport_FreeMonths',
        'mailreport_TerminationDate',


        'ai_tender_sale_message',
        'ai_tender_sale_file_use',
        'ai_tender_sale_file',
        'ai_tender_response',
        'ai_tender_csv_start'
    ];
}
