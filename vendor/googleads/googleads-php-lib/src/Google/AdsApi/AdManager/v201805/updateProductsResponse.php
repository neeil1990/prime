<?php

namespace Google\AdsApi\AdManager\v201805;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class updateProductsResponse
{

    /**
     * @var \Google\AdsApi\AdManager\v201805\Product[] $rval
     */
    protected $rval = null;

    /**
     * @param \Google\AdsApi\AdManager\v201805\Product[] $rval
     */
    public function __construct(array $rval = null)
    {
      $this->rval = $rval;
    }

    /**
     * @return \Google\AdsApi\AdManager\v201805\Product[]
     */
    public function getRval()
    {
      return $this->rval;
    }

    /**
     * @param \Google\AdsApi\AdManager\v201805\Product[]|null $rval
     * @return \Google\AdsApi\AdManager\v201805\updateProductsResponse
     */
    public function setRval(array $rval = null)
    {
      $this->rval = $rval;
      return $this;
    }

}
