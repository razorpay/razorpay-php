<?php

namespace Razorpay\Api;

class Invoice extends Entity
{
    /**
     * @param $id Invoice id
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function create($attributes = array())
    {
        return parent::create($attributes);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }
}
