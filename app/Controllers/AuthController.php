<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class AuthController extends BaseController
{

    use ResponseTrait;

    public function login()
    {
        if ($this->request->is('post')) {
            $user = new UserModel();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $data = $user->where('email', $email)->first();
       
            if(is_null($data)) {
                return $this->respond(['error' => 'Invalid username or password.'], 401);
            }
            
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
    
            if(!$verify_pass) {
                return $this->respond(['error' => 'Invalid username or password.'], 401);
            }
            
            $privateKey = file_get_contents(WRITEPATH . '/jwt.key');
         
            $payload = [
                'iss' => 'myapp',
                'sub' => $data->id,
                'exp' => time() + 60,
            ];
            $json = [
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
            ];
            return $this->respond($json, 200);
        } 
    }
}
