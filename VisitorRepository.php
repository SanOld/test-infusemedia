<?php

/**
 * Description of VisitorRepository
 *
 */
class VisitorRepository
{

    private $db;

    /**
     *
     * @param Database $database
     */
    public function __construct(\Database $database)
    {
        $this->db = $database;
    }

    /**
     *
     * @param Visitor $visitor
     * @return void
     */
    public function performInsertOn(\Visitor $visitor): void
    {
        $sql = "INSERT INTO visitors (id, ip_address, user_agent, page_url, views_count)
                    VALUES(
                        MD5(CONCAT(:ip_address, :user_agent, :page_url)),
                        INET_ATON(:ip_address),
                        :user_agent,
                        :page_url,
                        :views_count
                    )
                    ON DUPLICATE KEY UPDATE views_count=views_count+1";

        $params = [
            ':ip_address'  => $visitor->getAttribute('ip_address'),
            ':user_agent'  => $visitor->getAttribute('user_agent'),
            ':page_url'    => $visitor->getAttribute('page_url'),
            ':views_count' => $visitor->getAttribute('views_count')
        ];

        $this->db->query($sql, $params);
    }

}
