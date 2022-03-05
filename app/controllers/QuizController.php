<?php


namespace App\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use App\Models\StudentQuizDetail;
use App\Models\Subject;
// use Redirect;

class QuizController
{
    public function index()
    {
        // $quizs = Quiz::rawQuery('Select q.*, subjects.name subName FROM quizs q JOIN subjects ON q.subject_id = subjects.id;')
        //     ->get();
        $quizs = Quiz::select('quizs.*', 'subjects.name as sub_name')
            ->join('subjects', 'quizs.subject_id', '=', 'subjects.id')
            ->orderBy('id')
            ->get();
        // dd($quizs);
        return view('quiz.index', [
            'title' => 'Danh sách quiz',
            'quizs' => $quizs,
            'h4' => 'Tạo câu hỏi',
        ]);
    }
    public function addForm()
    {
        $subjects = Subject::all();

        return view('quiz.add-form', [
            'title' => 'Thêm quiz',
            'subjects' => $subjects,
        ]);
    }
    public function saveAdd()
    {
        $model = new Quiz();
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        $model->fill($_POST);
        $model->start_time = date("Y-m-d H:i:s", strtotime($start_time));
        $model->end_time = date("Y-m-d H:i:s", strtotime($end_time));
        // dd($model);
        $model->save();
        header('location: ' . BASE_URL . 'quiz');
        die;
    }
    public function editForm($id)
    {
        // $id = $_GET['id'];
        $subjects = Subject::all();
        $quiz = Quiz::find($id);
        if (!$quiz) {
            header('location: ' . BASE_URL . 'quiz');
            die;
        }

        return view('quiz.edit-form', [
            'title' => 'Sửa quiz',
            'subjects' => $subjects,
            'quizs' => $quiz,
        ]);
    }
    public function saveEdit($id)
    {
        $quiz = Quiz::find($id);
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        $quiz->fill($_POST);
        $quiz->start_time = date("Y-m-d H:i:s", strtotime($start_time));
        $quiz->end_time = date("Y-m-d H:i:s", strtotime($end_time));
        $quiz->is_shuffle = (isset($_POST['is_shuffle'])) ? 1 : 0;
        // dd($quiz);
        $quiz->save();
        header("location: " . BASE_URL . 'quiz');
        die;
    }
    public function remove($id)
    {
        $questions = Question::where('quiz_id', $id)->get();
        foreach ($questions as $q) {
            $answers = Answer::where('question_id', $q->id)->get();
            foreach ($answers as $ans) {
                Answer::destroy($ans->id);
            }
            Question::destroy($q->id);
        }
        Quiz::destroy($id);
        header('location: ' . BASE_URL . 'quiz');
        die;
    }

    public function quizList($id)
    {
        $subject = Subject::find($id);

        $quizs = Quiz::where('subject_id', $id)->get();
        return view('quiz.list-quiz-by-sub', [
            'title' => 'Danh sách quiz',
            'h4' => 'Tạo câu hỏi',
            'quizs' => $quizs,
            'name_sub' => $subject->name,
        ]);
    }

    //Question
    public function addQuestion($id)
    {
        //add Question
        $question = new Question();
        $question->fill($_POST);
        $question->save();

        $idQuestion = Question::max('id');
        //add Answer

        $answers = $_POST['answer'];
        $is_corrects = $_POST['is_correct'];
        $i = 0;
        foreach ($answers as $answer) {
            $model = new Answer();
            $model->content = $answer;
            // var_dump($answer);
            $model->question_id = $idQuestion;
            $model->is_correct = isset($is_corrects[$i]) ? 1 : 0;
            $i++;
            $model->save();
        }
        header("location: " . BASE_URL . 'quiz');
        die;
    }
    public function quizDetail($id)
    {
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id', $id)
            ->get();
        return view('quiz.quiz-detail', [
            'h4' => 'Sửa câu hỏi',
            'quiz_id' => $id,
            'title' => $quiz->name,
            'questions' => $questions,
        ]);
    }


