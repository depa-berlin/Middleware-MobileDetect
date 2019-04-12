<?php
namespace Depa\MiddlewareMobileDetect;


use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Detection\MobileDetect; 

class MobileDetect implements MiddlewareInterface
{
    /**
     * @var MobileDetect
     */
    private $detector;
    
    //private $attributes = array('client-isMobile'=>false,'client-isTablet'=>false,'client-isiOS'=>false,'client-isAndroidOS'=>false);
        
    public function __construct()
    {
       $this->detector = new MobileDetect();
    }
    
    /**
     * {@inheritDoc}
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
       if($this->detector->isMobile()){
           $request->withAttribute('client-isMobile', TRUE);
       }
       if($this->detector->isTablet()){
           $request->withAttribute('client-isTablet', TRUE);
       }
       if($this->detector->isiOS()){
           $request->withAttribute('client-isiOS', TRUE);
       }
       if($this->detector->isiAndroidOS()){
           $request->withAttribute('client-isAndroidOS', TRUE);
       }

        $response = $handler->handle($request);
        return $response;
        
    }

    
    
}