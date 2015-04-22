<?php

/**
 * Este script procura em todos os arquivos de src/ menções aos templates da pasta src/templates, e mostra alguns resultados
 * para a pessoa decidir se vai apagar os templates ou não.
 * @TODO: REFAZER, ESTÁ DEPRECAGADED.
 */
include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php';

$srcDir = C::$root_abs . 'src' . DIRECTORY_SEPARATOR;
$templatesDir = C::$root_abs . 'src' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
$contents = [];
$notFound = [];

foreach ($iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($templatesDir, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $template)
{
    if ($template->isFile())
    {
        $templateName = $template->getFilename();
        $notFound[$templateName] = true;

        foreach ($iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($srcDir, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST) as $item)
        {
            $matches = array();
            if ($item->isFile())
            {
                $fileName = $item->getPathname();
                if (!array_key_exists($fileName, $contents))
                {
                    $contents[$fileName] = file_get_contents($fileName);
                }

                $result = (bool) preg_match('#' . $templateName . '#s', $contents[$fileName]);

                if ($result)
                {
                    $notFound[$templateName] = false;
                }
            }
        }
    }
}

$notFound = array_filter($notFound);
var_dump($notFound);
