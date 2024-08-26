<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Webhome';
$route['soft'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signUp'] = 'Login/register_account';
$route['OTP'] = 'Login/otp_checked';
$route['forgetPassword'] = 'Login/forget_password';
$route['otpPassword'] = 'Login/otp_password';
$route['passwordSetup'] = 'Login/password_setup';


$route['addSlider'] = 'SiteSettings';
$route['editSlider/(:num)'] = 'SiteSettings/edit_slider/$1';

$route['countdown'] = 'Countdown';

$route['myProfile'] = 'Home/profile';
$route['comProfile'] = 'Home/company_profile';
$route['aSetting'] = 'Home/account_setting';

$route['Dashboard'] = 'Home';
$route['Setting'] = 'Home/setting_pages';
$route['uSetting'] = 'Home/user_setting_pages';
$route['uReport'] = 'Home/user_reports_pages';

$route['Category'] = 'Category';
$route['subCategory'] = 'Category/sub_category';
$route['childSubCategory'] = 'Category/child_sub_category';
$route['Unit'] = 'Category/product_units';
$route['Size'] = 'Category/product_size';
$route['DeliveryTime'] = 'Category/delivery_time';
$route['Tag'] = 'Category/product_tag';
$route['shipping'] = 'Category/shipping_method';
$route['slogan'] = 'Category/slogan';


$route['Expense'] = 'Cost';
$route['costReport'] = 'Cost/expense_report_list';
$route['dexpReport'] = 'Cost/deily_expense_report';

$route['Department'] = 'Employee/emp_department';
$route['Employee'] = 'Employee/employee_info';
$route['empPLedger'] = 'Employee_payment/employee_payment_ledger';

$route['cashReport'] = 'CashAccount/cash_reports';

$route['BankAccount'] = 'BankAccount';
$route['bankReport'] = 'BankAccount/mobile_reports';
$route['bankTReport'] = 'BankAccount/bank_transation_reports';
$route['bankLReport'] = 'BankAccount/bank_transation_legder';

$route['MobileAccount'] = 'MobileAccount';
$route['mobileReport'] = 'MobileAccount/mobile_reports';
$route['adjustment_list'] = 'CashAccount/adjustment_list';
$route['balance_adjustment'] = 'CashAccount/balance_adjustment';

$route['uNotice'] = 'User/user_notice_lists';
$route['uRole'] = 'User/user_role';
$route['User'] = 'User/user_list';
$route['helpSupport'] = 'User/help_support';
$route['userList'] = 'User/all_user_lists';

$route['Customer'] = 'Customer';
$route['cusReport'] = 'Customer/all_customer_reports';
$route['cusLedger'] = 'Customer/customer_ledger_report';
$route['customerView/(:num)'] = 'Customer/view_customer/$1';
$route['cusDReport'] = 'Customer/customer_due_payment';
$route['cdpReport'] = 'Customer/customer_due_payment_report';

$route['Supplier'] = 'Supplier';
$route['supplierReport'] = 'Supplier/supplier_report';
$route['supplierLedger'] = 'Supplier/supplier_ledger';

$route['Product'] = 'Product';
$route['viewProduct/(:num)'] = 'Product/view_product/$1';
$route['editProduct/(:num)'] = 'Product/edit_products/$1';
$route['stockReport'] = 'Product/product_reports';
$route['productBarcode'] = 'Product/product_barcode_list';
$route['pBarcode/(:num)'] = 'Product/create_product_barcode/$1';
$route['lowStock'] = 'Product/low_product_stock_reports';

$route['Purchase'] = 'Purchase';
$route['newPurchase'] = 'Purchase/new_purchase';
$route['viewPurchase/(:num)'] = 'Purchase/view_purchase/$1';
$route['editPurchase/(:num)'] = 'Purchase/edit_purchase/$1';
$route['approvePurchase/(:num)'] = 'Purchase/approve_purchase/$1';
$route['purchaseReport'] = 'Purchase/purchases_reports';
$route['dpurReport'] = 'Purchase/daily_purchases_reports';

$route['Sale'] = 'Sale';
$route['newSale'] = 'Sale/new_sale';
$route['newDSale'] = 'Sale/new_damage_product_sale';
$route['viewSale/(:num)'] = 'Sale/view_invoice/$1';
$route['demoSale/(:num)'] = 'Sale/demo_invoice/$1';


$route['editSale/(:num)'] = 'Sale/edit_sale/$1';
$route['editDSale/(:num)'] = 'Sale/edit_dproduct_sale/$1';
$route['saleReport'] = 'Sale/all_sales_reports';
$route['salesiReport'] = 'Sale/sales_invoice_reports';
$route['salesdReport'] = 'Sale/sales_due_reports';
$route['salesDPReport'] = 'Sale/sales_due_payment_reports';
$route['emiSale'] = 'Sale/installment_sales_list';
$route['viewSPayment/(:num)'] = 'Sale/view_installment_sales_payment/$1';
$route['dsalesReport'] = 'Sale/today_sales_reports';
$route['totalsales'] = 'Sale/today_total_sales_reports';
$route['tsProduct'] = 'Sale/top_sale_product_report';
$route['saleProduct'] = 'Sale/sales_product_reports';
$route['posSales']  = 'Sale/pos_sales_info';
$route['printPSale/(:num)'] = 'Sale/pos_sales_details/$1'; 

$route['serviceInfo'] = 'Service/service_information';
$route['serviceSale'] = 'Service/service_sale_info';
$route['newSService'] = 'Service/new_sale_service';
$route['viewSService/(:num)'] = 'Service/view_sale_service/$1';
$route['editSService/(:num)'] = 'Service/edit_sale_service/$1';

$route['Return'] = 'Returns';
$route['newReturn'] = 'Returns/new_return';
$route['viewReturn/(:num)'] = 'Returns/view_return/$1';
$route['editReturn/(:num)'] = 'Returns/edit_returns/$1';
$route['pReturn'] = 'Returns/purchase_return_list';
$route['newpReturn'] = 'Returns/new_purchase_return';
$route['viewpReturn/(:num)'] = 'Returns/view_purchase_return/$1';
$route['editpReturn/(:num)'] = 'Returns/edit_purchase_return/$1';

$route['Voucher'] = 'Voucher';
$route['newVoucher'] = 'Voucher/new_voucher';
$route['viewVoucher/(:num)'] = 'Voucher/voucher_details/$1';
$route['editVoucher/(:num)'] = 'Voucher/voucher_edit/$1';
$route['profil-Loss'] = 'Voucher/profit_loss';
$route['vReports'] = 'Voucher/voucher_report';
$route['dReport'] = 'Voucher/daily_report';
$route['daily_report'] = 'Voucher/ex_daily_report';
$route['spReports'] = 'Voucher/sale_purchase_profit_report';
$route['diReports'] = 'Voucher/daily_sale_purchase_profit_report';
$route['notice'] = 'Voucher/user_notice';

$route['Quotation'] = 'Quotation';
$route['newQuotation'] = 'Quotation/new_quotation';
$route['viewQuotation/(:num)'] = 'Quotation/view_quotation/$1';
$route['editQuotation/(:num)'] = 'Quotation/edit_quotation/$1';

$route['userAccess'] = 'Access_setup/user_access_setup';
$route['viewUAccess/(:num)'] = 'Access_setup/view_uaccess_setup/$1';
$route['editUAccess/(:num)'] = 'Access_setup/edit_uaccess_setup/$1';

$route['empPayment'] = 'Employee_payment';
$route['newempPayment'] = 'Employee_payment/AddInfo';
$route['empPaymentDetails/(:num)'] = 'Employee_payment/emp_payment_details/$1';

$route['sStructure'] = 'Hradmin/salary_structure_setup';

$route['transAccount'] = 'CashAccount/transfer_account_list';
$route['transReport'] = 'CashAccount/transfer_account_report';

$route['newOrder'] = 'Order/new_Order';
$route['viewOrder/(:num)'] = 'Order/view_Order/$1';
$route['editOrder/(:num)'] = 'Order/edit_Order/$1';
$route['saleOrder/(:num)'] = 'Order/sale_Order/$1';
$route['orderReport'] = 'Order/order_ledger_report';
$route['printOrderPSale/(:num)'] = 'Order/pos_order_details/$1'; 

$route['trackOrder'] = 'Webhome/track_order';

$route['home'] = 'Webhome';
$route['categoryDetails/(:num)'] = 'Webhome/view_category/$1';
$route['subcategoryDetails/(:num)'] = 'Webhome/view_sub_category/$1';
$route['childcategoryDetails/(:num)'] = 'Webhome/view_child_category/$1';
$route['productDetails/(:num)'] = 'Webhome/view_product/$1';
// $route['checkout/(:num)'] = 'Webhome/view_checkout/$1';
$route['checkOut'] = 'Webhome/check_out_order';
$route['orderInvoice/(:num)'] = 'Webhome/order_invoice/$1';
$route['view_category_details'] = 'Webhome/view_category_details';
$route['all_products'] = 'Webhome/all_product_list';

$route['userLogin'] = 'Userlogin';
$route['userRegister'] = 'Userlogin/register';




$route['addtocart'] = 'Webhome/add_to_cart';
$route['loadcart'] = 'Webhome/load_cart';

$route['deletecart'] = 'Webhome/delete_cart';


// $route['add_to_cart'] = 'Cart/save_cart';
$route['showcart'] = 'Cart/showcart';
// $route['removecart'] = 'Cart/remove_cart';




