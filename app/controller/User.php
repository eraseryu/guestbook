<?php

class Controller_User extends Framework_Controller
{
    public function login()
    {
        if (UserStorage::getInstance()->isLoggedIn()) {
            UserStorage::getInstance()->deleteCookie();
            $this->redirect()->gotoRoute('Book', 'show', [
                'success' => 'User logged out.'
            ]);
        }

        $view = $this->view()->load('User_Login');
        $model = $this->model()->load('User');

        if ($this->request()->isPost()) {

            $error = false;
            $data = $this->request()->getPosts();

            if (empty($data['username'])) {
                $error = 'Please enter user name';
            }

            if (empty($data['password'])) {
                $error = 'Please enter password';
            }

            if ($error) {
                $view->data = $data;
                $view->error = $error;
            } else {
                $userData = $model->getUser($data['username'], $data['password']);

                if (!$userData) {
                    $view->error = 'Wrong username/password!';

                } else {

                    $this->redirect()->gotoRoute('Book', 'show', [
                        'success' => 'User logged in.'
                    ]);
                }
            }
        }

        return $view->render();
    }
}