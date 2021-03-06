<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author Alexis Garcia
 */
class PacoTheGreatPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $DreamTeam = array('Etienneelg', 'Felixdupriez', 'GHope', 'Shiinsekai', 'Christaupher', 'Benli06', 'Galtar95',
            'Sky555v');
        $delegues = array('Akatsuki95', 'Vegan60');

        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        //$this->prettyDisplay();


        /*
         * Avant de commencer, un peu d'humour :
         * J'ai une blague sur les magasins
         * Mais elle a pas supermarché
         * */


        $oppName = $this->result->getStatsFor($this->opponentSide)['name'];
        if (in_array($oppName, $delegues))
            return parent::foeChoice();

        // Team Strategy to maximise score
        if (in_array($oppName, $DreamTeam))
            return parent::friendChoice();

        // First round always return friend
        if ($this->result->getNbRound() == 0)
            return parent::friendChoice();

        if ($this->result->getLastChoiceFor($this->mySide) == 'friend') {
            // If opponent uses more foe than friend, break his neck
            if ($this->result->getStatsFor($this->opponentSide)['friend'] < $this->result->getStatsFor($this->opponentSide)['foe'])
                return parent::foeChoice();
            return parent::friendChoice();
        }

        // If opponent was a foe, break his neck
        if ($this->result->getLastChoiceFor($this->mySide) == 'foe')
            return parent::foeChoice();

        return parent::foeChoice();
    }
 
};