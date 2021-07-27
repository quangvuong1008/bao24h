<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\Json;
use CodeIgniter\HTTP\Files\UploadedFile;

class Media extends BaseController
{
    protected $path = '/uploads/contents';

    public function carousel()
    {
        $files = $this->uploadMultiple();

        return $this->response->setJSON($files);
    }

    /**
     * @return null|string
     */
    public function upload()
    {
        if (($file = $this->request->getFile('image')) === null || $file->getError() || !$file->isValid()) {
            return null;
        }

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . $this->path;

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $this->response->setJSON(['link' => $this->path . '/' . $fileName]);
        }

        return null;
    }

    /**
     * Upload Gallery
     *
     * @return array
     */
    protected function uploadMultiple()
    {
        $files = $this->request->getFiles();

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/contents';

        $images = [];
        /** @var UploadedFile[] $gallery */
        if ($files && ($gallery = ArrayHelper::getValue($files, '_gallery')) !== null) {
            foreach ($gallery as $file) {
                if ($file->getError() || !$file->isValid()) continue;

                $fileName = $file->getFileNameStore();

                if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
                    $images[] = [
                        'image' => $fileName,
                        'ext' => $file->getExtension(),
                        'src' => $this->path . '/' . $fileName
                    ];
                }

            }
        }

        return $images;
    }
}