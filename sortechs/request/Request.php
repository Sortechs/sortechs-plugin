<?php
/**
 * Created by PhpStorm.
 * User: msalahat
 * Date: 20/08/17
 * Time: 05:34 م
 */
namespace Sortechs\request;
use Sortechs\Helpers\FileSortechs;

class Request
{

    protected $files;

    /**
     * Iterate over the params and pull out the file uploads.
     *
     * @param array $params
     *
     * @return array
     */
    public function sanitizeFileParams(array $params)
    {
        foreach ($params as $key => $value) {
            if ($value instanceof FileSortechs) {
                $this->addFile($key, $value);
                unset($params[$key]);
            }
        }

        return $params;
    }

    /**
     * Add a file to be uploaded.
     *
     * @param string $key
     * @param FileSortechs $file
     */
    public function addFile($key, FileSortechs $file)
    {
        $this->files[$key] = $file;
    }

    /**
     * Removes all the files from the upload queue.
     */
    public function resetFiles()
    {
        $this->files = [];
    }

    /**
     * Get the list of files to be uploaded.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Let's us know if there is a file upload with this request.
     *
     * @return boolean
     */
    public function containsFileUploads()
    {

        return !empty($this->files);
    }

}