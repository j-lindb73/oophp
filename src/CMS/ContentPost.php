<?php

namespace Lefty\CMS;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Lefty\CMS\ContentTrait;

/**
 * Class for content blog posts
 */
class ContentPost
{
    use ContentTrait;

    /**
    * @var $db database connection
    */
    private $db;

    /**
    * Construct content class
    *
    * @return object
    */
    public function __construct($db)
    {
        $this->db = $db;
        $this->db->connect();
    }

    /**
     * Get all blog posts from table
     *
     * @return array $resultset Array with blog posts
    */
    public function getAllPosts() : array
    {
        $sql = "
        SELECT
        *,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type=?
        ORDER BY published DESC
        ;";

        $resultset = $this->db->executeFetchAll($sql, ["post"]);
        //var_dump($resultset);
        foreach ($resultset as $res) {
            $res = $this->filter($res);
        }

        return $resultset;
    }



    /**
     * Get one post by id
     *
     * @return object $content One blog post
     */
    public function getOnePost($slug) : object
    {
        $sql = "
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE
            slug = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
        ORDER BY published DESC
        ;";

        $content = $this->db->executeFetch($sql, [$slug, "post"]);

        $content = $this->filter($content);

        return $content;
    }
}