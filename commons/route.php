<?php

// namespace App\Helpers;

use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\SubjectController;
use App\Controllers\AuthController;
use App\Controllers\QuizController;
use \Phroute\Phroute\RouteCollector;


function definedRoute($url)
{
    $router = new RouteCollector();

    // illuminate/database
    // illuminate/events
    // jenssegers/blade
    try {

        $router->get("/", [DashboardController::class, 'index']);

        //dang ki filter
        $router->filter('auth', function () {
            if (!isset($_SESSION['auth']) && empty($_SESSION['auth'])) {
                header("location: " . BASE_URL . 'dang-nhap');
                die;
            };
        });
        $router->filter('authTeacher', function () {
            if ($_SESSION['auth']['role_id'] !== 1 || !isset($_SESSION['auth'])) {
                header("location: " . BASE_URL . '');
                die;
            }
        });

        $router->get("dashboard", [DashboardController::class, 'index']);
        //auth
        $router->get('dang-nhap', [AuthController::class, 'loginForm']);
        $router->post('dang-nhap', [AuthController::class, 'login']);
        $router->get('dang-xuat', [AuthController::class, 'logout']);
        $router->get('dang-ky', [AuthController::class, 'registerForm']);
        $router->post('dang-ky', [AuthController::class, 'createAccount']);

        //subject
        $router->group(['prefix' => 'mon-hoc', 'before' => 'authTeacher'], function ($router) {
            $router->get('/', [SubjectController::class, 'index'],);
            $router->get('/tao-moi', [SubjectController::class, 'addForm'],);
            $router->post('/tao-moi', [SubjectController::class, 'saveAdd'],);
            $router->get('/cap-nhat/{id:i}', [SubjectController::class, 'editForm'],);
            $router->post('/cap-nhat/{id:i}', [SubjectController::class, 'saveEdit'],);
            $router->get('/xoa/{id:i}', [SubjectController::class, 'remove'],);
        });

        //quiz
        $router->group(['prefix' => 'quiz', 'before' => 'authTeacher'], function ($router) {
            $router->get('/', [QuizController::class, 'index']);
            $router->get('/tao-moi', [QuizController::class, 'addForm']);
            $router->post('/tao-moi', [QuizController::class, 'saveAdd'],);
            $router->get('/cap-nhat/{id:i}', [QuizController::class, 'editForm'],);
            $router->post('/cap-nhat/{id:i}', [QuizController::class, 'saveEdit']);
            $router->get('/xoa/{id:i}', [QuizController::class, 'remove'],);
            $router->get('/danh-sach-quiz/{id:i}', [QuizController::class, 'quizList']);
            $router->post('/tao-cau-hoi/{id:i}', [QuizController::class, 'addQuestion']);
            $router->get('/chi-tiet/{id:i}', [QuizController::class, 'quizDetail']);
            $router->group(['prefix' => 'cau-hoi'], function ($router) {
                $router->post('/cap-nhat/{id:i}', [QuizController::class, 'saveEditQuestion']);
                $router->get('/xoa/{id:i}', [QuizController::class, 'removeQuestion']);
            });
        });

        //Sv làm quiz
        $router->group(['prefix' => 'sv', 'before' => 'auth'], function ($router) {
            $router->get('/mon-hoc', [QuizController::class, 'studentListSub']);
            $router->get('/quiz/{id:i}', [QuizController::class, 'studentListQues']);
            $router->get('/lam-quiz/{id:i}', [QuizController::class, 'takeQuiz']);
            $router->post('/lam-quiz/{id:i}', [QuizController::class, 'results']);
            $router->get('/lam-quiz/ket-qua/{id:i}', [QuizController::class, 'showResults']);
        });

        # NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
        $dispatcher = new \Phroute\Phroute\Dispatcher($router->getData());
        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));

        // Print out the value returned from the dispatched function
        echo $response;
    } catch (\Throwable $th) {
        throw $th;
        // header('location:' . BASE_URL . 'app/views/404.php');
    }
}
