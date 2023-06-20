<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Gallery extends ResourceController
{
    use ResponseTrait;
    public function createGallery()
    {
        $token = $this->request->getServer('HTTP_AUTHORIZATION');

        if($token)
        {
            $token = str_replace('Bearer ', '', $token);

            $cache = \Config\Services::cache();
            $userData = $cache->get('user_' . $token);

            if($userData)
            {
                $model = new GalleryModel();

                $data = [
                    'title' => $this->request->getPost('title'),
                    'type' => $this->request->getPost('type'),
                    'filename' => $this->request->getPost('filename'),
                    'caption' => $this->request->getPost('caption'),
                    'created_by' => $userData['name']
                ];

                $model->addGaleri($data);

                if ($model->affectedRows() > 0) {
                    return $this->respondDeleted(['message' => 'Success'], 200);
                } else {
                    return $this->fail('Error! Failed to delete post.', 500);
                }
            }
        }

        return $this->respond('Unauthorized', 401);
    }

    public function getGal()
    {
        $token = $this->request->getServer('HTTP_AUTHORIZATION');

        if($token)
        {
            $token = str_replace('Bearer ', '', $token);

            $cache = \Config\Services::cache();
            $userData = $cache->get('user_' . $token);

            if($userData)
            {
                $model = new GalleryModel();

                $data = $model->getGaleri();

                return $this->respond($data);
            }
        }

        return $this->respond('Unauthorized', 401);
    }
}
