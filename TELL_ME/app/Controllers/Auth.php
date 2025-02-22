<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\LikeModel;
use App\Models\CommentModel;

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
                'user_id'=> $user['user_id'],
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
        // Instantiate PostModel
        $postModel = new PostModel(); 
        // Ambil posts dan join dengan tabel user untuk mendapatkan username
        $posts = $postModel->select('posts.*, user.username') // Select fields from posts and username from users
            ->join('user', 'user.user_id = posts.user_id')  // Join users table on user_id
            ->findAll();
    
        // Instantiate LikeModel
        $likeModel = new LikeModel(); 
        // Hitung jumlah like untuk setiap post
        foreach ($posts as &$post) {
            $post['like_count'] = $likeModel->where('post_id', $post['post_id'])->countAllResults();
        }
    
        // Instantiate CommentModel
        $commentModel = new CommentModel();
        foreach ($posts as &$post) {
            $post['comments'] = $commentModel->getComments($post['post_id']); // Fetch comments for each post
        }

        // Add share link to each post
        foreach ($posts as &$post) {
            $post['share_link'] = base_url('post/view/' . $post['post_id']); // Assuming post_id is the unique identifier
        }
    
        // Cek jika session sudah login
        $session = session();
        if (!$session->get('isLoggedIn')) {
            // Redirect hanya jika pengguna belum login
            return redirect()->to('auth/login');
        }
    
        // Data session untuk username dan email
        $data = [
            'username' => $session->get('username'),
            'email' => $session->get('email'),
            'posts' => $posts // Pastikan posts dikirim ke view
        ];
    
        return view('auth/ds', $data);
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
        return view('notif/index', compact('notifications'));
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
