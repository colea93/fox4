<?php
class LeadrockIntegrationDownloader
{
    public function doMagic()
    {
        $this->log('Start downloading file', true);

        if ($this->downloadFile($this->getPackageUrl(), $this->getPackageSavePath())) {
            if ($this->checkIncludePhar()) {
                $this->checkReplacedInstructions();
                $this->log('Ready to work. Open your landing now to check the result.');
            } else {
                try {
                    $this->log('Unable to include PHAR package. Trying to unpack it.');
                    $this->unpackPhar();

                    $this->replaceIncludeInsctuctions();
                    $this->log('Ready to work. Open your landing now to check the result.');
                } catch (Exception $e) {
                    $this->log($this->getErrorText());
                }
            }
        } else {
            $this->log($this->getErrorText());
        }
    }

    private function getErrorText()
    {
        return [
            'Error',
            'Check write access to current directory: script is trying to create file leadrock-integration.phar or directory leadrock-integration.',
            'If there will be no success, try manual download: <a href="' . $this->getPackageUrl() . '">' . $this->getPackageUrl() . '</a>. Place this file to current folder and open your landing page.',
            'Or you can visit source code page and see expanded documentation: <a href="httpss://github.com/brntsrs/leadrock-integration/releases">httpss://github.com/brntsrs/leadrock-integration/releases</a>',
        ];
    }

    private function downloadFile($url, $pathToSave)
    {
        @file_put_contents($pathToSave, file_get_contents($url));
        return filesize($pathToSave) > 0;
    }

    private function checkIncludePhar()
    {
        @include $this->includeInstructionText();
        return class_exists('\Leadrock\Layouts\Landing');
    }

    private function unpackPhar()
    {
        $phar = new Phar($this->getPackageSavePath());
        $phar->extractTo($this->getPackageSavePath(false), null, true);
        unset($phar);
    }

    private function replaceIncludeInsctuctions()
    {
        $d = dir(dirname(__FILE__));
        while (false !== ($entry = $d->read())) {
            if (strpos($entry, '.php') !== false && $entry != basename(__FILE__)) {
                $filePath = dirname(__FILE__) . '/' . $entry;
                $fileContent = file_get_contents($filePath);
                if (strpos($fileContent, $this->includeInstructionText()) !== false) {
                    file_put_contents($filePath, str_replace($this->includeInstructionText(), $this->includeInstructionReplacement(), $fileContent));
                }
            }
        }
        $d->close();
    }

    private function checkReplacedInstructions()
    {
        $d = dir(dirname(__FILE__));
        while (false !== ($entry = $d->read())) {
            if (strpos($entry, '.php') !== false && $entry != basename(__FILE__)) {
                $filePath = dirname(__FILE__) . '/' . $entry;
                $fileContent = file_get_contents($filePath);
                if (strpos($fileContent, $this->includeInstructionReplacement()) !== false) {
                    file_put_contents($filePath, str_replace($this->includeInstructionReplacement(), $this->includeInstructionText(), $fileContent));
                }
            }
        }
        $d->close();
    }

    private function log($texts, $extraSeparator = false)
    {
        if (!is_array($texts)) {
            $texts = [$texts];
        }
        foreach ($texts as $row) {
            echo $row, "<br>\r\n";
        }
        echo ($extraSeparator ? "<br>\r\n" : '');
    }

    private function getPackageSavePath($isPhar = true)
    {
        return dirname(__FILE__) . '/leadrock-integration' . ($isPhar ? '.phar' : '');
    }

    private function getPackageUrl()
    {
        return 'https://leadrock.com/integration/download?url=' . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    private function includeInstructionText()
    {
        return 'phar://leadrock-integration.phar/vendor/autoload.php';
    }

    private function includeInstructionReplacement()
    {
        return 'leadrock-integration/vendor/autoload.php';
    }
}

$loader = new LeadrockIntegrationDownloader();
$loader->doMagic();