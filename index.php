<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once './commons/utils.php';
require_once './vendor/autoload.php';
require_once './commons/lib.php';
require_once './commons/db.php';
require_once './commons/route.php';


// use App\Controllers\DashboardController;
// use App\Controllers\AuthController;
// use App\Controllers\QuizController;
// use App\Controllers\SubjectController;
// dd($_SESSION);
$url = isset($_GET['url']) ? $_GET['url'] : "/";
definedRoute($url);
// switch ($url) {
//     case '/':
//         $ctr = new DashboardController();
//         $ctr->index();
//         break;
//     case 'form-dang-nhap':
//         $ctr = new AuthController();
//         $ctr->loginForm();
//         break;
//     case 'dang-nhap':
//         $ctr = new AuthController();
//         $ctr->login();
//         break;
//     case 'dang-xuat':
//         $ctr = new AuthController();
//         $ctr->logout();
//         break;
//     case 'dang-ky':
//         $ctr = new AuthController();
//         $ctr->registerForm();
//         break;
//     case 'tao-tai-khoan':
//         $ctr = new AuthController();
//         $ctr->createAccount();
//         break;
//     case 'dashboard':
//         $ctr = new DashboardController();
//         $ctr->index();
//         break;
//     case 'mon-hoc':
//         $ctr = new SubjectController();
//         $ctr->index();
//         break;
//     case 'mon-hoc/tao-moi':
//         $ctr = new SubjectController();
//         $ctr->addForm();
//         break;
//     case 'mon-hoc/luu-tao-moi':
//         $ctr = new SubjectController();
//         $ctr->saveAdd();
//         break;
//     case 'mon-hoc/cap-nhat':
//         $ctr = new SubjectController();
//         $ctr->editForm();
//         break;
//     case 'mon-hoc/luu-cap-nhat':
//         $ctr = new SubjectController();
//         $ctr->saveEdit();
//         break;
//     case 'mon-hoc/xoa':
//         $ctr = new SubjectController();
//         $ctr->remove();
//         break;
//     case 'mon-hoc/chi-tiet':
//         break;
//     case 'quiz':
//         $ctr = new QuizController();
//         $ctr->index();
//         break;
//     case 'quiz/tao-moi':
//         $ctr = new QuizController();
//         $ctr->addForm();
//         break;
//     case 'quiz/luu-tao-moi':
//         $ctr = new QuizController();
//         $ctr->saveAdd();
//         break;
//     case 'quiz/cap-nhat':
//         break;
//     case 'quiz/luu-cap-nhat':
//         break;
//     case 'quiz/xoa':
//         break;
//     case 'quiz/lam-bai':
//         break;
//     default:
//         echo "Đường dẫn bạn đang truy cập chưa được cho phép";
//         break;
// }
