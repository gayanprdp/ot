<?php

use App\Http\Livewire\PostIndex;
use App\Http\Livewire\ManageUser;
use App\Http\Livewire\ManageEmployee;
use App\Http\Livewire\ManageInstitute;
use App\Http\Livewire\ManageSubInstitute;
use App\Http\Livewire\ManageDesignation;
use App\Http\Livewire\OTlist;
use App\Http\Livewire\OTlist_status;
use App\Http\Livewire\OTlist_completed;
use App\Http\Livewire\OTrecords;
use App\Http\Livewire\PrintOTRec;
use App\Http\Livewire\PrintOTRec2;
use App\Http\Livewire\Otdashboard;

use App\Http\Controllers\MailController;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::get('/send-mail/{param}', [MailController::class, 'index']);


Route::get('/storage-link', function(){
 $targetFolder=storage_path('app/public');
 $linkFolder=$_SERVER['DOCUMENT_ROOT'].'/storage';
 symlink($targetFolder,$linkFolder);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manageinstitute',ManageInstitute::class)->name('manage.institute');
    //Route::get('/managesubinstitute',ManageSubInstitute::class)->name('manage.subinstitute');
    Route::get('/managesubinstitute/{insid}',ManageSubInstitute::class)->name('manage.subinstitute');
    Route::get('/posts',PostIndex::class)->name('post.index');
    Route::get('/manageuser',ManageUser::class)->name('manage.user');
    Route::get('/manageemployeer/{param}',ManageEmployee::class)->name('manage.employee');
    Route::get('/managedesignation',ManageDesignation::class)->name('manage.designation');
    Route::get('/otlist/{param}',OTlist::class)->name('ot.list');
    Route::get('/otlist_status/{param}/{param2}',OTlist_status::class)->name('ot.list.status');
    Route::get('/otlist_completed/{param}',OTlist_completed::class)->name('ot.list.completed');
    
    Route::get('/otrecords/{param}/{param1}/{param2}/{param3}/{type}',OTrecords::class)->name('ot.records');
    Route::get('/printotrecords/{param}/{param2}',PrintOTRec::class)->name('print.ot.records');
    Route::get('/printotrecords2/{param}/{param2}',PrintOTRec2::class)->name('print.ot.records');
    Route::get('/otdashboard',Otdashboard::class)->name('OT.dashboard');
    Route::get('/',Otdashboard::class)->name('OT.dashboard');

});


















