<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShowroomController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ShowroomController as AdminShowroomController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\DirectorController as AdminDirectorController;
use App\Http\Controllers\Admin\HistoryController as AdminHistoryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ButtonTypeController;
use App\Http\Controllers\Admin\CustomOrderController;
use App\Http\Controllers\Admin\CabinController as AdminCabinController;
use App\Http\Controllers\Admin\DiagnosticTestController as AdminDiagnosticTestController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\HealthBlogController as AdminHealthBlogController;
use App\Http\Controllers\Admin\BloodBankController as AdminBloodBankController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\LabReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Models\CustomOrder;

Route::get('/clear', function () {
    try {
        Artisan::call('optimize:clear');
        try { Artisan::call('storage:link'); } catch (\Throwable $e) {}
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);

        // Auto fix booking types for existing service bookings
        CustomOrder::whereNotNull('company')
            ->where('company', '!=', 'General OPD')
            ->whereNull('cabin_id')
            ->update(['booking_type' => 'medical_service']);

        return 'Cleared, Migrated, Seeded, Storage Symlinked & Booking Types Fixed Successfully!';
    } catch (\Throwable $e) {
        return response('Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 500);
    }
});

// Guaranteed Application CV PDF Serving Route
Route::get('/storage/applications/{filename}', function ($filename) {
    $filePath = storage_path('app/public/applications/' . $filename);
    if (file_exists($filePath)) {
        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
    
    $altFilePath = storage_path('app/applications/' . $filename);
    if (file_exists($altFilePath)) {
        return response()->file($altFilePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    return response('Application CV File Not Found', 404);
});

// Guaranteed Uploaded File Server Route (Bypasses broken Windows OS public/storage symlinks)
Route::get('/uploads/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath) ?: 'application/octet-stream';
        return response()->file($filePath, ['Content-Type' => $mime, 'Content-Disposition' => 'inline']);
    }
    
    $altFilePath = storage_path('app/' . $path);
    if (file_exists($altFilePath)) {
        $mime = mime_content_type($altFilePath) ?: 'application/octet-stream';
        return response()->file($altFilePath, ['Content-Type' => $mime, 'Content-Disposition' => 'inline']);
    }

    return response('File Not Found', 404);
})->where('path', '.*');

// Fail-Safe Storage File Serving Route
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath) ?: 'application/octet-stream';
        return response()->file($filePath, ['Content-Type' => $mime, 'Content-Disposition' => 'inline']);
    }
    
    $altFilePath = storage_path('app/' . $path);
    if (file_exists($altFilePath)) {
        $mime = mime_content_type($altFilePath) ?: 'application/octet-stream';
        return response()->file($altFilePath, ['Content-Type' => $mime, 'Content-Disposition' => 'inline']);
    }

    return response('File Not Found', 404);
})->where('path', '.*');

// Language Switcher
Route::get('/lang/{locale}', [HomeController::class, 'switchLanguage'])->name('lang.switch');

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/about/mission', [HomeController::class, 'mission'])->name('mission');
Route::get('/about/history', [HomeController::class, 'history'])->name('history');
Route::get('/about/directors', [HomeController::class, 'directors'])->name('directors');
Route::get('/doctors/{slug}', [HomeController::class, 'doctorDetails'])->name('doctors.show');

Route::get('/cabins', [HomeController::class, 'cabins'])->name('cabins.index');
Route::get('/cabins/{id}', [HomeController::class, 'cabinDetails'])->name('cabins.show');

Route::get('/tests', [HomeController::class, 'tests'])->name('tests.index');

Route::get('/equipment', [HomeController::class, 'equipment'])->name('equipment.index');
Route::get('/equipment/{id}', [HomeController::class, 'equipmentDetails'])->name('equipment.show');

Route::get('/specialties/{id}', [HomeController::class, 'specialtyDetails'])->name('specialties.show');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories');
Route::get('/categories/{slug}', [FrontendCategoryController::class, 'show'])->name('categories.show');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/showrooms', [ShowroomController::class, 'index'])->name('showrooms');
Route::get('/showrooms/{slug}', [ShowroomController::class, 'show'])->name('showrooms.show');

