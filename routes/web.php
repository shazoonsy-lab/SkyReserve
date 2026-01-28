<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeWebhookController;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

// Admin
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    FlightController as AdminFlightController,
    BookingController as AdminBookingController,
    ProfileController as AdminProfileController,
    SettingController,
    ActivityLogController,
    PaymentApprovalController,
    AiAssistantController,
    UserController

};

// Employee
use App\Http\Controllers\Employee\{
    DashboardController as EmployeeDashboardController,
    BookingController as EmployeeBookingController,
    FlightController as EmployeeFlightController,
    ProfileController as EmployeeProfileController,
 

    
    
};
use App\Http\Controllers\PublicBookingController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\PublicFlightController;
use App\Http\Controllers\Employee\PaymentController;


/*
|--------------------------------------------------------------------------
| Public Website (NO AUTH)
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('public.home'))->name('home');

Route::get('/flights', [PublicFlightController::class, 'index'])
    ->name('flights.index');

Route::get('/flights/{flight}', [PublicFlightController::class, 'show'])
    ->name('flights.show');

Route::get('/offers', fn () => view('website.offers'))->name('offers');
Route::get('/contact', fn () => view('website.contact'))->name('contact');

/*
|--------------------------------------------------------------------------
| ChatBot
|--------------------------------------------------------------------------
*/

Route::get('/chatbot', fn () => view('website.chatbot'))->name('chatbot');
Route::post('/chatbot/message', [ChatBotController::class, 'message'])
    ->name('chatbot.message');

/*
|--------------------------------------------------------------------------
| Public Booking
|--------------------------------------------------------------------------
*/

Route::get('/booking', fn () => view('website.booking'))->name('booking');
Route::post('/booking', [PublicBookingController::class, 'store'])
    ->name('booking.store');

Route::get('/booking/success/{code}', fn ($code) =>
    view('website.booking-success', compact('code'))
)->name('booking.success');

/*
|--------------------------------------------------------------------------
| Company Login
|--------------------------------------------------------------------------
*/

Route::get('/company/login', fn () => view('auth.company-login'))
    ->middleware('guest')
    ->name('company.login');


/*
|--------------------------------------------------------------------------
| Authentication (Admin & Employee ONLY)
|--------------------------------------------------------------------------
*/



require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

            Route::resource('users', UserController::class);


        Route::resource('flights', AdminFlightController::class);
        Route::resource('bookings', AdminBookingController::class);

        Route::put(
            'bookings/{booking}/status',
            [AdminBookingController::class, 'updateStatus']
        )->name('bookings.updateStatus');

        Route::get('profile', [AdminProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('profile', [AdminProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('settings', [SettingController::class, 'edit'])
            ->name('settings.edit');

        Route::put('settings', [SettingController::class, 'update'])
            ->name('settings.update');

        Route::get('activity-logs', [ActivityLogController::class, 'index'])
            ->name('activity.logs');

             // صفحة الحجوزات بانتظار موافقة الدفع
    Route::get('payments/approvals', [PaymentApprovalController::class, 'index'])
        ->name('payments.approvals');

    // الموافقة على الدفع
    Route::post('payments/{booking}/approve', [PaymentApprovalController::class, 'approve'])
        ->name('payments.approve');

    // رفض الدفع
    Route::post('payments/{booking}/reject', [PaymentApprovalController::class, 'reject'])
        ->name('payments.reject');
    });



// عرض واجهة المساعد الذكي
Route::get('/ai-assistant', [AiAssistantController::class, 'showPage'])
    ->name('admin.ai.page');

Route::post('/ai-assistant', [AiAssistantController::class, 'ask'])
    ->name('admin.ai.ask');

 








/*
|--------------------------------------------------------------------------
| Employee Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('bookings', EmployeeBookingController::class)
            ->except(['destroy']);

        Route::resource('flights', EmployeeFlightController::class)
            ->only(['index', 'show']);

        Route::post(
            'bookings/{booking}/mark-paid',
            [PaymentController::class, 'markAsPaid']
        )->name('bookings.paid');

        Route::get('profile', [EmployeeProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('profile', [EmployeeProfileController::class, 'update'])
            ->name('profile.update');


            
        // ✅ هذا هو الراوت الناقص
       Route::get('/bookings/{booking}/payment', 
            [EmployeeBookingController::class, 'payment'])
            ->name('bookings.payments');

                  // ✅ هذا هو المهم
        Route::post('/bookings/{booking}/payment',
            [EmployeeBookingController::class, 'processPayment'])
           ->name('bookings.payments.process');


               Route::get(
            '/bookings/{booking}/payment/card',
            [PaymentController::class, 'show']
        )->name('bookings.payments.card');

        Route::post(
            '/bookings/{booking}/payment/confirm',
            [PaymentController::class, 'confirm']
        )->name('bookings.payments.confirm');


       
  

    });
    

/*
|--------------------------------------------------------------------------
| Smart Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'employee' => redirect()->route('employee.dashboard'),
    };
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

     Route::post('/webhooks/stripe', [StripeWebhookController::class, 'handle']);
   