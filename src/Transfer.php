<?php
namespace Razorpay\Api;

class Transfer extends Entity
{
    /**
     *  @param $id  Transfer ID
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        if (isset($this->payment_id) === true)
        {
            $relativeUrl = 'payments/' . $this->payment_id. '/transfers';

            return $this->request('GET', $relativeUrl, $options);
        }

        return parent::all($options);
    }

    public function create($attributes = array())
    {
        return parent::create($attributes);
    }

    public function edit($attributes = null)
    {
        $entityUrl = $this->getEntityUrl() .  $this->id;

        return $this->request('PATCH', $entityUrl, $attributes);
    }

    public function reverse($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/reversal';

        return $this->request('POST', $relativeUrl, $attributes);
    }
}
