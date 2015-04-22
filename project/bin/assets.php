<?php

include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'init.php';

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use \Assetic\Filter\CssMinFilter;
use \Assetic\Filter\JSqueezeFilter;
use \Nette\Utils\FileSystem as FS;
use \Nette\Utils\Arrays as A;

function parseManifest($manifest) {
    if (!file_exists($manifest)) {
        return false;
    }

    $contents = file($manifest);

    foreach ($contents as $k => $row) {
        preg_match('/^[\s]*#/', $row, $matches);
        if ($matches) {
            unset($contents[$k]);
            continue;
        }
        $contents[$k] = trim($contents[$k]);
    }

    return array_filter($contents);
}

define('ASSETS_JS', 'js');
define('ASSETS_CSS', 'css');
define('ASSETS_FILES', 'file');

$manifestMap = [
    'js.manifest' => ['type' => ASSETS_JS, 'debug_output' => 'scripts.php', 'output' => 'scripts.js'],
    'js.common.manifest' => ['type' => ASSETS_JS, 'debug_output' => 'scripts.common.php', 'output' => 'scripts.common.js'],
    'js.ie.manifest' => ['type' => ASSETS_JS, 'debug_output' => 'scripts.ie.php', 'output' => 'scripts.ie.js'],
    'css.manifest' => ['type' => ASSETS_CSS, 'debug_output' => 'styles.php', 'output' => 'styles.css'],
    'css.ie.manifest' => ['type' => ASSETS_CSS, 'debug_output' => 'styles.ie.php', 'output' => 'styles.ie.css'],
    'copy.manifest' => ['type' => ASSETS_FILES],
];

$skins_abs = C::$root_abs . 'public_html' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'skins' . DIRECTORY_SEPARATOR;


foreach (C::$skins as $index => $d) {

    $dir = A::get($d, 'abs');
    if (C::$debug) {
        $skins = $d['debug'];
    } else {
        $skins = $d['production'];
    }

    $finalDir = $skins_abs . $index . DIRECTORY_SEPARATOR;

    FS::createDir($finalDir);

    foreach ($manifestMap as $manifest => $info) {
        $set = parseManifest($dir . $manifest);
        if (false === $set) {
            echo 'Manifest not found: ' . $manifest, PHP_EOL;
            continue;
        }
        if (C::$debug) {
            $include = '';
            foreach ($set as $item) {

                if ($info['type'] == ASSETS_JS) {
                    $include .= '<script src="' . $skins . $item . '"></script>' . PHP_EOL;
                } elseif ($info['type'] == ASSETS_CSS) {
                    $include .= '<link rel="stylesheet" href="' . $skins . $item . '">' . PHP_EOL;
                } elseif ($info['type'] == ASSETS_FILES) {
                    foreach ($set as $item) {
                        $source = strtok($item, ' ');
                        $destination = strtok(' ');
                        if (!$destination) {
                            die('No destination specified for ' . $item);
                        }
                        $src = $dir . $source;
                        $dst = $skins_abs . $index . DIRECTORY_SEPARATOR . $destination;

                        FS::copy($src, $dst);
                    }
                } else {
                    die('Unknown asset type: ' . $type);
                }
            }
            if ($info['type'] != ASSETS_FILES) {
                FS::write($finalDir . $info['debug_output'], $include);
            }
        } else {
            if ($info['type'] == ASSETS_CSS) {
                $data = new AssetCollection(array(), array(new CssMinFilter()));
                $outputDir = $finalDir . 'stylesheets';
            } elseif ($info['type'] == ASSETS_JS) {
                $data = new AssetCollection(array(), array(new JSqueezeFilter()));
                $outputDir = $finalDir . 'javascripts';
            } elseif ($info['type'] == ASSETS_FILES) {
                foreach ($set as $item) {
                    $source = strtok($item, ' ');
                    $destination = strtok(' ');
                    if (!$destination) {
                        die('No destination specified for ' . $item);
                    }
                    $src = $dir . $source;
                    $dst = $skins_abs . $index . DIRECTORY_SEPARATOR . $destination;
                    FS::copy($src, $dst);
                }
            }

            if ($info['type'] != ASSETS_FILES) {
                foreach ($set as $item) {
                    $data->add(new FileAsset($dir . $item));
                }

                FS::write($outputDir . '/' . $info['output'], $data->dump());
            }
        }
    }
}
