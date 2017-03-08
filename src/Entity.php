<?php

namespace Razorpay\Api;

use Razorpay\Api\Errors;

class Entity extends Resource implements ArrayableInterface
{
    protected $attributes = array();

    protected function create($attributes = null)
    {
        $entityUrl = $this->getEntityUrl();

        return $this->request('POST', $entityUrl, $attributes);
    }

    protected function fetch($id)
    {
        $entityUrl = $this->getEntityUrl();

        if ($id === null)
        {
            $path = explode('\\', get_class($this));
            $class = strtolower(array_pop($path));

            $message = 'The ' . $class . ' id provided is null';

            $code = Errors\ErrorCode::BAD_REQUEST_ERROR;

            throw new Errors\BadRequestError($message, $code, 500);
        }

        $relativeUrl = $entityUrl . $id;

        return $this->request('GET', $relativeUrl);
    }

    protected function all($options = array())
    {
        $entityUrl = $this->getEntityUrl();

        return $this->request('GET', $entityUrl, $options);
    }

    protected function getEntityUrl()
    {
        $fullClassName = get_class($this);
        $pos = strrpos($fullClassName, '\\');
        $className = substr($fullClassName, $pos + 1);
        $className = lcfirst($className);
        return $className.'s/';
    }

    protected function request($method, $relativeUrl, $data = null)
    {
        $request = new Request();

        $response = $request->request($method, $relativeUrl, $data);

        if ((isset($response['entity'])) and
            ($response['entity'] == $this->getEntity()))
        {
            $this->fill($response);

            return $this;
        }
        else
        {
            return static::buildEntity(null, $response);
        }
    }

    protected static function buildEntity($key, $data)
    {
        $entities = static::getDefinedEntitiesArray();

        $arrayableAttributes = static::getArrayableAttributes();

        if (in_array($key, $arrayableAttributes))
        {
            $entity = $data;
        }
        else if (isset($data['entity']))
        {
            if (in_array($data['entity'], $entities))
            {
                $class = static::getEntityClass($data['entity']);
                $entity = new $class;
            }
            else
            {
                $entity = new self;
            }

            $entity->fill($data);
        }
        else
        {
            $entity = new self;

            $entity->fill($data);            
        }

        return $entity;
    }

    protected static function getArrayableAttributes()
    {
        return array(
            'notes'
        );
    }

    protected static function getDefinedEntitiesArray()
    {
        return array(
            'collection',
            'payment',
            'refund',
            'order',
            'customer',
            'token');
    }

    protected static function getEntityClass($name)
    {
        return __NAMESPACE__.'\\'.ucfirst($name);
    }

    protected function getEntity()
    {
        $class = get_class($this);
        $pos = strrpos($class, '\\');
        $entity = strtolower(substr($class, $pos));

        return $entity;
    }

    public function fill($data)
    {
        $attributes = array();

        foreach ($data as $key => $value)
        {
            if (is_array($value))
            {
                $value = self::getArrayValue($key, $value);
            }

            $attributes[$key] = $value;
        }

        $this->attributes = $attributes;
    }

    protected static function getArrayValue($key, $value)
    {
        if  (static::isAssocArray($value) === false)
        {
            $value = self::getAssocArrayValue($key, $value);
        }
        else
        {
            $value = static::buildEntity($key, $value);
        }

        return $value;
    }

    protected static function getAssocArrayValue($key, $value)
    {
        $collection = array();

        foreach ($value as $v)
        {
            if (is_array($v))
            {
                $entity = static::buildEntity($key, $v);
                array_push($collection, $entity);
            }
            else
            {
                array_push($collection, $v);
            }
        }

        return $collection;
    }

    public static function isAssocArray($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public function toArray()
    {
        return $this->convertToArray($this->attributes);
    }

    protected function convertToArray($attributes)
    {
        $array = $attributes;

        foreach ($attributes as $key => $value)
        {
            if (is_object($value))
            {
                $array[$key] = $value->toArray();
            }
            else if (is_array($value) and self::isAssocArray($value) == false)
            {
                $array[$key] = $this->convertToArray($value);
            }
        }

        return $array;
    }
}