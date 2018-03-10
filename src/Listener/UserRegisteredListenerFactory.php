<?php
/**
 * YAWIK
 *
 * @filesource
 * @license MIT
 * @copyright  2013 - 2018 Cross Solution <http://cross-solution.de>
 */
  
/** */
namespace Gastro24\Listener;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Factory for \Gastro24\Listener\UserRegisteredListener
 * 
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 * @todo write test  
 */
class UserRegisteredListenerFactory implements FactoryInterface
{
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var \Zend\Http\PhpEnvironment\Request $request
         * @var \Zend\Mvc\MvcEvent $event */
        $application = $container->get('Application');
        $request     = $application->getRequest();
        $type        = $request->getPost('pt');
        $router      = $container->get('router');
        $response    = $application->getResponse();
        $auth        = $container->get('AuthenticationService');

        $service     = new UserRegisteredListener($type, $router, $response, $auth);
        
        return $service;
    }
}