<?php
namespace Segura\AppCore\Router;

use Slim\App;

class Route
{
    protected $name;
    protected $callback;
    protected $SDKClass;
    protected $SDKFunction;
    protected $SDKTemplate = "callback";
    protected $routerPattern;
    protected $httpEndpoint;
    protected $httpMethod = "GET";
    protected $singular;
    protected $plural;
    protected $properties;
    protected $exampleEntity;
    protected $callbackProperties = [];

    public static function Factory()
    {
        return new Route();
    }

    /**
     * @return array
     */
    public function getCallbackProperties(): array
    {
        return $this->callbackProperties;
    }

    /**
     * @param array $callbackProperties
     *
     * @return Route
     */
    public function setCallbackProperties(array $callbackProperties): Route
    {
        $this->callbackProperties = $callbackProperties;
        return $this;
    }

    /**
     * @param $name
     * @param bool $mandatory
     * @param null $default
     *
     * @return $this
     */
    public function addCallbackProperty($name, $mandatory = false, $default = null)
    {
        $this->callbackProperties[$name] = [
            'name'        => $name,
            'isMandatory' => $mandatory,
            'default'     => $default,
        ];
        return $this;
    }

    /**
     * @return string
     */
    public function getSDKTemplate(): string
    {
        return $this->SDKTemplate;
    }

    /**
     * @param string $SDKTemplate
     *
     * @return Route
     */
    public function setSDKTemplate(string $SDKTemplate): Route
    {
        $this->SDKTemplate = $SDKTemplate;
        return $this;
    }

    public function getUniqueIdentifier()
    {
        return implode(
            "::",
            [
                $this->getHttpMethod(),
                $this->getRouterPattern()
            ]
        );
    }

    /**
     * @return mixed
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param mixed $httpMethod
     *
     * @return Route
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouterPattern()
    {
        return $this->routerPattern;
    }

    /**
     * @param mixed $routerPattern
     *
     * @return Route
     */
    public function setRouterPattern($routerPattern)
    {
        $this->routerPattern = $routerPattern;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExampleEntity()
    {
        return $this->exampleEntity;
    }

    /**
     * @param mixed $exampleEntity
     *
     * @return Route
     */
    public function setExampleEntity($exampleEntity)
    {
        $this->exampleEntity = $exampleEntity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Route
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSDKClass()
    {
        return $this->SDKClass;
    }

    /**
     * @param mixed $SDKClass
     *
     * @return Route
     */
    public function setSDKClass($SDKClass)
    {
        $this->SDKClass = $SDKClass;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSDKFunction()
    {
        return $this->SDKFunction;
    }

    /**
     * @param mixed $function
     *
     * @return Route
     */
    public function setSDKFunction($function)
    {
        $this->SDKFunction = $function;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSingular()
    {
        return $this->singular;
    }

    /**
     * @param mixed $singular
     *
     * @return Route
     */
    public function setSingular($singular)
    {
        $this->singular = $singular;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlural()
    {
        return $this->plural;
    }

    /**
     * @param mixed $plural
     *
     * @return Route
     */
    public function setPlural($plural)
    {
        $this->plural = $plural;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param mixed $properties
     *
     * @return Route
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @param App $app
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function populateRoute(App $app)
    {
        return $app->map(
            [$this->getHttpMethod()],
            $this->getRouterPattern(),
            $this->getCallback()
        );
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param mixed $callback
     *
     * @return Route
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHttpEndpoint()
    {
        return $this->httpEndpoint;
    }

    /**
     * @param mixed $httpEndpoint
     *
     * @return Route
     */
    public function setHttpEndpoint($httpEndpoint)
    {
        $this->httpEndpoint = $httpEndpoint;
        return $this;
    }
}