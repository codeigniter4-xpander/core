<?php

namespace Xpander;

class Controller extends \CodeIgniter\Controller
{
    /**
     * @var Xpander\View
     */
    protected \Xpander\View $view;

    use ClassInitializerTrait, PropertyInitializerTrait;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->_initReflectionClass();
        $this->_initDocBlock();
        $this->_initProperty();
        $this->_init();
    }

    protected function _render($function = null)
    {
        $_action = $this->request->getPost('_action');
        if ($_action) {
            if (method_exists($this, '_action_' . $_action)) {
                $result = $this->{'_action_' . $_action}();
                if (!is_null($result)) {
                    return $result;
                }
            }
        }

        if (!is_null($function)) {
            if (is_callable($function)) {
                return $function();
            }
        }

        throw new \Exception('Cannot render');
    }
}
