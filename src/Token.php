<?php

namespace Razorpay\Api;

class Token extends Entity
{
    /**
     * @param $id Token id
     */
    public function fetch($options = array())
    {
        $relativeUrl = 'customers/'.$options['customer_id'].'/'.$this->getEntityUrl().$options['token_id'];

        return $this->request('GET', $relativeUrl);
    }

    public function all($options = array())
    {
        $relativeUrl = 'customers/'.$options['customer_id'].'/'.$this->getEntityUrl();

        return $this->request('GET', $relativeUrl, $options);
    }

    public function delete($options = array())
    {
        $relativeUrl = 'customers/'.$options['customer_id'].'/'.$this->getEntityUrl().$options['token_id'];

        return $this->request('DELETE', $relativeUrl);
    }
}
