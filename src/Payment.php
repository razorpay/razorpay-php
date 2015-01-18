<?php

namespace Razorpay\Api;

class Payment extends Entity
{
    /**
     * @param $id Payment id
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }

    /**
     * @param $id Payment id
     */
    public function refund($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/refund';

        return $this->request('POST', $relativeUrl, $attributes);
    }

    /**
     * @param $id Payment id
     */
    public function capture($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/capture';

        return $this->request('POST', $relativeUrl, $attributes);
    }

    public function refunds()
    {
        $refund = new Refund();

        $refund['payment_id'] = $this->id;

        return $refund;
    }
}
