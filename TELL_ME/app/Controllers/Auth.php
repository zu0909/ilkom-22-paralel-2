<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to('auth/ds'); // Jika login, arahkan ke dashboard
        }

        return view('auth/login'); // Jika belum login, tampilkan halaman login
    }


    public function register()
    {
        return view('auth/register');
    }

    public function login()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Simpan data pengguna ke dalam session
            $session->set([
                'username' => $user['username'],
                'email' => $user['email'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('auth/ds');
    }

        // Hanya tampilkan flash data tanpa loop redirect
        $session->setFlashdata('error', 'Username atau password salah.');
        return view('auth/login'); // Render ulang form login tanpa redirect
    }


    public function dashboard()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
        // Redirect hanya jika pengguna belum login
         return redirect()->to('auth/login');
        }

        $data = [
            'username' => $session->get('username'),
            'email' => $session->get('email')
        ];

        return view('auth/ds', $data);
    }


    public function Profile()
    {
        // Data pengguna (dapat diganti dengan data dari database)
        return view('profile/index');
    }

    public function notif()
    {
        // Data notifikasi (contoh statis, bisa diganti dengan data dari database)
        $notifications = [
            [
                'message' => 'John Doe liked your post.',
                'time' => '2h',
            ],
            [
                'message' => 'Your profile was viewed 10 times today.',
                'time' => '5h',
            ],
            [
                'message' => 'You have a new follower: Jane Smith.',
                'time' => '1d',
            ],
        ];

        // Kirim data ke view
        return view('notifications', compact('notifications'));
    }

    public function save()
    {
        $validation = $this->validate([
            'username' => [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username is required',
                    'is_unique' => 'Username already taken'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'You must enter a valid email',
                    'is_unique' => 'Email already taken'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[12]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have at least 5 characters in length',
                    'max_length' => 'Password must not have characters more than 12 in length'
                ]
            ],
            'CPassword' => [
                'rules' => 'required|min_length[5]|max_length[12]|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password is required',
                    'min_length' => 'Confirm Password must have at least 5 characters in length',
                    'max_length' => 'Confirm Password must not have characters more than 12 in length',
                    'matches' => 'Confirm Password does not match with Password'
                ]
            ],
        ]);

        if (!$validation) {
            return view("auth/register", ['validation' => $this->validator]);
        } else {
            $username = $this->request->getPost("username");
            $email = $this->request->getPost('email');
            $password = $this->request->getPost("password");

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $values = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
            ];

            $userModel = new UserModel();
            $query = $userModel->insert($values);
            if (!$query) {
                return redirect()->back()->with('fail', 'Something went wrong');
            } else {
                return redirect()->to('auth/register')->with('success', "You are now registered successfully");
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}
