<?php

namespace MathMonster;

/**
 * Class MathMonster
 */
class Game
{
    /**
     * Highest number used
     */
    const MAX = 20;

    /**
     * The number of choices to select
     */
    const ANSWER_QUANTITY = 2;

    /**
     * Number of options
     */
    const CHOICE_AMOUNT = 3;

    /**
     * @var int the total
     */
    public $total;

    /**
     * @var array an array of correct selections
     */
    private $answer = [];

    /**
     * @var array an array of possible selections
     */
    private $choices = [];

    /**
     * @var array an array containing numbers already selected to prevent duplicates
     */
    private $numbersAssigned = [];

    /**
     * @var string[] markers to indicate selections
     */
    private $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    /**
     * MathMonster constructor.
     */
    public function __construct()
    {
        for ($i = 0; $i < self::ANSWER_QUANTITY; $i++) {
            $this->answer[$i] = $this->getUniqueNumber();
        }

        $this->choices = $this->generateChoices();

        foreach ($this->answer as $key => $value) {
            $this->total += $value;
        }

    }

    /**
     * @return int|mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getAnswerQuantity()
    {
        return self::ANSWER_QUANTITY;
    }

    /**
     * Get a unique number not previously used
     * @return int
     */
    public function getUniqueNumber()
    {
        do {
            $number = rand(1, self::MAX);
        } while (in_array($number, $this->numbersAssigned));

        $this->numbersAssigned[] = $number;

        return $number;
    }

    /**
     * Get choices
     * @return array|mixed
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Generate choices
     * @return array
     */
    public function generateChoices()
    {
        for($i = 0; $i < self::CHOICE_AMOUNT; $i++){
            $array[] = !empty($this->answer[$i]) ? $this->answer[$i] : $this->getUniqueNumber();
        }

        shuffle($array);

        $options = [];
        foreach($array as $key => $value){
            $options[$this->alphabet[$key]] = $value;
        }

        return $options;
    }

    /**
     * Get answers
     * @return string
     */
    public function getAnswers()
    {
        return implode(', ', $this->answer);
    }

    public function checkAnswer($input){
        $selection = [];

        list($selection[0]['input'], $selection[1]['input']) = explode(' ', $input);

        // trim input
        $selection[0]['input'] = trim($selection[0]['input']);
        $selection[1]['input'] = trim($selection[1]['input']);

        // get actual answer
        $selection[0]['actualAnswer'] = $this->choices[$selection[0]['input']];
        $selection[1]['actualAnswer'] = $this->choices[$selection[1]['input']];

        if(
            (($selection[0]['actualAnswer'] == $this->answer[0]) && ($selection[1]['actualAnswer']== $this->answer[1]))
            || (($selection[1]['actualAnswer'] == $this->answer[0]) && ($selection[0]['actualAnswer'] == $this->answer[1]))
        ) {
            return true;
        } else {
            return false;
        }
    }
}