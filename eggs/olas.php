<?php
/*-Vairākas olas ar dažādiem spēkiem IR
- Randomā ģenerējas olas ar dažādiem spēkiem spēlētājam IR
- Olām ir daudzums (var būt vienādas olas ar lielāku daudzumu) IR
- Uzvaras gadījumā Tu saņem pretinieka olu. NAV
- Zaudējuma gadījumā Tev pazūd ola NAV
- Neizšķirta gadījumā abiem pazūd ola NAV
- Kaujas simulācija beidzas tad, kad vienam no spēlētājiem beidzas olas NAV
*/
function createRandomEgg (string $name, int $power, int $qty): stdClass
{
    $egg = new stdClass();
    $egg->name = $name;
    $egg->power = $power;
    $egg->qty = $qty;

    return $egg;
}

$playerEggs = [
  createRandomEgg("MegaEgg", 50,2),
  createRandomEgg("SuperEgg", 40, 3),
  createRandomEgg("SuperMegaEgg", 30, 3),
  createRandomEgg("MassiveEgg", 20, 4)
];

$pcEggs = [];
for ($i = 0; $i < 4; $i++)
{
    $power = rand(20, 70);
    $qty = rand(1, 4);
    $pcEggs[] = createRandomEgg("PCEGG" . $i, $power, $qty);
}

echo "Player eggs: " . PHP_EOL;
foreach ($playerEggs as $egg)
{
    echo "{$egg->name} ({$egg->qty}egg/eggs) (P:{$egg->power})";
    echo " | ";
}

echo PHP_EOL;
echo "<<<<<<<<<<<<<<<<<<<<<||||||||||||||||||||||||||||||||>>>>>>>>>>>>>>>>>>>>>>>" . PHP_EOL;
echo "PC eggs: " . PHP_EOL;

foreach ($pcEggs as $egg)
{
    echo "{$egg->name} ({$egg->qty}egg/eggs) (P:{$egg->power})";
    echo " | ";
}

echo PHP_EOL;
echo "----------------------------LET THE BATTLE BEGIN!----------------------------" . PHP_EOL;

$existed = false;
while (true)
{
    if (count($playerEggs) <= 0 || count($pcEggs) <= 0) break;

    $playerEgg = $playerEggs[array_rand($playerEggs)];
    $pcEgg = $pcEggs[array_rand($pcEggs)];

    $totalTickets = $playerEgg->power + $pcEgg->power;
    $randomNumber = rand(1, $totalTickets);

    echo "{$playerEgg->name} eggs->({$playerEgg->qty}) P:{$playerEgg->power} fights against {$pcEgg->name} eggs->({$pcEgg->qty}) P: {$pcEgg->power}";
    echo PHP_EOL;
    echo "RANDOM WAS: {$randomNumber}";
    echo PHP_EOL;

        if ($randomNumber <= $playerEgg->power) {
            $existed = false;
            echo "PLAYER WON" . PHP_EOL;
            $playerEgg->qty += 1;
            echo "Player now has: {$playerEgg->qty} eggs." . PHP_EOL;
            $pcEgg->qty -= 1;
            echo "PC now has: {$pcEgg->qty} eggs." . PHP_EOL;
        }
        if ($randomNumber <= $pcEgg->power)
            {
                echo "PC WON" . PHP_EOL;
                $playerEgg->qty -= 1;
                echo "Player now has: {$playerEgg->qty} eggs." . PHP_EOL;
                $pcEgg->qty += 1;
                echo "PC now has: {$pcEgg->qty} eggs." . PHP_EOL;
            }
        if ($pcEgg->power == $playerEgg->power)
        {
            echo "TIE" . PHP_EOL;
        }
        if ($playerEgg->qty <= 0)
        {
            $existed = false;
            echo "PLAYER LOST!" . PHP_EOL;
            exit;
        }
        if ($pcEgg->qty <= 0)
        {
            $existed = true;
            echo "PC LOST!" . PHP_EOL;
            exit;
        }

usleep(500000);
    }