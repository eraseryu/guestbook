<?php

class Controller_Book extends Framework_Controller
{
    public function show()
    {
        $view = $this->view()->load('Book_Show');
        $model = $this->model()->load('Post');

        $isAdmin = UserStorage::getInstance()->isAdmin();
        $isLoggedIn = UserStorage::getInstance()->isLoggedIn();

        $postQuantity = $model->getQuantity($isAdmin);
        $page = $this->request()->get('page');

        $maxPage = ceil($postQuantity / 10);
        if (!is_numeric($page) || $page > $maxPage || $page < 1) {

            $page = 1;
        }

        $view->isLoggedIn = $isLoggedIn;
        $view->isAdmin = $isAdmin;
        $view->posts = $model->getAllPaginated($page, $isAdmin);
        $view->page = $page;
        $view->maxPage = $maxPage;

        if ($this->request()->get('success')) {
            $view->success = $this->request()->get('success');
        }

        if ($this->request()->get('error')) {
            $view->errorMsg = $this->request()->get('error');
        }

        return $view->render();
    }

    public function edit()
    {
        if (!UserStorage::getInstance()->isAdmin()) {
            $this->redirect()->gotoRoute('Book', 'show', [
                'error' => 'No permissions!'
            ]);
        }
        $postId = $this->request()->get('id');
        $view = $this->view()->load('Book_Edit');

        $postModel = $this->model()->load('Post');

        $post = $postModel->get($postId);

        $view->post = $post;

        if ($this->request()->isPost()) {
            $error = false;
            $data = $this->request()->getPosts();

            if (empty($data['title'])) {
                $error = 'Please enter title.';
            }

            if ($error) {
                $view->data = $data;
                $view->error = $error;
            } else {

                if (empty($data['status'])) {
                    $data['status'] = 'inactive';
                }

                $postModel->update($data);

                $this->redirect()->gotoRoute('Book', 'show', [
                    'success' => 'Post updated!'
                ]);
            }
        }

        return $view->render();
    }

    public function add()
    {
        $view = $this->view()->load('Book_Add');
        if (!UserStorage::getInstance()->isLoggedIn()) {
            $this->redirect()->gotoRoute('Book', 'show', [
                'error' => 'No permissions!'
            ]);
        }
        $model = $this->model()->load('Post');

        if ($this->request()->isPost()) {

            $error = false;
            $data = $this->request()->getPosts();

            if (empty($data['title'])) {
                $error = 'Please enter title.';
            }

            if ($error) {
                $view->data = $data;
                $view->error = $error;
            } else {

                $data['isAdmin'] = UserStorage::getInstance()->isAdmin();
                $data['userId'] = UserStorage::getInstance()->getUserId();

                $uploader = new Uploader();
                $uploader->setDir(UPLOAD_PATH);
                $uploader->setExtensions(UPLOAD_FORMATS);
                $uploader->setMaxSize(MAX_UPLOAD_SIZE);

                $uploadMsg = '';
                $data['image_name'] = '';
                if ($uploader->uploadFile('name')) {
                    $data['image_name'] = $uploader->getUploadName();
                } else {
                    $uploadMsg = 'Errors during upload: ' . $uploader->getMessage();
                }

                $model->insert($data);

                $this->redirect()->gotoRoute('Book', 'show', [
                    'success' => 'Post added! ' . $uploadMsg
                ]);
            }
        }

        return $view->render();
    }

    public function delete()
    {
        if (!UserStorage::getInstance()->isAdmin()) {
            $this->redirect()->gotoRoute('Book', 'show', [
                'error' => 'No permissions!'
            ]);
        }
        $postId = $this->request()->get('id');
        $model = $this->model()->load('Post');

        $msgInfo = ['error' => 'Error deleting post!'];
        if ($model->delete($postId)) {
            $msgInfo = ['success' => 'Post deleted!'];
        }

        $this->redirect()->gotoRoute('Book', 'show', $msgInfo);
    }
}