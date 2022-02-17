<?php

/**
 * Only to demonstrate the need for preliminary preparation of data before use
 */
class Request
{
    /**
     *
     * @param string $var
     * @param int $filter
     * @param array|int $options
     * @return mixed
     */
    public static function get(string $var, int $filter = FILTER_DEFAULT, $options = 0)
    {
        return filter_input(INPUT_GET, $var, $filter, $options);
    }

    /**
     *
     * @param string $var
     * @param int $filter
     * @param array|int $options
     * @return mixed
     */
    public static function post(string $var, int $filter = FILTER_DEFAULT, $options = 0)
    {
        return filter_input(INPUT_POST, $var, $filter, $options);
    }

    /**
     *
     * @param string $var
     * @param int $filter
     * @param array|int $options
     * @return mixed
     */
    public static function server(string $var, int $filter = FILTER_DEFAULT, $options = 0)
    {
        return filter_input(INPUT_SERVER, $var, $filter, $options);
    }

}
