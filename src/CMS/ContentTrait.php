<?php

namespace Lefty\CMS;

/**
 * Admin page
 */

/**
 * Content trait
 *
 * @return void
 */
trait ContentTrait
{
    /**
     * Create a slug of a string, to be used as url.
     *
     * @param string $str the string to format as slug.
     *
     * @return str the formatted slug.
     */
    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(['å','ä'], 'a', $str);
        $str = str_replace('ö', 'o', $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }



    /**
     * Check if slug already exists
     *
     * @param object $params
     *
     * @return array $params
     */
    public function uniqueSlug($params) : array
    {
        $sql = "SELECT slug, id FROM content WHERE slug = ? AND id = ?;";
        $result = $this->db->executeFetch($sql, [$params["contentSlug"], $params["contentId"]]);

        if (!$result) {
            $params["contentSlug"] = $params["contentSlug"] . $params["contentId"];
        }

        return $params;
    }



    /**
     * Turn unfiltered text into filtered text
     *
     * @param array unformatted text
     *
     * @return array formatted text
     */
    public function filter($content)
    {
        $filter = new \Lefty\TextFilter\MyTextFilter();

        $filters = $content->filter;

        $filterArray = explode(",", $filters);

        $content->data = $filter->parse($content->data, $filterArray);

        return $content;
    }
}
