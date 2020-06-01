<?php

namespace Lefty\Dice;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
* Test the controller like it would be used from the router,
* simulating the actual router paths and calling it directly.
*/
class DiceControllerTest extends TestCase
{

    private $controller;

    /**
    * Setup the controller, before each testcase, just like the router
    * would set it up.
    */
    protected function setUp(): void
    {

        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new DiceController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }

    /**
    * Call the controller index action.
    */
    public function testIndexAction()
    {


        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        $this->assertStringEndsWith("INDEX!!:)", $res);
    }

    /**
    * Call the controller debug action.
    */
    public function testDebugAction()
    {


        $res = $this->controller->debugAction();
        $this->assertIsString($res);
        $this->assertStringEndsWith("Debug my game!!:)", $res);
    }

    /**
    * Call the controller init action.
    */
    public function testInitAction()
    {


        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        // $this->assertStringEndsWith("Debug my game!!:)", $res);
    }

    /**
    * Call the controller play action.
    */
    public function testPlayAction()
    {


        $res = $this->controller->playAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        // $this->assertStringEndsWith("Debug my game!!:)", $res);
    }

    /**
    * Call the controller roll action.
    */
    public function testRollAction()
    {

        $res = $this->controller->rollAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        // $this->assertStringEndsWith("Debug my game!!:)", $res);
    }



    /**
    * Call the controller save action.
    */
    public function testSaveAction()
    {
        $game = new Game();
        
        // Test with no winner
        $game->player->setScore(99);
        $this->app->session->set("game", $game);
        $res = $this->controller->saveAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        // Test with winner
        $game->player->setScore(101);
        $this->app->session->set("game", $game);
        $res = $this->controller->saveAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
    
    /**
    * Call the controller newround action.
    */
    public function testNewroundAction()
    {


        $res = $this->controller->newroundAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        // $this->assertStringEndsWith("Debug my game!!:)", $res);
    }

    /**
    * Call the controller save action.
    */
    public function testWinnerAction()
    {
        $game = new Game();
        $game->roll();
        $game->player->setScore(101);
        $game->checkWinner();
        $winner = $game->getWinner();
        // var_dump($game);
        $this->app->session->set("game", $game);
        $res = $this->controller->winnerAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $this->assertInstanceOf("\Lefty\Dice\Player", $winner);
    }
}
