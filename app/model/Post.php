<?php

class Model_Post extends Framework_Model
{
    public function getQuantity(bool $getAll = false): int
    {
        $status = "";
        if (!$getAll) {
            $status = " WHERE status='active' ";
        }

        $statement = $this->prepare("SELECT COUNT(*) AS quantity
                                     FROM posts" . $status);

        $statement->execute();
        $row = $statement->fetch();

        return $row['quantity'];
    }

    public function getAllPaginated(int $page, bool $getAll = false)
    {
        $limit = $page * 10 - 10;
        $status = "";
        if (!$getAll) {
            $status = " WHERE status='active' ";
        }

        $statement = $this->prepare("SELECT *
                                     FROM posts
                                     JOIN users ON (posts.user_id = users.id)
                                     " . $status . "
                                     ORDER BY created_at DESC
                                     LIMIT " . $limit . ",10");

        $statement->execute();

        return $statement->fetchAll();
    }

    public function get(int $postId)
    {
        $statement = $this->prepare("SELECT *
                                     FROM posts 
                                     JOIN users ON (posts.user_id = users.id)
                                     WHERE post_id = :post_id
                                     LIMIT 1");

        $statement->bindValue(':post_id', $postId);

        $statement->execute();

        return $statement->fetch();
    }

    public function insert(array $data)
    {
        $status = "inactive";
        if ($data['isAdmin']) {
            $status = "active";
        }

        $statement = $this->prepare("INSERT INTO posts SET
                                     title = :title,
                                     user_id = :user_id,
                                     message = :message,
                                     image_name = :image_name,
                                     status = :status");

        $statement->bindValue(':title', $data['title']);
        $statement->bindValue(':user_id', $data['userId']);
        $statement->bindValue(':message', $data['message']);
        $statement->bindValue(':image_name', $data['image_name']);
        $statement->bindValue(':status', $status);

        return $statement->execute();
    }

    public function update(array $data)
    {
        $statement = $this->prepare("UPDATE posts SET
                                     title = :title,
                                     message = :message,
                                     status = :status
                                     WHERE
                                     post_id = :post_id");

        $statement->bindValue(':title', $data['title']);
        $statement->bindValue(':message', $data['message']);
        $statement->bindValue(':status', $data['status']);
        $statement->bindValue(':post_id', $data['post_id']);

        return $statement->execute();
    }

    public function delete(int $postId)
    {
        $statement = $this->prepare("DELETE FROM posts
                                     WHERE post_id = :post_id
                                     LIMIT 1");

        $statement->bindValue(':post_id', $postId);

        return $statement->execute();
    }
}