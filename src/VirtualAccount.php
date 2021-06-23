<?php

namespace Razorpay\Api;

class VirtualAccount extends Entity
{
    public function create($attributes = array())
    {
        return parent::create($attributes);
    }

    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }

    public function close()
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/close';


        return $this->request('POST', $relativeUrl);
    }

    public function payments()
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/payments';

        return $this->request('GET', $relativeUrl);
    }
}