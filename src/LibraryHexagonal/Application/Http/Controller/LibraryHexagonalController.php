<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Application\Http\Controller;

use Kennynguyeenx\LibraryHexagonal\Application\Http\Response\ResponseHelper;
use Psr\Log\LoggerInterface;

/**
 * Class LibraryHexagonalController
 * @package Kennynguyeenx\LibraryHexagonal\Application\Http\Controller
 */
class LibraryHexagonalController
{
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var ResponseHelper
     */
    protected $responseHelper;

    /**
     * LibraryHexagonalController constructor.
     * @param LoggerInterface $logger
     * @param ResponseHelper $responseHelper
     */
    public function __construct(LoggerInterface $logger, ResponseHelper $responseHelper)
    {
        $this->logger = $logger;
        $this->responseHelper = $responseHelper;
    }
}
