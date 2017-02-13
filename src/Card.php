<?php

namespace Razorpay\Api;

class Card extends Entity
{
   /**
   *  @param $id Card id description
   */

    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }
}
