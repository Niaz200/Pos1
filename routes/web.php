<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/inbox', function (){
//    echo "inbox";
//})->name('inbox');

//employee routes

Route::get('/add-employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('add.employee');
Route::post('/insert-employee', [App\Http\Controllers\EmployeeController::class, 'store']);
Route::get('/all-employee', [App\Http\Controllers\EmployeeController::class, 'AllEmployee'])->name('all.employee');
Route::get('/view-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'ViewEmployee']);
Route::get('/delete-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'DeleteEmployee']);
Route::get('/edit-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'EditEmployee']);

Route::post('/update-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'UpdateEmployee']);

//Customers routes
Route::get('/add-customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('add.customer');
Route::post('/insert-customer', [App\Http\Controllers\CustomerController::class, 'store']);
Route::get('/all-customer', [App\Http\Controllers\CustomerController::class, 'AllCustomer'])->name('all.customer');
Route::get('/view-customer/{id}', [App\Http\Controllers\CustomerController::class, 'ViewCustomer']);
Route::get('/delete-customer/{id}', [App\Http\Controllers\CustomerController::class, 'DeleteCustomer']);
Route::get('/edit-customer/{id}', [App\Http\Controllers\CustomerController::class, 'EditCustomer']);

Route::post('/update-customer/{id}', [App\Http\Controllers\CustomerController::class, 'UpdateCustomer']);

//suppliers routes are here.....

Route::get('/add-supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('add.supplier');
Route::post('/insert-supplier', [App\Http\Controllers\SupplierController::class, 'SupplierStore']);
Route::get('/all-supplier', [App\Http\Controllers\SupplierController::class, 'AllSupplier'])->name('all.supplier');
Route::get('/view-supplier/{id}', [App\Http\Controllers\SupplierController::class, 'ViewSupplier']);
Route::get('/delete-supplier/{id}', [App\Http\Controllers\SupplierController::class, 'DeleteSupplier']);
Route::get('/edit-supplier/{id}', [App\Http\Controllers\SupplierController::class, 'EditSupplier']);
Route::post('/update-supplier/{id}', [App\Http\Controllers\SupplierController::class, 'UpdateSupplier']);

//salary routes start from here...........
Route::get('/add-advanced-salary', [App\Http\Controllers\SalaryController::class, 'AddAdvancedSalary'])->name('add.advancedsalary');
Route::post('/insert-advancedsalary', [App\Http\Controllers\SalaryController::class, 'InsertAdvanced']);
Route::get('/all-salary', [App\Http\Controllers\SalaryController::class, 'AllSalary'])->name('all.advancedsalary');
Route::get('/pay-salary', [App\Http\Controllers\SalaryController::class, 'PaySalary'])->name('pay.salary');

// category routes here.....
Route::get('/add-category', [App\Http\Controllers\CategoriesController::class, 'AddCategory'])->name('add.category');
Route::post('/insert-category', [App\Http\Controllers\CategoriesController::class, 'InsertCategory']);
Route::get('/all-category', [App\Http\Controllers\CategoriesController::class, 'AllCategory'])->name('all.category');
Route::get('/delete-category/{id}', [App\Http\Controllers\CategoriesController::class, 'DeleteCategory']);
Route::get('/edit-category/{id}', [App\Http\Controllers\CategoriesController::class, 'EditCategory']);
Route::post('/update-category/{id}', [App\Http\Controllers\CategoriesController::class, 'UpdateCategory']);

// Product routes are here.....
Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'AddProduct'])->name('add.product');
Route::post('/insert-product', [App\Http\Controllers\ProductController::class, 'InsertProduct']);
Route::get('/all-product', [App\Http\Controllers\ProductController::class, 'AllProduct'])->name('all.product');
Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'DeleteProduct']);
Route::get('/view-product/{id}', [App\Http\Controllers\ProductController::class, 'ViewProduct']);
Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'EditProduct']);
Route::post('/update-product/{id}', [App\Http\Controllers\ProductController::class, 'UpdateProduct']);

//excel import and export......
Route::get('/import-product', [App\Http\Controllers\ProductController::class, 'ImportProduct'])->name('import.product');
Route::get('/export', [App\Http\Controllers\ProductController::class, 'Export'])->name('export');
Route::post('/import', [App\Http\Controllers\ProductController::class, 'Import'])->name('import');

// Expense routes are here.....
Route::get('/add-expense', [App\Http\Controllers\ExpenseController::class, 'AddExpense'])->name('add.expense');
Route::post('/insert-expense', [App\Http\Controllers\ExpenseController::class, 'InsertExpense']);
Route::get('/today-expense', [App\Http\Controllers\ExpenseController::class, 'TodayExpense'])->name('today.expense');
Route::get('/edit-expense/{id}', [App\Http\Controllers\ExpenseController::class, 'EditTodayExpense']);
Route::post('/update-expense/{id}', [App\Http\Controllers\ExpenseController::class, 'UpdateExpense']);
Route::get('/delete-expense/{id}', [App\Http\Controllers\ExpenseController::class, 'DeleteExpense']);
Route::get('/monthly-expense', [App\Http\Controllers\ExpenseController::class, 'MonthlyExpense'])->name('monthly.expense');
Route::get('/yearly-expense', [App\Http\Controllers\ExpenseController::class, 'YearlyExpense'])->name('yearly.expense');

//month wise more expense....
Route::get('/monthWise-expense', [App\Http\Controllers\ExpenseController::class, 'MonthWiseExpense'])->name('monthWise.expense');
Route::get('/january-expense', [App\Http\Controllers\ExpenseController::class, 'JanuaryExpense'])->name('january.expense');
Route::get('/february-expense', [App\Http\Controllers\ExpenseController::class, 'FebruaryExpense'])->name('february.expense');
Route::get('/march-expense', [App\Http\Controllers\ExpenseController::class, 'MarchExpense'])->name('march.expense');
Route::get('/april-expense', [App\Http\Controllers\ExpenseController::class, 'AprilExpense'])->name('april.expense');
Route::get('/may-expense', [App\Http\Controllers\ExpenseController::class, 'MayExpense'])->name('may.expense');
Route::get('/june-expense', [App\Http\Controllers\ExpenseController::class, 'JuneExpense'])->name('june.expense');
Route::get('/july-expense', [App\Http\Controllers\ExpenseController::class, 'JulyExpense'])->name('july.expense');
Route::get('/august-expense', [App\Http\Controllers\ExpenseController::class, 'AugustExpense'])->name('august.expense');
Route::get('/september-expense', [App\Http\Controllers\ExpenseController::class, 'SeptemberExpense'])->name('september.expense');
Route::get('/october-expense', [App\Http\Controllers\ExpenseController::class, 'OctoberExpense'])->name('october.expense');
Route::get('/november-expense', [App\Http\Controllers\ExpenseController::class, 'NovemberExpense'])->name('november.expense');
Route::get('/december-expense', [App\Http\Controllers\ExpenseController::class, 'DecemberExpense'])->name('december.expense');

//Attendances routes are here................

Route::get('/take-attendance', [App\Http\Controllers\AttendanceController::class, 'TakeAttendance'])->name('take.attendance');
Route::post('/insert-attendance', [App\Http\Controllers\AttendanceController::class, 'InsertAttendance']);
Route::get('/all-attendance', [App\Http\Controllers\AttendanceController::class, 'AllAttendance'])->name('all.attendance');
Route::get('/edit-attendance/{edit_date}', [App\Http\Controllers\AttendanceController::class, 'EditAttendance']);
//Route::post('/update-attendance', [App\Http\Controllers\AttendanceController::class, 'UpdateAttendance']);
Route::get('/view-attendance/{edit_date}', [App\Http\Controllers\AttendanceController::class, 'ViewAttendance']);

Route::post('/update-attendance', [App\Http\Controllers\AttendanceController::class, 'UpdateAttendance']);



//setting routes
Route::get('/website-setting',[App\Http\Controllers\AttendanceController::class, 'Setting'])->name('setting');
Route::post('/update-website/{id}', [App\Http\Controllers\AttendanceController::class, 'UpdateWebsite']);


//Pos routers here

Route::get('/pos',[App\Http\Controllers\PosController::class, 'index'])->name('pos');
Route::get('/pending/order',[App\Http\Controllers\PosController::class, 'PendingOrder'])->name('pending.orders');
Route::get('/view-order-status/{id}',[App\Http\Controllers\PosController::class, 'ViewOrder']);
Route::get('/pos-done/{id}',[App\Http\Controllers\PosController::class, 'PosDone']);
Route::get('/success/order',[App\Http\Controllers\PosController::class, 'SuccessOrder'])->name('success.orders');

//cart controller

Route::post('/add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::post('/cart-update/{rowId}', [App\Http\Controllers\CartController::class, 'CartUpdate']);
Route::get('/cart-remove/{rowId}', [App\Http\Controllers\CartController::class, 'CartRemove']);
Route::post('/create-invoice', [App\Http\Controllers\CartController::class, 'CreateInvoice']);
Route::post('/final-invoice', [App\Http\Controllers\CartController::class, 'FinalInvoice']);


//Manage Stock
Route::get('/stock-report', [App\Http\Controllers\StockController::class, 'StockReport'])->name('stock.report');
Route::get('/stock-report/pdf', [App\Http\Controllers\StockController::class, 'StockReportPdf'])->name('stock.report.pdf');
Route::get('/report/supplier/product/wise', [App\Http\Controllers\StockController::class, 'SupplierProductWise'])->name('stock.report.supplier.product.wise');
Route::get('/report/supplier/wise/pdf', [App\Http\Controllers\StockController::class, 'SupplierWisePdf'])->name('stock.report.supplier.wise.pdf');
Route::get('/report/product/wise/pdf', [App\Http\Controllers\StockController::class, 'ProductWisePdf'])->name('stock.report.product.wise.pdf');

// to get product using ajax
Route::get('/get-product', [App\Http\Controllers\StockController::class, 'getProduct'])->name('get-product');


//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//
//    return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');
//
////this route are show verification page
//Route::get('/email/verify', function () {
//    return view('auth.verify');
//})->middleware('auth')->name('verification.notice');
//
//
//
//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//
//    return back()->with('message', 'Verification link sent!');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

//Route::group(['middleware' => 'verified'], function (){
//
//    Route::get('/calender', function (){
//        echo "calender";
//    })->name('calender');
//
//    Route::get('/typography', function (){
//        echo "typography";
//    })->name('typography');
//
//});
