<?php


use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace this with the path to your own project bootstrap file.
$entityManager = \core\Model::getManager();
// replace with mechanism to retrieve EntityManager in your app
return ConsoleRunner::createHelperSet($entityManager);



