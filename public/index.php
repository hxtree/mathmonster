<?php

require __DIR__ . '/../vendor/autoload.php';

use MathMonster\Game;
use MathMonster\Draw;

$game = new Game();
$drawer = new Draw();

?>
<?php echo $drawer->drawLogo(); ?>
<?php echo $drawer->drawMonsterHead($game->getTotal()); ?>

<?php foreach($game->getChoices() as $key => $value): ?>
    <?php echo "{$key}) $value "; ?>
<?php endforeach; ?>


What <?php echo $game->getAnswerQuantity(); ?> numbers equal the total?

<?php $line = fgets(STDIN); ?>

<?php if($game->checkAnswer($line)): ?>
    Congratulations. You Win!!!!
<?php else: ?>
    Sorry. Your answers are wrong.
    The correct answers are <?php echo $game->getAnswers(); ?>
<?php endif; ?>