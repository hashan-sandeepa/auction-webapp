<?php
/**
 * Created by PhpStorm.
 * User: hashan
 * Date: 10/3/18
 * Time: 2:06 PM
 */

namespace App\Dto;


class ResponseDto
{
    public $hasErrors;
    public $errorList;
    public $result;

    /**
     * ResponseDto constructor.
     * @param $hasErrors
     * @param $errorList
     * @param $result
     */
    public function __construct($hasErrors, $errorList, $result)
    {
        $this->hasErrors = $hasErrors;
        $this->errorList = $errorList;
        $this->result = $result;
    }


}