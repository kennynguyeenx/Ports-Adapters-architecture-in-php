<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Application\Http\Controller\Api\V1;

use Exception;
use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Application\Http\Controller\LibraryHexagonalController;
use Kennynguyeenx\LibraryHexagonal\Application\Http\Response\ResponseHelper;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Application\UserCommandController;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\AddUserCommand;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

/**
 * Class UserController
 * @package Kennynguyeenx\LibraryHexagonal\Application\Http\Controller\Api\V1
 */
class UserController extends LibraryHexagonalController
{
    /**
     * @var UserCommandController
     */
    private $userCommandController;

    /**
     * UserCommandController constructor.
     * @param LoggerInterface $logger
     * @param ResponseHelper $responseHelper
     * @param UserCommandController $userCommandController
     */
    public function __construct(
        LoggerInterface $logger,
        ResponseHelper $responseHelper,
        UserCommandController $userCommandController
    ) {
        parent::__construct($logger, $responseHelper);
        $this->userCommandController = $userCommandController;
    }

    /**
     * @param ServerRequest $request
     * @param Response $response
     * @return Response
     */
    public function add(
        ServerRequest $request,
        Response $response
    ): Response {
        try {
            $addUserCommand = (new AddUserCommand());
            if (! empty($request->getParam('first_name'))) {
                $addUserCommand->setFirstName((string) $request->getParam('first_name'));
            } else {
                return $this->responseHelper->responseBadRequestError(
                    $response,
                    'Invalid input',
                    "Missing first_name"
                );
            }

            if (! empty($request->getParam('last_name'))) {
                $addUserCommand->setLastName((string)  $request->getParam('last_name'));
            } else {
                return $this->responseHelper->responseBadRequestError(
                    $response,
                    'Invalid input',
                    "Missing last_name"
                );
            }

            if (! empty($request->getParam('email'))) {
                $addUserCommand->setEmail((string) $request->getParam('email'));
            } else {
                return $this->responseHelper->responseBadRequestError(
                    $response,
                    'Invalid input',
                    "Missing email"
                );
            }
            $this->userCommandController->addNewUser($addUserCommand);
            return $this->responseHelper->responseCreated($response);
        } catch (InvalidArgumentException $exception) {
            return $this->responseHelper->responseBadRequestError(
                $response,
                'Invalid input',
                $exception->getMessage()
            );
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return $this->responseHelper->responseInternalServerError($response, 'Error happened');
        }
    }
}
