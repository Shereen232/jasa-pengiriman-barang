<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Myth\Auth\Password;

class UserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll(); // Langsung gunakan findAll()
        return view('user/index', $data);
    }


    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $userModel = new UserModel();

        $rules = [
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }
        
        $data = [
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password_hash' => Password::hash($this->request->getPost('password')), // Pastikan hashing benar
            'active'   => 1,
        ];

        $userModel->insert($data);

        return redirect()->to('user')->with('success_message', 'User berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $data['user'] = $this->userModel->getUserById($id);
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->asObject()->find($id);

        $rules = [
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]',
            'email' => 'required|valid_email'
        ];

        if ($user->username !== $username)  $rules['username'] = 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]';
        if ($user->email !== $email)  $rules['email'] = 'required|valid_email|is_unique[users.email]';
        if (!empty($password))  $rules['password'] = 'required|min_length[6]';

        if (!$this->validate($rules)) {
            return redirect()->to('user/edit/'.$id)->withInput()->with('validation', $this->validator->getErrors());
        }

        $arrUser = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        if (!empty($password)) {
            $arrUser['password_hash'] = Password::hash($this->request->getPost('password'));
        }

        $this->userModel->update($id, $arrUser);

        return redirect()->to('/user')->with('success_message', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user')->with('success_message', 'User berhasil dihapus.');
    }
}
