<?php

/**
 * Description of Visitor
 *
 */
class Visitor
{

    private $id;
    private $ip_address;
    private $user_agent;
    private $page_url;
    private $views_count;
    private $visitor_repository;

    /**
     *
     * @param VisitorRepository $visitor_repository
     * @param array $attributes
     */
    public function __construct(VisitorRepository $visitor_repository, array $attributes = [])
    {
        $this->visitor_repository = $visitor_repository;

        if ($attributes) {
            $this->fill($attributes);
        } else {
            $this->fillNew();
        }
    }

    private function fillNew(): void
    {
        $this->ip_address = $this->getIp();
        $this->user_agent = \Request::server('HTTP_USER_AGENT');
        $this->page_url = \Request::server('HTTP_REFERER');
        $this->views_count = 1;
    }

    /**
     *
     * @param array $attributes
     * @return void
     */
    private function fill(array $attributes = []): void
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     *
     * @param string $key
     * @param type $value
     * @return void
     */
    private function setAttribute(string $key, $value): void
    {
        if (property_exists($this, $key)) {
            $this->{$key} = $value;
        }
    }

    /**
     *
     * @return string
     */
    private function getIp(): string
    {
        if (!empty(\Request::server('HTTP_CLIENT_IP'))) {
            $ip = \Request::server('HTTP_CLIENT_IP');
        } elseif (!empty(\Request::server('HTTP_X_FORWARDED_FOR'))) {
            $ip = \Request::server('HTTP_X_FORWARDED_FOR');
        } else {
            $ip = \Request::server('REMOTE_ADDR');
        }
        return $ip;
    }

    /**
     *
     * @param string $key
     * @return mixed
     * @throws LogicException
     */
    public function getAttribute(string $key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        } else {
            throw new LogicException ("Visitor has not {$key} attribute");
        }
    }

    /**
     *
     * @return bool
     */
    public function save(): bool
    {
        $this->visitor_repository->performInsertOn($this);

        return true;
    }

}
