<?php

namespace App\EventListener;

use App\Exception\ApiExceptionInterface;
use App\Http\ApiProblemResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
	public function onKernelException(ExceptionEvent $event) 
	{
		if (!$event->getThrowable() instanceof ApiExceptionInterface) {
			return;
		}

		$exception = $event->getThrowable();

		$response = new JsonResponse($this->createApiResponse($exception));
		$response->setStatusCode($exception->getCode());

		$event->setResponse($response);
	}

	private function createApiResponse(ApiExceptionInterface $exception)
	{
		$messages = json_decode($exception->getMessage());

		if(!is_array($messages)) {
			$messages = $exception->getMessage() ? [$exception->getMessage()] : [];
		}

		return new ApiProblemResponse(
			$exception->getCode(),
			Response::$statusTexts[$exception->getCode()],
			$messages
		);
	}
}