Route::get('/career', [CareerController::class, 'index'])->name('career');
Route::get('/career/{slug}', [CareerController::class, 'show'])->name('career.show');
Route::post('/career/{slug}/apply', [CareerController::class, 'apply'])->name('career.apply');
Route::get('/career/success', [CareerController::class, 'index'])->name('career.success');

Route::post('/custom-order', [HomeController::class, 'customOrder'])->name('custom-order.submit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::post('/products/{product}/variants', [AdminProductController::class, 'storeVariant'])->name('products.storeVariant');
        Route::delete('/variants/{variant}', [AdminProductController::class, 'destroyVariant'])->name('products.destroyVariant');
        Route::post('/products/{product}/images', [AdminProductController::class, 'storeImage'])->name('products.storeImage');
        Route::delete('/images/{image}', [AdminProductController::class, 'destroyImage'])->name('products.destroyImage');
        Route::resource('showrooms', AdminShowroomController::class)->except(['show']);
        Route::resource('jobs', AdminJobController::class)->except(['show']);
        Route::get('/jobs/{job}/applications', [AdminJobController::class, 'showApplications'])->name('jobs.applications');
        Route::resource('directors', AdminDirectorController::class)->except(['show']);
        Route::resource('histories', AdminHistoryController::class)->except(['show']);
        Route::resource('pages', AdminPageController::class)->except(['show']);
        
        Route::get('/applications', [AdminJobController::class, 'applications'])->name('applications.index');
        Route::patch('/applications/{application}/status', [AdminJobController::class, 'updateApplicationStatus'])->name('applications.status');
        Route::delete('/applications/{application}', [AdminJobController::class, 'destroyApplication'])->name('applications.destroy');
        
        Route::get('/media', [AdminPageController::class, 'mediaIndex'])->name('media.index');
        Route::post('/media', [AdminPageController::class, 'mediaStore'])->name('media.store');
        Route::post('/media/{media}/set-logo', [AdminPageController::class, 'mediaSetLogo'])->name('media.setLogo');
        Route::delete('/media/{media}', [AdminPageController::class, 'mediaDestroy'])->name('media.destroy');
        Route::post('/content/video', [AdminPageController::class, 'videoUpdate'])->name('content.video');

        Route::resource('button-types', ButtonTypeController::class)->except(['show']);

        // New Hospital CMS Admin Modules
        Route::resource('cabins', AdminCabinController::class)->except(['show']);
        Route::resource('diagnostic-tests', AdminDiagnosticTestController::class)->except(['show']);
        Route::resource('medical-equipments', AdminMedicalEquipmentController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);
        Route::resource('health-blogs', AdminHealthBlogController::class)->except(['show']);
        Route::resource('blood-banks', AdminBloodBankController::class)->except(['show']);

        // Complete Hospital Management System (ERP) Core Modules
        Route::resource('patients', PatientController::class);
        
        Route::get('/prescriptions/{prescription}/print', [PrescriptionController::class, 'print'])->name('prescriptions.print');
        Route::resource('prescriptions', PrescriptionController::class);

        Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
        Route::resource('invoices', InvoiceController::class);

        Route::resource('inventories', InventoryController::class)->except(['show']);

        Route::get('/lab-reports/{labReport}/print', [LabReportController::class, 'print'])->name('lab-reports.print');
        Route::resource('lab-reports', LabReportController::class);

        Route::get('/custom-orders/print', [CustomOrderController::class, 'printAppointments'])->name('custom-orders.print');
        Route::get('/custom-orders', [CustomOrderController::class, 'index'])->name('custom-orders.index');
        Route::patch('/custom-orders/{customOrder}/status', [CustomOrderController::class, 'updateStatus'])->name('custom-orders.status');
        Route::delete('/custom-orders/{customOrder}', [CustomOrderController::class, 'destroy'])->name('custom-orders.destroy');
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';