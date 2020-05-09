<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    use Helpers;

    protected $statusCode = Response::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     *
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $resource
     *
     * @return mixed
     */
    public function respondWithSuccess($resource = [])
    {
        return $this->respond($resource);
    }

    /**
     * @return mixed
     */
    public function respondNoContent()
    {
        return $this->setStatusCode(Response::HTTP_NO_CONTENT)->respondWithSuccess();
    }
}
