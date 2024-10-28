<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function __construct(){
        helper(['url', 'form']);
    }
    
    public function Index()
    {
       return view ('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function save() {
        // Validasi input
        $validation = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your full name is required'
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
            // Mengambil data dari form
            $username = $this->request->getPost("username");
            $email = $this->request->getPost('email');
            $password = $this->request->getPost("password");
    
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $values = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
            ];
    
            $userModel = new \App\Models\UserModel();
            $query = $userModel->insert($values);
            if (!$query) {
                return redirect()->back()->with('fail', 'Something went wrong');
            } else {
                return redirect()->to('auth/register')->with('success', "You are now registered successfully");
            }
        }
    }
}