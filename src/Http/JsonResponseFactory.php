<?php
/**
 * This file is part of DBCSoft Standard Package
 *
 * (c) Ty Huynh <hongty.huynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MicroPhpLibs\MicroSupports\Http;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JsonResponseFactory
{
    protected $error = 0;
    protected $message = '';
    protected $data = [];
    protected $meta = [];
    protected $status = true;
    protected $created = false;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function buildResponse()
    {
        return [
            'error' => $this->error,
            'message' => $this->message,
            'result' => $this->data,
            'meta' => $this->meta,
            'status' => $this->status,
            'created' => $this->created
        ];
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function setResponseData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setResponseMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public function response($httpCode = Response::HTTP_OK)
    {
        return response()->json($this->buildResponse(), $httpCode);
    }
}
