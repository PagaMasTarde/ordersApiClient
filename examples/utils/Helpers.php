<?php


/**
 * PLEASE SET YOUR PUBLIC KEY AND PRIVATE KEY
 */
const PUBLIC_KEY = ''; //Set your public key
const PRIVATE_KEY = ''; //Set your public key


/**
 * @return \Pagantis\OrdersApiClient\Client
 * @throws \Httpful\Exception\ConnectionErrorException
 * @throws \Pagantis\OrdersApiClient\Exception\ClientException
 */
function getOrderApiClient()
{
    $publicKey = PUBLIC_KEY;
    $privateKey = PRIVATE_KEY;
    if ($publicKey == '' || $privateKey == '') {
        throw new \Exception('You need set the public and private key in examples/utils/Helpers.php');
    }
    $orderClient = new \Pagantis\OrdersApiClient\Client($publicKey, $privateKey);
    return $orderClient;
}
/**
 * @param $message
 * @param $fileName
 * @param $withDate bool
 *
 * @return false|int
 */
function writeLog(
    $message,
    $fileName,
    $withDate
) {
    $dateFormat = '[D M j G:i:s o]';
    if ($withDate) {
        $path = dirname(__FILE__);
        $date = getCurrentDate($dateFormat);
        return file_put_contents(
            '../pagantis.log',
            $date . " " . jsonEncoded($fileName)
            . " $message.\n",
            FILE_APPEND
        );
    }
    return file_put_contents(
        '../pagantis.log',
        " " . jsonEncoded($fileName) . " $message.\n",
        FILE_APPEND
    );
}

/**
 * @param $dateFormat
 *
 * @return false|string
 */
function getCurrentDate($dateFormat)
{
    // TODO https://www.php.net/manual/en/function.date-default-timezone-set.php
    $currentDate = date($dateFormat);
    return $currentDate;
}

/**
 * @param $object
 *
 * @return false|string
 */
function jsonEncoded($object)
{
    return json_encode(
        $object,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    );
}


/**
 * @param $jsonString
 *
 * @return mixed
 */
function jsonToArray($jsonString)
{
    $myArray = json_decode($jsonString, true);
    return $myArray;
}


/**
 * @param $authorizedOrders
 *
 * @return bool
 */
function isOrderCountAboveZero($authorizedOrders)
{
    if (count($authorizedOrders) >= 1) {
        return true;
    }
    return false;
}

/**
 * @return bool
 */
function areKeysSet()
{
    if (PUBLIC_KEY == '' || PRIVATE_KEY == '') {
        return false;
    }
    return true;
}
