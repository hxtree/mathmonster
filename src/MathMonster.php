<?php

/**
 * Class MathMonster
 */
class MathMonster
{
    /**
     * Highest number used
     */
    const MAX = 100;

    /**
     * Number of options
     */
    const CHOICE_AMOUNT = 5;

    public $total;
    public $partA;
    public $partB;
    public $alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    public $choices = [];

    public function __construct(){
        $this->partA = rand(1, self::MAX);
        do{
            $this->partB = rand(1, self::MAX);
        } while ($this->partB == $this->partA);

        $this->total = $this->partA + $this->partB;
    }

    public function header()
    {
        return <<<TEXT
        ___  ___  ___ _____ _   _ ___  ________ _   _  _____ _____ ___________ 
        |  \/  | / _ \_   _| | | ||  \/  |  _  | \ | |/  ___|_   _|  ___| ___ \
        | .  . |/ /_\ \| | | |_| || .  . | | | |  \| |\ `--.  | | | |__ | |_/ /
        | |\/| ||  _  || | |  _  || |\/| | | | | . ` | `--. \ | | |  __||    / 
        | |  | || | | || | | | | || |  | \ \_/ / |\  |/\__/ / | | | |___| |\ \ 
        \_|  |_/\_| |_/\_/ \_| |_/\_|  |_/\___/\_| \_/\____/  \_/ \____/\_| \_|
        TEXT;

    }

    public function drawMonsterHead(){
        return <<<TEXT

                 

                 _,\,\,\|\|\|\|\|\|\|\/-\___.._
             __,-'                          () .\
            /  __/---\___                    ---/   {$this->total} 
           |  /          \ \___________/\\ \__\
           | |            \ \            \\
           | |            / |             \\__/_
           | |            | \/_              /\
            ||             \--\
             ||
              \\_______
               \-------\\____
               

        TEXT;

    }

    public function getNumbers()
    {
        $array = [
            $this->partA,
            $this->partB,
        ];

        for($i = 2; $i < self::CHOICE_AMOUNT; $i++){
            do {
                $number = rand(1, self::MAX);
            } while (in_array($number, $array));
            $array[] = $number;
        }

        shuffle($array);

        foreach($array as $key => $value){
            $this->choices[$this->alphabet[$key]] = $value;
        }

        $output = '';
        foreach($this->choices as $key => $value){
            $output .= "{$key}) $value " . PHP_EOL;
        }

        return $output;
    }

    public function checkAnswer($input){
        $answers = [];
        list($answers[1]['input'], $answers[2]['input']) = explode(' ', $input);

        // trim input
        $answers[1]['input'] = trim($answers[1]['input']);
        $answers[2]['input'] = trim($answers[2]['input']);

        // get letters answered
        $answers[1]['letterInAlphabet'] = array_search($answers[1]['input'], $this->alphabet);
        $answers[2]['letterInAlphabet'] = array_search($answers[2]['input'], $this->alphabet);

        // get actual answer
        $answers[1]['actualAnswer'] = $this->choices[$answers[1]['input']];
        $answers[2]['actualAnswer'] = $this->choices[$answers[2]['input']];

        if(
            (($answers[1]['actualAnswer'] == $this->partA) && ($answers[2]['actualAnswer']== $this->partB))
            || (($answers[2]['actualAnswer'] == $this->partA) && ($answers[1]['actualAnswer'] == $this->partB))
        ) {
            return "You Win!!!!" . PHP_EOL;
        } else {
            return <<<TEXT
            Sorry, your answer of is wrong.
            The right answer as {$this->partA} and {$this->partB}
            TEXT;
        }
    }
}


$game = new MathMonster();
echo $game->header();
echo $game->drawMonsterHead();
echo PHP_EOL;
echo $game->getNumbers();
echo "What numbers equal total?";
$line = fgets(STDIN);
echo $game->checkAnswer($line);