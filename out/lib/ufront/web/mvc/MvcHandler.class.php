<?php

class ufront_web_mvc_MvcHandler implements ufront_web_IHttpHandler{
	public function __construct($requestContext) {
		if(!php_Boot::$skip_constructor) {
		if(null === $requestContext) {
			throw new HException(new thx_error_NullArgument("requestContext", _hx_anonymous(array("fileName" => "MvcHandler.hx", "lineNumber" => 16, "className" => "ufront.web.mvc.MvcHandler", "methodName" => "new"))));
		}
		$this->requestContext = $requestContext;
	}}
	public $requestContext;
	public $controllerBuilder;
	public function processRequest($httpContext, $async) {
		$controllerName = $this->requestContext->routeData->getRequired("controller");
		$factory = $this->getControllerBuilder()->getControllerFactory();
		$controller = $factory->createController($this->requestContext, $controllerName);
		if(null === $controller) {
			throw new HException(new ufront_web_error_BadRequestError(_hx_anonymous(array("fileName" => "MvcHandler.hx", "lineNumber" => 25, "className" => "ufront.web.mvc.MvcHandler", "methodName" => "processRequest"))));
		}
		try {
			$controller->execute($this->requestContext, $async);
		}catch(Exception $�e) {
			$_ex_ = ($�e instanceof HException) ? $�e->e : $�e;
			$e = $_ex_;
			{
				$factory->releaseController($controller);
				$async->error($e);
			}
		}
		$factory->releaseController($controller);
	}
	public function getControllerBuilder() {
		if(null === $this->controllerBuilder) {
			return ufront_web_mvc_ControllerBuilder::$current;
		} else {
			return $this->controllerBuilder;
		}
	}
	public function setControllerBuilder($v) {
		return $this->controllerBuilder = $v;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	static function __meta__() { $�args = func_get_args(); return call_user_func_array(self::$__meta__, $�args); }
	static $__meta__;
	function __toString() { return 'ufront.web.mvc.MvcHandler'; }
}
ufront_web_mvc_MvcHandler::$__meta__ = _hx_anonymous(array("fields" => _hx_anonymous(array("controllerBuilder" => _hx_anonymous(array("set" => new _hx_array(array("setControllerBuilder")), "get" => new _hx_array(array("getControllerBuilder"))))))));
