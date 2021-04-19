<?php


use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\API\dataRetriveController;
use App\Http\Controllers\Api\DeletableController;
use App\Http\Controllers\Api\deletablsController;
use App\Http\Controllers\Api\Deleted_postsController;
use App\Http\Controllers\Api\Failed_jobsController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\FollowerController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\Password_resetController;
use App\Http\Controllers\Api\Post_tagController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RetriveController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
 * jwt Routs
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['EnsureJwtToken'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/post_tag', Post_tagController::class);


});

Route::resource('/posts', PostController::class);
Route::resource('/Password_reset', Password_resetController::class);
Route::resource('/likes', LikeController::class);
Route::resource('/jops', JobController::class);
Route::resource('/followers', FollowerController::class);
Route::resource('/files', FileController::class);
Route::resource('/failed_jobs', Failed_jobsController::class);
Route::resource('/deleted_posts', Deleted_postsController::class);

//Route::resource('/a', DeletableController::class);

Route::resource('/comment', CommentController::class);



Route::resource('/deletable', DeletableController::class);



Route::post('/logout', [AuthController::class,'logout']);
Route::post('/refresh',[AuthController::class,'refresh']);
Route::post('/me', [AuthController::class,'me']);




/*
|--------------------------------------------------------------------------
|Relations API Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/userLikePost/{id}', [RetriveController::class,'userLikePost']);
Route::get('/userFiles/{id}', [dataRetriveController::class,'userFiles']);
Route::get('/userCategorie/{id}', [dataRetriveController::class,'userCategorie']);






/*
|--------------------------------------------------------------------------
|share main api
|--------------------------------------------------------------------------
|
*/
Route::post('login',[AuthController::class,'login']);
Route::resource('/posts', PostController::class);
Route::get('/search/{x}', [SearchController::class,'search']);
Route::get('/seepost/{x}', [SearchController::class,'seePost']);
Route::resource('/category', CategorieController::class);




