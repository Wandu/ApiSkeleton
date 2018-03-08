<?php
namespace App\Http\Error;

use Psr\Http\Message\ServerRequestInterface;
use Wandu\Foundation\WebApp\DefaultHttpErrorHandler;
use Wandu\Validator\Exception\InvalidValueException;
use function Wandu\Http\Response\json;

class HttpErrorHandler extends DefaultHttpErrorHandler
{
    /**
     * index is "Response Code + 01, 02 ... 99"
     * @var array
     */
    protected $exceptions = [
        // 400 Bad Request
        40001 => InvalidValueException::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request, $exception)
    {
        if ($exception instanceof InvalidValueException) {
            return json([
                "success" => false,
                "message" => $exception->getMessage(),
                "code" => array_search(InvalidValueException::class, $this->exceptions),
                "reasons" => $exception->getTypes(),
            ], 400);
        }

        $className = get_class($exception);
        if (false !== $code = array_search($className, $this->exceptions)) {
            return json([
                "success" => false,
                "message" => $exception->getMessage(),
                "code" => $code,
            ], floor($code / 100));
        }
        return parent::handle($request, $exception);
    }
}
