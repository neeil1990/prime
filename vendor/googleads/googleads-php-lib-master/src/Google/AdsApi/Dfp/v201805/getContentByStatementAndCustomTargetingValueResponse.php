<?php

namespace Google\AdsApi\Dfp\v201805;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class getContentByStatementAndCustomTargetingValueResponse
{

    /**
     * @var \Google\AdsApi\Dfp\v201805\ContentPage $rval
     */
    protected $rval = null;

    /**
     * @param \Google\AdsApi\Dfp\v201805\ContentPage $rval
     */
    public function __construct($rval = null)
    {
      $this->rval = $rval;
    }

    /**
     * @return \Google\AdsApi\Dfp\v201805\ContentPage
     */
    public function getRval()
    {
      return $this->rval;
    }

    /**
     * @param \Google\AdsApi\Dfp\v201805\ContentPage $rval
     * @return \Google\AdsApi\Dfp\v201805\getContentByStatementAndCustomTargetingValueResponse
     */
    public function setRval($rval)
    {
      $this->rval = $rval;
      return $this;
    }

}
