<?PHP

namespace BlueShamrock\Symfony\BsdRADBundle\Composer;

use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as BaseScriptHandler;
use Composer\Script\CommandEvent;

class ScriptHandler extends BaseScriptHandler
{

    protected static $DEFAULT_ENV = 'dev';

    public static function installEnvironmentFiles(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $io = $event->getIO();
        $appDir = $options['symfony-app-dir'];
        $parametersFile = $appDir . "/config/parameters.yml";
        $databasesFile  = $appDir . "/config/databases.yml";

        if ( file_exists($parametersFile) && file_exists($databasesFile) ) {

            return;
        }
        if ( !is_dir($appDir) ) {
           $io->write("The symfony-app-dir (" . $appDir . ") specified in the composer.json file could not be found. ", true);

            return;
        }

        $environment = strtolower($io->ask(sprintf("What environment are you deploying? [%s] ", self::$DEFAULT_ENV), self::$DEFAULT_ENV));
        if (!file_exists($parametersFile)) {
      
            $envParametersFile = $appDir . "/config/environments/parameters" . "." . $environment . ".yml";
             
            if ( !file_exists($envParametersFile) ) {
                $io->write("The environmnet parameters file (" . $envParametersFile . ") is missing. Task cannot be completed. ", true);

                return;
            }

            copy($envParametersFile, $parametersFile);

        } else {
                $io->write("<comment>The parameters file (" . $parametersFile . ") exists.</comment> <info>Skipping.</info> ", true);
        }
        

        if (!file_exists($databasesFile)) {

            $envDatabasesFile= $appDir . "/config/environments/databases" . "." . $environment . ".yml";
            if ( !file_exists($envDatabasesFile) ) {
                $io->write("The environmnet databases file (" . $envDatabasesFile . ") is missing. Task cannot be completed. ", true);

                return;
            }

            copy($envDatabasesFile, $databasesFile);

        } else {
                $io->write("<comment>The databases file (" . $databasesFile . ") exists.</comment> <info>Skipping.</info> ", true);
        }



    }

}
