<?php

namespace App\Controllers;

use App\Models\Subject;

class SubjectController
{
    public function index()
    {
        $subjects =  Subject::select('subjects.*', 'users.name as teacher_name')
            ->join('users', 'users.id', '=', 'subjects.author_id')
            ->get();
        return view('mon-hoc.index', [
            'subjects' => $subjects,
            'title' => 'Danh Sách Môn Học',
        ]);
    }

    public function addForm()
    {
        // include_once "./app/views/mon-hoc/add-form.php";
        return view('mon-hoc.add-form', [
            'title' => 'Thêm Môn Học',
        ]);
    }
    public function saveAdd()
    {
        $model = new Subject();
        $authorId = $_SESSION['auth']['id'];

        $model->fill($_POST);
        $model->author_id = $authorId;
        $model->save();
        header('location: ' . BASE_URL . 'mon-hoc');
        die;
    }

    public function editForm($id)
    {
        $model = Subject::find($id);
        if (!$model) {
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
        // dd($id);
        return view('mon-hoc.edit-form', [
            'title' => 'Sửa Tên Môn Học',
            'model' => $model,
        ]);
    }


    public function saveEdit($id)
    {
        // dd($id);
        $model = Subject::find($id);
        if (!$model) {
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        } else {
            $model->fill($_POST);
            $model->author_id = $_SESSION['auth']['id'];
            $model->save();
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
    }

    public function remove($id)
    {
        Subject::destroy($id);
        header('location: ' . BASE_URL . 'mon-hoc');
        die;
    }
}