    public function saveEditQuestion($id)
    {
        $question = Question::find($id);
        $question->fill($_POST);
        $question->save();

        $getAnsw = $_POST['answer'];
        $is_corrects = $_POST['is_correct'];
        $i = 0;
        $answers = Answer::where('question_id', $id)->get();
        // dd($answers);
        foreach ($answers as $answer) {
            // var_dump($answer->content);
            $answer->content = $getAnsw[$i];
            $answer->is_correct = isset($is_corrects[$i]) ? 1 : 0;
            $i++;
            $answer->save();
        }
        header('location: ' . BASE_URL . "quiz/chi-tiet/" . $_POST['quiz_id']);
        die;
    }
    public function removeQuestion($id)
    {
        $answers = Answer::where('question_id', $id)->get();
        foreach ($answers as $a) {
            Answer::destroy($a->id);
        }
        Question::destroy($id);
        header('location: ' . BASE_URL . 'quiz');
        die;
    }
    public function studentListSub()
    {

        $subjects = Subject::all();
        return view('quiz.sv-list-subject', [
            'title' => "Danh sách môn học",
            'subjects' => $subjects
        ]);
    }
    public function studentListQues($id)
    {

        $subject = Subject::find($id);
        $quizs = Quiz::where('subject_id', $id)->get();
        // dd($quizs);
        return view('quiz.sv-list-quiz', [
            'title' => "Danh sách quiz $subject->name",
            'quizs' => $quizs,
            // 'subjectName' => $subject->name,
        ]);
    }
    public function takeQuiz($id)
    {
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id', $id)->get();
        $start_time = date("d-m-Y H:i:s");

        $subName =  $quiz->subjectName();
        return view('quiz.sv-take-quiz', [
            'title' => "Làm quiz",
            'start_time' => $start_time,
            'subName' => $subName,
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }
    public function results($id)
    {
        $asnwerCorrect = 0;
        $countAsnwer = 0;
        $stdQuiz = new StudentQuiz;
        $stdQuiz->student_id = $_SESSION['auth']['id'];
        $stdQuiz->quiz_id = $id;
        $stdQuiz->start_time = date("Y-m-d H:i:s", strtotime($_POST['start_time']));

        $stdQuiz->end_time = date("Y-m-d H:i:s");
        $stdQuiz->quiz_id = $id;
        $stdQuiz->save();
        // dd($_POST);
        $selectedAnswers = $_POST;
        foreach ($selectedAnswers as $question  => $ans) {
            if ($question !== "start_time") {
                $questionId = ltrim($question, 'question_');
                $stQuizDetail = new StudentQuizDetail();
                $stQuizDetail->student_quiz_id = $stdQuiz->id;
                $stQuizDetail->question_id = $questionId;
                $stQuizDetail->answer_id = $ans;
                $stQuizDetail->quiz_id = $id;
                $stQuizDetail->save();
                $asnwer = Answer::find($ans);
                if ($asnwer->is_correct == 1) {
                    $asnwerCorrect++;
                }
                $countAsnwer++;
                // $_SESSION['coutAsnwerCorrect'] = $score;
            }
        }
        $stdQuiz->count_asnwer = $countAsnwer;
        $stdQuiz->count_asnwer_correct = $asnwerCorrect;
        $stdQuiz->score = round($asnwerCorrect * 10 / (count($selectedAnswers) - 1), 2);
        $stdQuiz->save();

        header('location: ' . BASE_URL . "sv/lam-quiz/ket-qua/$id");
    }
    public function showResults($id)
    {
        $quiz = Quiz::find($id);
        $subjectName = $quiz->subjectName();
        $resultStudentQuizs = StudentQuiz::where('quiz_id', $id)
            ->where('student_id', $_SESSION['auth']['id'])
            ->get();
        // $nameQuiz = $resultStudentQuizs->nameQuiz();

        return view('quiz.sv-show-results', [
            'title' => 'Chi tiết bài làm',
            'resultStudentQuizs' => $resultStudentQuizs,
            'subjectName' => $subjectName,
        ]);
    }
}
