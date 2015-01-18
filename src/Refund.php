<?php

namespace Razorpay\Api;

class Refund extends Entity
{
    /**
     * @param $id Payment id
     */
    public function fetch($id)
    {
        $relativeUrl = 'payments/'.$this->payment_id.'/'.$this->getEntityUrl().$id;

        return $this->request('GET', $relativeUrl);
    }

    public function all($options = array())
    {
        $relativeUrl = 'payments/'.$this->payment_id.'/'.$this->getEntityUrl();

        return $this->request('GET', $relativeUrl, $options);
    }
}
