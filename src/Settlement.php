<?php

namespace Razorpay\Api;

/**
 * Settlement related actions can be done from here
 */
class Settlement extends Entity
{
    /**
     * fetch single settlement entity
     * @param  [int] $id [settlement id]
     * @return [Settlement]     [object of this class]
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    /**
     * get all settlements according to options
     * @param  array  $options [options for the api]
     * @return [Collection]          [having each item as Settlement obj in $Collection->items]
     */
    public function all($options = array())
    {
        return parent::all($options);
    }

    /**
     * get combined report of settlements
     * @param  array  $attributes [attributes for the api]
     * @return [array]          [having each item as an obj of this class]
     */
    public function reports($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl().'report/combined';
        return $this->request('GET', $relativeUrl, $attributes);
    }
}

