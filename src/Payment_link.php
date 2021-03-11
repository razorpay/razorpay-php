<?php

namespace Razorpay\Api;

use Requests;

/**
 * Invoice entity gets used for both Payment Links and Invoices system.
 * Few of the methods are only meaningful for Invoices system and calling those
 * for against/for a Payment Link would throw Bad request error.
 */
class Payment_link extends Entity
{
    /**
     * Creates invoice of any type(invoice|link|ecod).
     *
     * @param array $attributes
     *
     * @return Payment_link
     */
    public function create($attributes = array(), $contentType = 'application/x-www-form-urlencoded')
    {
        
        return parent::create($attributes,$contentType);
    }

    /**
     * Fetches invoice entity with given id
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
     * Fetches multiple invoices with given query options
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
     * Cancels issued invoice
     *
     * @return Payment_link
     */
    public function cancel()
    {
        $url = $this->getEntityUrl() . $this->id . '/cancel';

        return $this->request(Requests::POST, $url);
    }

    /**
     * Send/re-send notification for invoice by given medium
     *
     * @param $medium - sms|email
     *
     * @return array
     */
    // public function notifyBy($medium)
    // {
    //     $url = $this->getEntityUrl() . $this->id . '/notify_by/' . $medium;
    //     $r = new Request();

    //     return $r->request(Requests::POST, $url);
    // }

    // /**
    //  * Patches given invoice with new attributes
    //  *
    //  * @param array $attributes
    //  *
    //  * @return Payment_link
    //  */
    // public function edit($attributes = array())
    // {
    //     $url = $this->getEntityUrl() . $this->id;

    //     return $this->request(Requests::PATCH, $url, $attributes);
    // }

    // /**
    //  * Issues drafted invoice
    //  *
    //  * @return Payment_link
    //  */
    // public function issue()
    // {
    //     $url = $this->getEntityUrl() . $this->id . '/issue';

    //     return $this->request(Requests::POST, $url);
    // }

    // /**
    //  * Deletes drafted invoice
    //  *
    //  * @return Payment_link
    //  */
    // public function delete()
    // {
    //     $url = $this->getEntityUrl() . $this->id;
    //     $r = new Request();

    //     return $r->request(Requests::DELETE, $url);
    // }
}
