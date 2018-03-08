<?php
namespace App\Http\Middlewares;

use App\Domain\Contracts\Loginable;
use App\Domain\Repository\UserRepository;
use App\Http\Jwt\TokenVerifier;
use Closure;
use Exception;
use Firebase\JWT\SignatureInvalidException;
use Psr\Http\Message\ServerRequestInterface;
use Wandu\Http\Psr\Response;
use Wandu\Router\Contracts\MiddlewareInterface;
use function Wandu\Http\response;

class JwtAuth implements MiddlewareInterface
{
    /** @var \App\Http\Jwt\TokenVerifier */
    protected $tokenVerifier;
    
    /** @var \App\Domain\Repository\UserRepository */
    protected $userRepo;
    
    public function __construct(TokenVerifier $tokenVerifier, UserRepository $userRepo)
    {
        $this->tokenVerifier = $tokenVerifier;
        $this->userRepo = $userRepo;
    }

    public function __invoke(ServerRequestInterface $request, Closure $next)
    {
        $auth = $request->getHeaderLine("Authorization");
        if (!$auth) {
            return $next($request);
        }
        list($_, $jwtString) = $this->getTypeAndText($auth);
        try {
            $userData = $this->tokenVerifier->verify($jwtString);
        } catch (SignatureInvalidException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_STATUS_UNAUTHORIZED);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_STATUS_BAD_REQUEST);
        }
        
        $user = $this->userRepo->find($userData['id']);

        return $next(
            $request
                ->withAttribute('user', $user)
                ->withAttribute(Loginable::class, $user)
        );
    }

    /**
     * @param string $auth
     * @return array
     */
    protected function getTypeAndText(string $auth)
    {
        $chunk = array_map('trim', explode(" ", $auth, 2));
        return [strtolower($chunk[0]), $chunk[1] ?? ""];
    }
}
