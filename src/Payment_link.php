<?php

namespace Razorpay\Api;

use Requests;


class Payment_link extends Entity
{
    /**
     * Creates Payment link .
     *
     * @param array $attributes
     *
     * @return Payment_link
     */
    public function create($attributes = array())
    {
        $additionHeader['Content-Type'] = 'application/json';

        parent::setAdditionHeader($additionHeader) ;

        return parent::create($attributes);
    }

    /**
     * Fetches Payment link entity with given id
     *
     * @param string $id
     *
     * @return Payment_link
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    /**
     * Fetches multiple Payment link with given query options
     *
     * @param array $options
     *
     * @return Collection
     */
    public function all($options = array())
    {
        return parent::all($options);
    }

    /**
     * Cancels Payment link
     *
     * @return Payment_link
     */
    public function cancel()
    {
        $url = $this->getEntityUrl() . $this->id . '/cancel';

        return $this->request(Requests::POST, $url);
    }

}
