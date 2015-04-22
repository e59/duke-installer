<?php

namespace Duke\Installer\Console;

use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Nette\Utils\FileSystem as FS;

class NewCommand extends Command {

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure() {
        $this->setName('new')
                ->setDescription('Create a new Duke application.')
                ->addArgument('basedir', InputArgument::REQUIRED, 'Name of the installation directory')
                ->addArgument('namespace', InputArgument::REQUIRED, 'Namespace for the app (just for the example to run)')
                ->addArgument('webroot_dir', InputArgument::REQUIRED, 'Web server base path (the part between hostname and public_html)');
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->verifyApplicationDoesntExist(
                $directory = getcwd() . '/' . $input->getArgument('basedir'), $output
        );

        $output->writeln('<comment>Copying and adjusting files...</comment>');

        $this->createProject($directory, $input->getArgument('basedir'), $input->getArgument('namespace'), $input->getArgument('webroot_dir'));

        $output->writeln('<bg=green;fg=magenta>Done...</bg=green;fg=magenta>');
        $output->writeln('<info>Run composer install inside the project directory to install dependencies.</info>');
        $output->writeln('<info>Run bower install inside the vendor/cangulo/duke-skin-bootswatch directory to install assets.</info>');
        $output->writeln('<info>Run bin/assets.php inside the project directory to create assets.</info>');

    }

    /**
     * Verify that the application does not already exist.
     *
     * @param  string  $directory
     * @return void
     */
    protected function verifyApplicationDoesntExist($directory, OutputInterface $output) {
        if (is_dir($directory)) {
            throw new RuntimeException('Application already exists!');
        }
    }

    protected function createProject($directory, $basedir, $namespace, $webroot_dir) {
        $source = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'project';
        FS::copy($source, $directory);
        FS::copy($source . DIRECTORY_SEPARATOR . 'settings.php.example', $directory . DIRECTORY_SEPARATOR . 'settings.php');

        rename($directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'App', $directory . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $namespace);
        rename($directory . DIRECTORY_SEPARATOR . 'skins' . DIRECTORY_SEPARATOR . 'app', $directory . DIRECTORY_SEPARATOR . 'skins' . DIRECTORY_SEPARATOR . $basedir);

        foreach ($iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::SELF_FIRST) as $item) {
            if ($item->isFile()) {
                $content = file_get_contents($item);

                $wr = str_replace('//', '/', trim($webroot_dir, '/'));
                if ($wr) {
                    $wr = '/' . $wr . '/';
                } else {
                    $wr = '/';
                }


                $content = preg_replace('#%basedir%#m', $basedir, $content);
                $content = preg_replace('#%namespace%#m', $namespace, $content);
                $content = preg_replace('#%webroot_dir%#m', trim($webroot_dir, '/'), $content);

                file_put_contents($item, $content);
            }
        }
    }

}
