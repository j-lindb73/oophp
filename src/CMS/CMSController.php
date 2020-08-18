<?php

namespace Lefty\CMS;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class CMSController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";
 



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
    // Use to initialise member variables.
    //     $this->db = "active";
        $this->app->db->connect();

    //     // Use $this->app to access the framework services.
    }


    /**
     * This is the index method action:
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "INDEX!!:)";
    }

    /**
    * This is the debug action:
    *
    * @return string
    */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!!:)";
    }

    /**
    * This is the showall action:
    *
    * @return object
    */
    public function showallAction() : object
    {
        /**
         * Show all content.
        */
        // $app->router->get("movie", function () use ($app) {

        $db = $this->app->db;
        $page = $this->app->page;

        $title = "Blog database | oophp";

        // $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $db->executeFetchAll($sql);


        $page->add("blog/header");
        $page->add("blog/show-all", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
        // });
    }

   /**
    * This is the admin action:
    *
    * @return object
    */
    public function adminAction() : object
    {
        /**
         * Administrate content.
        */
   
        $db = $this->app->db;
        $page = $this->app->page;

        $title = "Blog database | oophp";

        // $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $db->executeFetchAll($sql);


        $page->add("blog/header");
        $page->add("blog/admin", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the create action:
    *
    * @return object
    */
    public function createActionGet() : object
    {
        /**
         * Create content.
        */

        $page = $this->app->page;

        $title = "Blog database | oophp";

        $page->add("blog/header");
        $page->add("blog/create");

        return $page->render([
            "title" => $title,
        ]);
    }

        /**
    * This is the create action:
    *
    * @return object
    */
    public function createActionPost() : object
    {
        /**
         * Create content.
        */
   
        $db = $this->app->db;
        //$page = $this->app->page;
        $request = $this->app->request;
        $response = $this->app->response;

        $title = "Blog database | oophp";
        $contentTitle = $request->getPost("contentTitle");
        $db->connect();

        $sql = "INSERT INTO content (title) VALUES (?);";
        $db->execute($sql, [$contentTitle]);
        $id = $db->lastInsertId();

        return $response->redirect("CMS/showall");
    }

    /**
    * This is the reset action:
    *
    * @return object
    */
    public function resetAction() : object
    {
        /**
         * Reset database.
        */
   
        $db = $this->app->db;
        $page = $this->app->page;

        $title = "Blog database | oophp";

        // $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $db->executeFetchAll($sql);


        $page->add("blog/header");
        $page->add("blog/reset", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    
    /**
    * This is the pages action:
    *
    * @return object
    */
    public function pagesAction() : object
    {
        /**
         * Show pages.
        */
   
        $db = $this->app->db;
        $page = $this->app->page;

        $title = "Blog database | oophp";

        // $this->app->db->connect();
        //$sql = "SELECT * FROM content;";

        $sql = <<<EOD
SELECT
*,
CASE 
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;

        $res = $db->executeFetchAll($sql, ["page"]);


        $page->add("blog/header");
        $page->add("blog/pages", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

        /**
    * This is the blog action:
    *
    * @return object
    */
    public function blogAction() : object
    {
        /**
         * Show blog.
        */
   
        $db = $this->app->db;
        $page = $this->app->page;

        $title = "Blog database | oophp";

        // $this->app->db->connect();
        //$sql = "SELECT * FROM content;";

        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type=?
        ORDER BY published DESC
        ;
        EOD;

        $res = $db->executeFetchAll($sql, ["post"]);


        $page->add("blog/header");
        $page->add("blog/blog", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the searchyear action:
    *
    * @return object
    */
    public function searchyearAction() : object
    {
        $db = $this->app->db;
        $page = $this->app->page;
        $request = $this->app->request;
    
        $title = "SELECT * WHERE year";
        // $view[] = "view/search-year.php";
        // $view[] = "view/show-all.php";
        $year1 = $request->getGet("year1");
        $year2 = $request->getGet("year2");
        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $db->executeFetchAll($sql, [$year2]);
        } else {
            $sql = "SELECT * FROM movie;";
            $resultset = $db->executeFetchAll($sql);
        }

        $page->add("movie/menu");
        $page->add("movie/searchyear", [
            "year1" => $year1,
            "year2" => $year2
        ]);
        $page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

        /**
    * This is the searchtitle action:
    *
    * @return object
    */
    public function searchtitleAction() : object
    {
        $db = $this->app->db;
        $page = $this->app->page;
        $request = $this->app->request;


        $title = "SELECT * WHERE title";
        // $view[] = "view/search-title.php";
        // $view[] = "view/show-all.php";
        $searchTitle = $request->getGet("searchTitle");
        if ($searchTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $db->executeFetchAll($sql, [$searchTitle]);
        } else {
            // $sql = "SELECT * FROM movie;";
            // $resultset = $db->executeFetchAll($sql);
            $resultset = "";
        }


        $page->add("movie/menu");
        $page->add("movie/searchtitle", [
            "searchTitle" => $searchTitle
        ]);
        $page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the select action:
    *
    * @return object
    */
    public function selectActionGet() : object
    {

        $db = $this->app->db;
        $page = $this->app->page;
    
         $title = "Select a movie";
        // $view[] = "view/movie-select.php";
        $sql = "SELECT id, title FROM movie;";
        $movies = $db->executeFetchAll($sql);
        // break;
        $page->add("movie/menu");
        $page->add("movie/select", [
            "movies" => $movies,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the select action:
    *
    * @return object
    */
    public function selectActionPost() : object
    {

        $db = $this->app->db;
        $page = $this->app->page;
        $request = $this->app->request;
        $response = $this->app->response;
    
        $movieId = $request->getPost("movieId");

        if ($request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $db->execute($sql, [$movieId]);
            // header("Location: ?route=movie-select");
            return $response->redirect("movie/select");
        } elseif ($request->getPost("doAdd")) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $db->execute($sql, ["A title", 2020, "img/noimage.png"]);
            $movieId = $db->lastInsertId();
            // header("Location: ?route=movie-edit&movieId=$movieId");
            return $response->redirect("movie/edit?movieId=" . $movieId);
        } elseif ($request->getPost("doEdit") && is_numeric($movieId)) {
            // header("Location: ?route=movie-edit&movieId=$movieId");
            return $response->redirect("movie/edit?movieId=" . $movieId);
        }

        $title = "Select a movie";
        // $view[] = "view/movie-select.php";
        $sql = "SELECT id, title FROM movie;";
        $movies = $db->executeFetchAll($sql);
        // break;

        $page->add("movie/select", [
            "movies" => $movies,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the edit action:
    *
    * @return object
    */
    public function editActionGet() : object
    {


        $db = $this->app->db;
        $page = $this->app->page;
        $request = $this->app->request;

    
        $movieId = $request->getGet("movieId");


        $title = "Redigera film";


        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $db->executeFetchAll($sql, [$movieId]);

        // var_dump($movie);
        $movie = $movie[0];

        $page->add("movie/menu");
        $page->add("movie/edit", [
            "movie" => $movie,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the edit action:
    *
    * @return object
    */
    public function editActionPost() : object
    {


        $db = $this->app->db;
        $request = $this->app->request;
        $response = $this->app->response;
    
    
        $movieId    = $request->getPost("movieId") ?: $request->getGet("movieId");
        $movieTitle = $request->getPost("movieTitle");
        $movieYear  = $request->getPost("movieYear");
        $movieImage = $request->getPost("movieImage");

        if ($request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        }
        return $response->redirect("movie/edit?movieId=" . $movieId);
    }
}
