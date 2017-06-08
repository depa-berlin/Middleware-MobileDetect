<?php
namespace Depa\MiddlewareMobileDetect;


use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Detection\MobileDetect;



class MiddlewareMobileDetect implements MiddlewareInterface
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
     * @see \Interop\Http\ServerMiddleware\MiddlewareInterface::process()
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
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

        return $delegate->process($request);
        
    }

    
    
}