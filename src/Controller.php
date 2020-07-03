<?php namespace CI4Xpander;

class Controller extends \CodeIgniter\Controller
{
    /**
     * @var \CI4Xpander\View $view
     */
    protected $view;

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
        if ($this->request->getPost('_action')) {
            $methodName = '_action_' . $this->request->getPost('_action');
            if (method_exists($this, $methodName)) {
                $action = $this->{$methodName}();
                if (!is_null($action)) {
                    return $action;
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
