<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Application\Http\Response;

use Slim\Http\Response;

/**
 * Class ResponseHelper
 * @package Kennynguyeenx\LibraryHexagonal\Application\Http\Response
 */
class ResponseHelper
{
    /**
     * @param Response $response
     * @param string $error
     * @param string $errorDescription
     * @param int $httpStatusCode
     * @return Response
     */
    public function responseError(
        Response $response,
        string $error,
        string $errorDescription,
        int $httpStatusCode = 500
    ): Response {
        $body = ['error' => $error, 'error_description' => $errorDescription];
        return $response->withJson($body, $httpStatusCode);
    }

    /**
     * @param Response $response
     * @param array|null $data
     * @param int $httpStatusCode
     * @return Response
     */
    public function responseSuccess(Response $response, array $data = null, int $httpStatusCode = 200): Response
    {
        return $response->withJson($data, $httpStatusCode);
    }

    /**
     * @param Response $response
     * @param array $data
     * @return Response
     */
    public function responseOk(Response $response, array $data): Response
    {
        return $this->responseSuccess($response, $data);
    }

    /**
     * @param Response $response
     * @param array $data
     * @return Response
     */
    public function responseOkWithNoCache(Response $response, array $data): Response
    {
        $response->withHeader('pragma', 'no-cache')
            ->withHeader('cache-control', 'no-store');
        return $this->responseSuccess($response, $data);
    }

    /**
     * @param Response $response
     * @param array $data
     * @return Response
     */
    public function responseOkWithResults(Response $response, array $data): Response
    {
        return $this->responseSuccess($response, ['results' => $data]);
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function responseCreated(Response $response): Response
    {
        return $response->withStatus(201);
    }

    /**
     * @param Response $response
     * @param array $data
     * @return Response
     */
    public function responseAccepted(Response $response, array $data): Response
    {
        return $this->responseSuccess($response, $data, 202);
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function responseNoContent(Response $response): Response
    {
        return $this->responseSuccess($response, null, 204);
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function responseNotModified(Response $response): Response
    {
        return $this->responseSuccess($response, null, 304);
    }

    /**
     * @param Response $response
     * @param string $error
     * @param string $errorDescription
     * @return Response
     */
    public function responseBadRequestError(
        Response $response,
        string $error,
        string $errorDescription
    ): Response {
        return $this->responseError($response, $error, $errorDescription, 400);
    }

    /**
     * @param Response $response
     * @param string $errorDescription
     * @return Response
     */
    public function responseUnauthorizedError(Response $response, string $errorDescription): Response
    {
        return $this->responseError($response, 'Unauthorized', $errorDescription, 401);
    }

    /**
     * @param Response $response
     * @param string $errorDescription
     * @return Response
     */
    public function responseForbiddenError(Response $response, string $errorDescription): Response
    {
        return $this->responseError($response, 'Forbidden', $errorDescription, 403);
    }

    /**
     * @param Response $response
     * @param string $errorDescription
     * @return Response
     */
    public function responseNotFoundError(Response $response, string $errorDescription): Response
    {
        return $this->responseError($response, 'NotFound', $errorDescription, 404);
    }

    /**
     * @param Response $response
     * @param string $errorDescription
     * @return Response
     */
    public function responseInternalServerError(Response $response, string $errorDescription): Response
    {
        return $this->responseError($response, 'InternalServerError', $errorDescription, 500);
    }

    /**
     * @param Response $response
     * @param string $errorDescription
     * @return Response
     */
    public function responseServiceUnavailableError(Response $response, string $errorDescription): Response
    {
        return $this->responseError($response, 'ServiceUnavailable', $errorDescription, 503);
    }
}
