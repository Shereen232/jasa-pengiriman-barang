<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['name'],
                'logged_in' => true
            ]);
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/auth/login')->with('error', 'Username atau password salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }

    public function Profil()
    {
        return view('auth/profile');
    }

    public function uploadProfile()
    {
        $auth = service('authentication');
        $user = $auth->user();
        $file = $this->request->getFile('file');

        $profilePath = 'images/profile';
        $userProfile = $profilePath.'/'.$user->username.'.jpg';

        if (file_exists(FCPATH . $userProfile)) unlink(FCPATH . $userProfile);

        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($profilePath, $user->username.'.jpg'); // Simpan di folder public/uploads

            // Simpan nama file ke session atau database sesuai kebutuhan
            return redirect()->to('profil')->with('success_message', 'Foto profil berhasil diperbarui!');
        } else {
            return redirect()->to('profil')->with('error_message', 'Foto profil gagal diperbarui!');;
        }
    }
}
