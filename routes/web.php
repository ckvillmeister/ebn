<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BidTransactionController;
use App\Http\Controllers\FSMRContentController;
use App\Http\Controllers\AttachmentTypeController;
use App\Http\Controllers\FDASController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Artisan;
use App\Events\DocumentStored;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware(['auth', 'verified'])->name('login');

//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/client', [ClientController::class, 'index'])->name('client');
    Route::get('/transaction/fsmr/application', [TransactionController::class, 'fsmrApp'])->name('transaction-fsmr-application');
    Route::get('/transaction/fsmr/myapplications', [TransactionController::class, 'fsmrMyApp'])->name('transaction-fsmr-my-applications');
    Route::get('/transaction/fsmr/list', [TransactionController::class, 'fsmrList'])->name('transaction-fsmr-list');
    Route::get('/transaction/fsmr/view', [TransactionController::class, 'viewFSMR'])->name('transaction-fsmr-view');

    #Transactions (FSMR)
    Route::post('/transaction/fsmr/fsmrRetrieve', [TransactionController::class, 'fsmrList']);
    Route::post('/transaction/fsmr/myFSMRRetrieve', [TransactionController::class, 'fsmrMyApp']);
    Route::post('/transaction/fsmr/saveFSMR', [TransactionController::class, 'fsmrApp']);
    Route::post('/transaction/fsmr/save-fps', [TransactionController::class, 'saveFPS']);
    Route::post('/transaction/fsmr/save-eer', [TransactionController::class, 'saveEER']);
    Route::post('/transaction/fsmr/save-fss', [TransactionController::class, 'saveFSS']);
    Route::post('/transaction/fsmr/save-assessment', [TransactionController::class, 'saveAssessment']);
    Route::post('/transaction/fsmr/printFSMR', [TransactionController::class, 'printFSMR'])->name('transaction-fsmr-print');

    #Delivery
    Route::get('/transaction/delivery', [TransactionController::class, 'delivery'])->name('transaction-delivery');
    Route::get('/transaction/delivery/list', [TransactionController::class, 'deliveryList'])->name('transaction-delivery-list');
    Route::any('/transaction/delivery/trans/list', [TransactionController::class, 'deliveryTransList'])->name('transaction-delivery-trans-list');
    Route::post('/transaction/delivery/save', [TransactionController::class, 'saveDelivery'])->name('transaction-delivery-save');
    Route::get('/transaction/delivery/new-product', [TransactionController::class, 'productForm'])->name('transaction-delivery-product-new');
    Route::post('/transaction/delivery/view', [TransactionController::class, 'viewDeliveryTransaction'])->name('transaction-delivery-view');
    Route::post('/transaction/delivery/delete', [TransactionController::class, 'deleteDeliveryTransaction'])->name('transaction-delivery-delete');

    #Sales
    Route::get('/transaction/sales', [TransactionController::class, 'sales'])->name('transaction-sales-entry');
    Route::post('/transaction/sales/get-products', [TransactionController::class, 'getProductsByLocation'])->name('transaction-sales-get-products');
    Route::post('/transaction/sales/save', [TransactionController::class, 'saveSalesTransaction'])->name('transaction-sales-save');
    Route::get('/transaction/sales/list', [TransactionController::class, 'salesList'])->name('transaction-sales-list');
    Route::any('/transaction/sales/trans/list', [TransactionController::class, 'salesTransList'])->name('transaction-sales-trans-list');
    Route::post('/transaction/sales/void', [TransactionController::class, 'voidSalesTransaction'])->name('transaction-sales-void');
    Route::post('/transaction/sales/view', [TransactionController::class, 'viewSalesTransaction'])->name('transaction-sales-view');

    #Inventory
    Route::get('/transaction/inventory', [TransactionController::class, 'inventory'])->name('transaction-inventory');
    Route::get('/transaction/inventory/new-product', [TransactionController::class, 'productForm'])->name('transaction-product-new');
    Route::get('/transaction/inventory/new-update', [TransactionController::class, 'productForm'])->name('transaction-product-update');
    Route::post('/transaction/inventory/store-product', [TransactionController::class, 'storeProduct'])->name('transaction-product-store');
    Route::any('/transaction/inventory/product-list', [TransactionController::class, 'productList'])->name('transaction-product-list');
    Route::post('/transaction/inventory/toggle-product-status', [TransactionController::class, 'toggleProductStatus'])->name('transaction-product-toggle-status');
    Route::post('/transaction/inventory/manage-stocks', [TransactionController::class, 'manageStocks'])->name('transaction-manage-stocks');
    Route::get('/transaction/inventory/view-product', [TransactionController::class, 'viewProduct'])->name('transaction-view-product');

    #Bid Documents
    Route::get('/transaction/bid-docs-list', [BidTransactionController::class, 'index'])->name('bid-docs-list');


    Route::prefix('transaction/bids')->group(function () {
        #Bid Documents - Projects
        Route::get('projects', [BidTransactionController::class, 'projectIndex'])->name('projects.index');
        Route::get('projects/create', [BidTransactionController::class, 'projectCreate'])->name('projects.create');
        Route::post('projects/store', [BidTransactionController::class, 'projectStore'])->name('projects.store');
        Route::get('projects/edit/{id}', [BidTransactionController::class, 'projectEdit'])->name('projects.edit');
        Route::post('projects/update/{id}', [BidTransactionController::class, 'projectUpdate'])->name('projects.update');
        Route::get('projects/view/{id}', [BidTransactionController::class, 'projectView'])->name('projects.view');
        Route::get('projects/toggle/{id}', [BidTransactionController::class, 'projectToggle'])->name('projects.toggle');
        Route::delete('/projects/trash/{id}', [BidTransactionController::class, 'trash'])->name('projects.trash');
        Route::post('/projects/restore/{id}', [BidTransactionController::class, 'restore'])->name('projects.restore');

        Route::get('projects/{projectId}/ongoing/list', [BidTransactionController::class, 'ongoingList']);
        Route::post('projects/{projectId}/ongoing/store', [BidTransactionController::class, 'storeOrUpdateOngoing']);
        Route::delete('projects/ongoing/delete/{id}', [BidTransactionController::class, 'ongoingDelete']);
        Route::get('/projects/ongoing/search/all', [BidTransactionController::class, 'searchAllOngoing']);
        Route::get('/projects/ongoing/show/{id}', [BidTransactionController::class, 'showOngoing']);

        Route::get('projects/{projectId}/slcc/list', [BidTransactionController::class, 'slccList']);
        Route::post('projects/{projectId}/slcc/store', [BidTransactionController::class, 'storeOrUpdateSlcc']);
        Route::delete('projects/slcc/delete/{id}', [BidTransactionController::class, 'slccDelete']);
        Route::get('projects/slcc/search/all', [BidTransactionController::class, 'searchAllSlcc']);
        Route::get('projects/slcc/show/{id}', [BidTransactionController::class, 'showSlcc']);

        Route::get('projects/{project}/delivery-schedule', [BidTransactionController::class, 'deliveryScheduleIndex']);
        Route::post('projects/{project}/delivery-schedule/store', [BidTransactionController::class, 'deliveryScheduleStore']);
        Route::post('delivery-schedule/update/{id}', [BidTransactionController::class, 'deliveryScheduleUpdate']);
        Route::delete('delivery-schedule/delete/{id}', [BidTransactionController::class, 'deliveryScheduleDelete']);

        Route::get('projects/{project}/detailed-estimates', [BidTransactionController::class, 'detailedEstimateIndex']);
        Route::post('projects/{project}/detailed-estimates/store', [BidTransactionController::class, 'detailedEstimateStore']);
        Route::post('detailed-estimates/update/{id}', [BidTransactionController::class, 'detailedEstimateUpdate']);
        Route::delete('detailed-estimates/delete/{id}', [BidTransactionController::class, 'detailedEstimateDelete']);

        Route::get('projects/{project}/manpower', [BidTransactionController::class, 'manpowerIndex']);
        Route::post('projects/{project}/manpower/store', [BidTransactionController::class, 'manpowerStore']);
        Route::post('manpower/update/{id}', [BidTransactionController::class, 'manpowerUpdate']);
        Route::delete('manpower/delete/{id}', [BidTransactionController::class, 'manpowerDelete']);

        Route::get('projects/{project}/tools-equipments', [BidTransactionController::class, 'teIndex']);
        Route::post('projects/{project}/tools-equipments/store', [BidTransactionController::class, 'teStore']);
        Route::post('tools-equipments-requirement/update/{id}', [BidTransactionController::class, 'teUpdate']);
        Route::delete('tools-equipments-requirement/delete/{id}', [BidTransactionController::class, 'teDelete']);

        Route::get('projects/{project}/nfcc', [BidTransactionController::class, 'nfccIndex']);
        Route::post('projects/{project}/nfcc/store', [BidTransactionController::class, 'nfccStore']);
        Route::post('nfcc/update/{id}', [BidTransactionController::class, 'nfccUpdate']);
        Route::delete('nfcc/delete/{id}', [BidTransactionController::class, 'nfccDelete']);

        Route::post('projects/{id}/attachments/store',[BidTransactionController::class, 'attachmentStore'])->name('projects.attachments.store');
        Route::delete('projects/attachments/delete/{id}',[BidTransactionController::class, 'attachmentDelete'])->name('projects.attachments.delete');

        Route::get('/transaction/bids/projects/{id}/{component}/print', [BidTransactionController::class, 'printBidDocs'])->name('projects.print');

        #Bid Documents - Default Upload Types
        Route::get('default-upload-types', [BidTransactionController::class, 'defDocumentIndex'])->name('default-upload-types');
        Route::post('default-upload-types/store', [BidTransactionController::class, 'defDocumentStore'])->name('default-upload-types.store');
        Route::post('default-upload-types/update/{id}', [BidTransactionController::class, 'defDocumentUpdate']);
        Route::get('default-upload-types/toggle/{id}', [BidTransactionController::class, 'defDocumentToggle']);
        Route::get('default-upload-types/{id}/uploads', [BidTransactionController::class, 'defDocumentUploadPage'])->name('def-doc.upload.page');
        Route::post('default-upload-types/{id}/uploads/store', [BidTransactionController::class, 'defDocumentUploadStore'])->name('def-doc.upload.store');
        Route::get('default-upload-types/uploads/set-active/{id}', [BidTransactionController::class, 'defDocumentUploadSetActive']);
        Route::get('default-upload-types/uploads/set-inactive/{id}', [BidTransactionController::class, 'defDocumentUploadSetInactive']);

        #Bid Documents - Man-Power Types
        Route::get('man-power-types', [BidTransactionController::class, 'manPowerTypeIndex'])->name('manpower.index');
        Route::post('man-power-types/store', [BidTransactionController::class, 'manPowerTypeStore'])->name('manpower.store');
        Route::post('man-power-types/update/{id}', [BidTransactionController::class, 'manPowerTypeUpdate']);
        Route::get('man-power-types/toggle/{id}', [BidTransactionController::class, 'manPowerTypeToggle']);

        #Bid Documents - Tools and Equipment
        Route::get('tools-equipments', [BidTransactionController::class, 'equipmentIndex'])->name('equipment.index');
        Route::post('tools-equipments/store', [BidTransactionController::class, 'equipmentStore'])->name('equipment.store');
        Route::post('tools-equipments/update/{id}', [BidTransactionController::class, 'equipmentUpdate']);
        Route::get('tools-equipments/toggle/{id}', [BidTransactionController::class, 'equipmentToggle']);

        #Bid Documents - Manage Pages
        Route::get('/pages/sequencing', [BidTransactionController::class, 'pagesSequencing'])->name('pages.index');
        Route::post('/pages/sequencing/update', [BidTransactionController::class, 'pagesSequencingUpdate']);
    });

    Route::get('/setup/fsmr-content', [FSMRContentController::class, 'index'])->name('content');
    Route::get('/setup/attachment', [AttachmentTypeController::class, 'index'])->name('attachment');
    Route::get('/setup/fdas', [FDASController::class, 'index'])->name('fdas');
    Route::get('/setup/questions', [QuestionnaireController::class, 'index'])->name('questions');
    Route::get('/setup/signatories', [SignatoryController::class, 'index'])->name('signatories');
    Route::get('/setup/fdas/manage-devices', [FDASController::class, 'fdasDevices'])->name('manage-devices');
    Route::get('/setup/fsmr-content/sub-contents', [FSMRContentController::class, 'fsmrSubContents'])->name('manage-sub-contents');

    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/roles', [RolesController::class, 'index'])->name('roles');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/user/changepass', [UserController::class, 'changePassword'])->name('change-password');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/defaults', [SettingsController::class, 'defaults'])->name('settings-defaults');
    Route::get('/settings/backupdb', [SettingsController::class, 'backupBD'])->name('backup-db');
    Route::get('/settings/backupfiles', [SettingsController::class, 'backupFiles'])->name('backup-files');

    Route::get('/client/new', [ClientController::class, 'create'])->name('new-client');
    Route::post('/client/store', [ClientController::class, 'store'])->name('store-client');
    Route::get('/client/profile', [ClientController::class, 'profile'])->name('client-profile');
    Route::post('/clientToggleStatus', [ClientController::class, 'toggleStatus']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/reports/displayReports', [ReportsController::class, 'displayReports']);

    #Attachment Types
    Route::post('/type-retrieve', [AttachmentTypeController::class, 'retrieve']);
    Route::post('/type-create', [AttachmentTypeController::class, 'create']);
    Route::post('/type-store', [AttachmentTypeController::class, 'store']);
    Route::post('/type-toggle-status', [AttachmentTypeController::class, 'toggleStatus']);

    #FSMR Content
    Route::post('/content-retrieve', [FSMRContentController::class, 'retrieve']);
    Route::post('/content-create', [FSMRContentController::class, 'create']);
    Route::post('/content-store', [FSMRContentController::class, 'store']);
    Route::post('/content-toggle-status', [FSMRContentController::class, 'toggleStatus']);
    Route::post('/sub-content-retrieve', [FSMRContentController::class, 'retrieveSubContents']);
    Route::post('/sub-content-create', [FSMRContentController::class, 'createSubContent']);
    Route::post('/sub-content-store', [FSMRContentController::class, 'storeSubContent']);
    Route::post('/sub-content-remove', [FSMRContentController::class, 'removeSubContent']);

    #FDAS Content
    Route::post('/fdas-categ-retrieve', [FDASController::class, 'retrieveCategories']);
    Route::post('/fdas-categ-create', [FDASController::class, 'createCategory']);
    Route::post('/fdas-categ-store', [FDASController::class, 'storeCategory']);
    Route::post('/fdas-categ-toggle-status', [FDASController::class, 'toggleCategoryStatus']);
    Route::post('/fdas-device-create', [FDASController::class, 'createDevice']);
    Route::post('/fdas-device-store', [FDASController::class, 'storeDevice']);
    Route::post('/fdas-device-toggle-status', [FDASController::class, 'toggleDeviceStatus']);

    #Questions
    Route::post('/questions-retrieve', [QuestionnaireController::class, 'retrieveQuestions']);
    Route::post('/questions-create', [QuestionnaireController::class, 'createQuestion']);
    Route::post('/questions-store', [QuestionnaireController::class, 'storeQuestion']);
    Route::post('/questions-toggle-status', [QuestionnaireController::class, 'toggleQuestionStatus']);

    #Signatory
    Route::post('/signatory-retrieve', [SignatoryController::class, 'retrieve']);
    Route::post('/signatory-create', [SignatoryController::class, 'create']);
    Route::post('/signatory-store', [SignatoryController::class, 'store']);
    Route::post('/signatory-toggle-status', [SignatoryController::class, 'toggleStatus']);

    #Permissions
    Route::post('/permissionRetrieve', [PermissionController::class, 'retrieve']);
    Route::post('/permissionCreate', [PermissionController::class, 'create']);
    Route::post('/permissionStore', [PermissionController::class, 'store']);
    Route::post('/permissionToggleStatus', [PermissionController::class, 'toggleStatus']);

    #Roles
    Route::post('/roleRetrieve', [RolesController::class, 'retrieve']);
    Route::post('/roleCreate', [RolesController::class, 'create']);
    Route::post('/roleStore', [RolesController::class, 'store']);
    Route::post('/roleToggleStatus', [RolesController::class, 'toggleStatus']);

    #User Accounts
    Route::post('/userRetrieve', [UserController::class, 'retrieve']);
    Route::post('/userCreate', [UserController::class, 'create']);
    Route::post('/userStore', [UserController::class, 'store']);
    Route::post('/userToggleStatus', [UserController::class, 'toggleStatus']);
    Route::post('/userResetPass/{action}', [UserController::class, 'resetPassword']);
    Route::post('/user/change/password', [UserController::class, 'changePassword']);

    #Settings
    Route::post('/settings/save', [SettingsController::class, 'saveSettings']);

});
#Registration
Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/register/client', [UserController::class, 'register'])->name('register-client');

Route::get('/run-migrations', function () {
    Artisan::call('migrate');
    return 'Migrations run successfully!';
});

Route::get('/run-seeder', function () {
    Artisan::call('db:seed');
    return 'Seeders run successfully!';
});

#Address (For client info creation)
Route::post('/address/towns/{code}', [AddressController::class, 'towns']);
Route::post('/address/barangays/{code}', [AddressController::class, 'barangays']);

require __DIR__.'/auth.php';
