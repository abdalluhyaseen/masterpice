<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Book_Page;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FieldHistoryController;
use App\Http\Controllers\FieldImagesController;
use App\Http\Controllers\FieldTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SportTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Landing;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thesecp .env.example .env

| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ** controllers ** //

// Routes for UserController
Route::resource('users', UserController::class);

// Routes for BookingController
Route::resource('bookings', BookingController::class);

// Routes for ContactUsController
Route::post('/contact/store', [ContactUsController::class, 'store'])->name('contact.store'); // تعديل

// Routes for FieldController
Route::resource('fields', FieldController::class);

// Routes for FieldHistoryController
Route::resource('field-histories', FieldHistoryController::class);

// Routes for FieldImagesController
Route::resource('field-images', FieldImagesController::class);

// Routes for FieldTypeController
Route::resource('field-types', FieldTypeController::class);

// Routes for SportTypeController
Route::resource('sport-types', SportTypeController::class);



Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

/////landing_page


Route::get('/', [Landing::class,'index'])->name('Home');

Route::get('/contact', function () {
    return view('landing_page.pages.contact');
})->name('contact');

Route::get('/about', function () {
    return view('landing_page.pages.about');
})->name('about');
Route::resource('services', ServiceController::class);
Route::get('/blogs', function () {
    return view('landing_page.pages.blogs');
})->name('blogs');
// zaina change
// Route::get('/book', [Book_Page::class,'index'])->name('book');
Route::get('/book/{field_id}', [Book_Page::class, 'index'])->name('book');

// Route::get('/show-available-times', [BookingController::class, 'showAvailableTimes'])->name('showAvailableTimes');



Route::post('/contact/store', [ContactUsController::class, 'store'])->name('contact.store');

Route::post('/contact/reply', [ContactUsController::class, 'reply'])->name('contact.reply');

Route::get('/bookings/{fieldId}/available-hours', [BookingController::class, 'getAvailableHours'])->name('bookings.available_hours');


///Dashboard
Route::get('/dash', function () {
    return view('Dashboard.main');
});

Route::get('/profile', function () {
    $user = Auth::user();
    return view('landing_page.pages.profile', ['user'=> $user]);
})->name('profile')->middleware(['auth']);

Route::get('/edit-profile', function () {
    $user = Auth::user();
    return view('landing_page.pages.edit-profile', ['user'=> $user]);
})->middleware(['auth']);


// update user information
Route::patch('/update-user', function() {
    // Validate the request data


    $validatedData = request()->validate([
        'name' => ['required'],
        'email' => ['required', 'email'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        'phone' => ['nullable', 'regex:/^07[0-9]{8}$/'],
    ]);


    $user = Auth::user();

    if(request()->has('image'))
    {
        $file = request()->file('image');
        $extention = $file->getClientOriginalExtension();

        $filename = time() .'.'. $extention;

        $path = 'uploads/user_image/';
        $file->move( $path, $filename);

        $user->update([
            'image' => $path.$filename,
        ]);
    }

    // Get the authenticated user



    // Update the user's other information
    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'] ?? $user->phone,
    ]);

    // Redirect with success message
    return redirect('profile')->with('success', 'Profile updated successfully.');
})->middleware(['auth']);


// remove photo
Route::post('/profile/remove-photo', [UserController::class, 'remove'])->name('users.remove');



Route::get('/edit-password', function () {
    $user = Auth::user();
    return view('landing_page.pages.edit-password', ['user'=> $user]);
})->middleware(['auth']);

Route::patch('/update-password', function () {
    request()->validate([
        'new' => ['required','string','min:8'],
        'confirm' => ['required','string','min:8','same:new'],
    ]);

    $user = Auth::user();

    $user->update([
        'password' => bcrypt(request()->new),
    ]);

    return redirect('profile')->with('success', 'password updated successfully.');
})->middleware(['auth']);



Route::get('/dash', [DashboardController::class, 'index'])->middleware(['auth','admin'])->name('dashboard.main');


// Create user
Route::get('/dash/create-user', [UserController::class, 'create'])->name('dash.create-user');
Route::middleware(['auth','admin'])->group(function () {

// Create user

    // Delete user
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
// Edit user

Route::get('/users/{id}/edit-role', [UserController::class, 'editRole'])->middleware(['auth'])->name('users.editRole');
Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->middleware(['auth'])->name('users.updateRole');


// contact us
Route::get('/dash/contact-us', [ContactUsController::class, 'index'])->name('dashboard.contact_us');
////////////change zaina
Route::put('/bookings/{id}/updateStatus', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');

Route::resource('a_profile', AdminProfileController::class)->middleware(['auth','admin']);
