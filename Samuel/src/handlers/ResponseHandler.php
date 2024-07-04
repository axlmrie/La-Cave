<?php


namespace src\handlers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseHandler
{

    public static function Response(RequestInterface $request, ResponseInterface $response, array $datas)
    {
        $response->getBody()->write(json_encode(
            [
                'status' => 'success',
                'datas' => $datas
            ]
            , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        ));
        return $response;
    }
}
