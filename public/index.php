<?php

spl_autoload_register(function ($class) {
    
    $prefix = 'App\\';

    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\Router;
use App\Core\Env;
use App\Core\ErrorHandler;

Env::load(__DIR__ . '/../.env');

ErrorHandler::register();

ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_start();

$router = new Router();

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/login', 'AuthController@showLogin');
$router->add('POST', '/login', 'AuthController@processLogin');
$router->add('GET', '/signup', 'AuthController@showSignup');
$router->add('POST', '/signup', 'AuthController@processSignup');
$router->add('GET', '/logout', 'AuthController@logout');

$router->add('GET', '/dashboard', 'DashboardController@index');
$router->add('GET', '/my-courses', 'DashboardController@myCourses', ['AuthMiddleware']);
$router->add('GET', '/settings', 'UserController@settings', ['AuthMiddleware']);

$router->add('GET', '/about', 'HomeController@about');
$router->add('GET', '/contact', 'HomeController@contact');
$router->add('GET', '/pricing', 'HomeController@pricing');
$router->add('GET', '/trainers', 'HomeController@trainers');
$router->add('GET', '/certification', 'HomeController@certification');
$router->add('GET', '/survey', 'HomeController@survey');
$router->add('GET', '/pet', 'HomeController@pet');

$router->add('GET', '/ai-chat', 'HomeController@aiChat');
$router->add('POST', '/ai-chat', 'HomeController@aiChat');

$router->add('GET', '/progress', 'UserController@progress', ['AuthMiddleware']);
$router->add('GET', '/payment', 'UserController@payment', ['AuthMiddleware']);
$router->add('POST', '/payment', 'UserController@payment', ['AuthMiddleware']);
$router->add('GET', '/password-reset', 'AuthController@passwordReset');

$router->add('GET',  '/admin/login',          'AdminController@showLogin');
$router->add('POST', '/admin/login',          'AdminController@processLogin');
$router->add('GET',  '/admin',                'AdminController@index', ['AdminMiddleware']);
$router->add('GET',  '/admin/logout',         'AdminController@logout', ['AdminMiddleware']);
$router->add('GET',  '/admin/courses',        'CourseAdminController@index', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/add',    'CourseAdminController@add', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/delete', 'CourseAdminController@delete', ['AdminMiddleware']);
$router->add('GET',  '/admin/courses/{id}/content',  'CourseAdminController@manageContent', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/content/add',    'CourseAdminController@addContent', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/content/delete', 'CourseAdminController@deleteContent', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/question/add',    'CourseAdminController@addQuestion', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/question/delete', 'CourseAdminController@deleteQuestion', ['AdminMiddleware']);
$router->add('POST', '/admin/courses/detail/save',     'CourseAdminController@saveDetail', ['AdminMiddleware']);

$router->add('POST', '/course/mark-watched',   'CourseController@markWatched', ['AuthMiddleware']);
$router->add('GET',  '/course/exam-questions', 'CourseController@getExamQuestions', ['AuthMiddleware']);
$router->add('POST', '/course/submit-exam',    'CourseController@submitExam', ['AuthMiddleware']);
$router->add('POST', '/course/enroll',         'CourseController@enroll', ['AuthMiddleware']);
$router->add('GET',  '/course/{id}',           'CourseController@show', ['AuthMiddleware']);
$router->add('GET',  '/course-details/{slug}', 'CourseController@details');
$router->add('GET',  '/certificate',           'CourseController@certificate', ['AuthMiddleware']);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$basePath = '/public'; 
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

header("HTTP/1.1 200 OK");
$router->dispatch($uri, $method);
