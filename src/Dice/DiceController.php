<?php

namespace Lefty\Dice;

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
class DiceController implements AppInjectableInterface
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
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }


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
    * This is the init action
    *
    * @return object
    */
    public function initAction() : object
    {

        $session = $this->app->session;
        $response = $this->app->response;

        // Init the game
        $game = new Game(2);

        $session->set("game", $game);

        return $response->redirect("dice/play");
    }

    /**
    * This is the play action
    *
    * @return object
    */
    public function playAction() : object
    {
        $title = "Spela spelet";

        $session = $this->app->session;
        $page = $this->app->page;

        // $game = $_SESSION["game"];
        $game = $session->get("game");
        $badThrow = $game->badThrow();
        $currentPlayer = $game->getCurrentPlayer();
    
        $playerScore = $game->player->getScore();
        $cpuScore = $game->cpu->getScore() ;
    
        $rollScore = $currentPlayer->getPlayerHand()->getSum();
        $roundScore = $game->getCurrentRound()->getRoundScore();
        $isComputer = $currentPlayer->isComputer();
        
        $scoreToWin = $game->scoreToWin();
        $computerChoice = ($isComputer == true) ? $computerChoice = $currentPlayer->makePlay($currentPlayer->getScore(), $roundScore, $rollScore, $scoreToWin) : null;
        $histogram = $game->getHistogram();
    
    
    
        // print_r($computerChoice);
        $data = [
            "playerScore" => $playerScore,
            "cpuScore" => $cpuScore,
            "roundScore" => $roundScore,
            "rollScore" => $rollScore,
            "isComputer" => $isComputer,
            "computerChoice" => $computerChoice,
            "badThrow" => $badThrow,
            "currentPlayer" => $currentPlayer,
            "histogram" => $histogram
        ];
    
    
        // $game->getCurrentPlayer()->clearPlayerHand();
        $page->add("dice/standing", $data);
        $page->add("dice/play", $data);
        // $page->add("dice/debug");
    
        return $page->render([
            "title" => $title,
        ]);
    }

        /**
    * This is the roll action
    *
    * @return object
    */
    public function rollAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        // $game = $_SESSION["game"] ?? null;
        $game = $session->get("game");
        $game->roll();
        return $response->redirect("dice/play");
    }
    
    /**
    * This is the save action:
    *
    * @return object
    */
    public function saveAction() : object
    {

        $session = $this->app->session;
        $response = $this->app->response;

        $game = $session->get("game");
        $game->save();
        if ($game->checkWinner()==true) {
            return $response->redirect("dice/winner");
        } else {
            return $response->redirect("dice/newround");
        }
    }

    /**
    * This is the newround action
    *
    * @return object
    */
    public function newroundAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        $game = $session->get("game");
        $game->goToNextRound();
        return $response->redirect("dice/roll");
    }

    /**
    * This is the winner action, it handles:
    *
    * @return object
    */
    public function winnerAction() : object
    {
        $title = "Spela spelet";

        $session = $this->app->session;
        $page = $this->app->page;

        $game = $session->get("game");
    
        $playerScore = $game->player->getScore();
        $cpuScore = $game->cpu->getScore();
        $winner = $game->getWinner()->getName();
        $histogram = $game->getHistogram();
    
        $data = [
            "playerScore" => $playerScore,
            "cpuScore" => $cpuScore,
            "winner" => $winner,
            "histogram" => $histogram
        ];
    
    
        $page->add("dice/standing", $data);
        $page->add("dice/winner", $data);
        // $app->page->add("dice/debug");
    
        return $page->render([
            "title" => $title,
        ]);
    }
}
