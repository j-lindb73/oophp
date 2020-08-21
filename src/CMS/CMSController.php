<?php

namespace Lefty\CMS;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Lefty\CMS\DBResetTrait;

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
    use DBResetTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";
    private $content;
    private $contentpage;
    private $contentpost;


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
        $this->content = new Content($this->app->db);
        $this->contentpage = new ContentPage($this->app->db);
        $this->contentpost = new ContentPost($this->app->db);

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
        //return "INDEX!!:)";
        $response = $this->app->response;
        return $response->redirect("CMS/showall");
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
 
        $page = $this->app->page;

        $title = "Blog database | oophp";

        $res = $this->content->getAllContent();

        $page->add("cms/header");
        $page->add("cms/admin", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
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

        $page = $this->app->page;

        $title = "Show all | Content database";

        $content = $this->content->getAllContent();

        $page->add("cms/header");
        $page->add("cms/show-all", [
            "resultset" => $content,
        ]);

        return $page->render([
            "title" => $title,
        ]);
        // });
    }

    /**
    * This is the create GET action:
    *
    * @return object
    */
    public function createActionGet() : object
    {
        /**
         * Create content.
        */

        $page = $this->app->page;

        $title = "Create | Content database";

        $page->add("cms/header");
        $page->add("cms/create");

        return $page->render([
            "title" => $title,
        ]);
    }

        /**
    * This is the create POST action:
    *
    * @return object
    */
    public function createActionPost() : object
    {
        /**
         * Create content.
        */
   
        if (hasKeyPost("doCreate")) {
            $title = getPost("contentTitle");

            $id = $this->content->createContent($title);

            return $this->app->response->redirect("CMS/edit?contentId=$id");
        }
    }

    /**
    * This is the edit GET-action:
    *
    * @return object
    */
    public function editActionGet() : object
    {

        $page = $this->app->page;
        $request = $this->app->request;

        $contentId = $request->getGet("contentId");

        $title = "Edit content | Content database";

        $content = $this->content->getContent($contentId);

        $page->add("cms/header");
        $page->add("cms/edit", [
            "content" => $content,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the edit POST-action:
    *
    * @return void
    */
    public function editActionPost()
    {
        $request = $this->app->request;

        $contentId = $request->getPost("contentId");

        if (!is_numeric($contentId)) {
           die("Not valid for content id.");
        }

        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("CMS/delete?contentId=$contentId");
        } elseif (hasKeyPost("doSave")) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId"
            ]);

            $this->content->saveContent($params);

            return $this->app->response->redirect("CMS/admin");
        } else {
            return $this->app->response->redirect("CMS/edit?id = $contentId");
        }
    }

    /**
    * This is the delete GET-action:
    *
    * @return object
    */
    public function deleteActionGet() : object
    {

        $page = $this->app->page;
        $request = $this->app->request;
    
        $contentId = $request->getGet("contentId");

        $title = "Delete content | Content database";

        $content = $this->content->getContent($contentId);

        $page->add("cms/header");
        $page->add("cms/delete", [
            "content" => $content,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
    * This is the delete  POST-action:
    *
    * @return object
    */
    public function deleteActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
    
        $contentId = $request->getPost("contentId");
        
        $this->content->deleteContent($contentId);

        return $response->redirect("CMS/admin");
    }

    /**
     *
     * Reset database
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $page = $this->app->page;
        $title = "Reset database";

        $title = "Reset database | Content database";

        $page->add("cms/header");
        $page->add("cms/reset");

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/reset
     *
     * @return object
     *
     */
    public function resetActionPost(): object
    {
        // Restore the database to its original settings

        $doReset = getPost("reset");

        if ($doReset) {
            $filename = "/sql/content/setup.sql";
            $this->reset($filename);
            $this->app->response->redirect("CMS/admin");
        }

    }

    /**
     * All pages
     *
     * @return object
     */
    public function pagesActionGet() : object
    {
        $title = "Pages in content | Content database";
        $page = $this->app->page;

        $resultset = $this->contentpage->getAllPages();

        $data = [
            "resultset" => $resultset
        ];

        $page->add("cms/header");
        $page->add("cms/pages", $data);

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * One page
     *
     * @return object
     */
    public function pageActionGet() : object
    {
        $path = getGet("path");
        $page = $this->app->page;

        $content = $this->contentpage->getOnePage($path);
  

        if (!$content) {
            return $this->app->response->redirect("cms/pageNotFound");
        }

        $title = $content->title;
        $data = [
            "content" => $content
        ];

        $page->add("cms/header");
        $page->add("cms/page", $data);

        return $page->render([
            "title" => $title
        ]);
    }

        /**
     * All blogposts
     *
     * @return object
     */
    public function blogActionGet() : object
    {
        $title = "All blogposts | Content database";
        $page = $this->app->page;
  
        $resultset = $this->contentpost->getAllPosts();
        //var_dump($resultset);
        $data = [
            "resultset" => $resultset
        ];

        $page->add("cms/header");
        $page->add("cms/blog", $data);

        return $page->render([
            "title" => $title
        ]);
    }

    /**
    * Get Blogpost
    *
    * @return object
    */
    public function blogpostActionGet() : object
    {
        $title = "Alla sidor";
        $page = $this->app->page;
        $request = $this->app->request;

        $slug = $request->getGet("slug");

  
        $content = $this->contentpost->getOnePost($slug);
        //var_dump($resultset);
        $data = [
            "content" => $content
        ];

        $page->add("cms/header");
        $page->add("cms/blogpost", $data);

        return $page->render([
            "title" => $title
        ]);
    }

}
