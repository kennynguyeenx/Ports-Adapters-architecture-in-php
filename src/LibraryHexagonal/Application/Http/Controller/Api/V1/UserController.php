<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\User\Application;

use Exception;
use InvalidArgumentException;
use Kennynguyeenx\LibraryHexagonal\Application\Http\Controller\LibraryHexagonalController;
use Kennynguyeenx\LibraryHexagonal\Application\Http\Response\ResponseHelper;
use Kennynguyeenx\LibraryHexagonal\Domain\User\Core\Model\AddUserCommand;
use Psr\Log\LoggerInterface;
use Slim\Http\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Kennynguyeenx\LibraryHexagonal\Domain\User\Application
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
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function add(
        Request $request,
        Response $response
    ): Response {
        try {
            $addUserCommand = (new AddUserCommand());
            if (! empty($request->get('first_name'))) {
                $addUserCommand->setFirstName((string) $request->get('first_name'));
            }

            if (! empty($request->get('last_name'))) {
                $addUserCommand->setLastName((string)  $request->get('last_name'));
            }

            if (! empty($request->get('email'))) {
                $addUserCommand->setEmail((string) $request->get('email'));
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
