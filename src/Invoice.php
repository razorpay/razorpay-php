<?php
namespace Razorpay\Api;

class Invoice extends Entity
{
    /**
     *  @param $id invoice
     */
    public function fetch($id = '')
    {
        return parent::fetch($id);
    }

    public function create($attributes = array())
    {
        return parent::create($attributes);
    }    
}
