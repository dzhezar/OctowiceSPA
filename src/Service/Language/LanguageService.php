<?php


namespace App\Service\Language;


use App\Entity\Locale;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class LanguageService
{
    private $directory;


    /**
     * LanguageService constructor.
     * @param $directory
     */
    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function parseFile(Locale $locale)
    {
        return $this->getFile($locale->getShortName());
    }

    private function getFile(string $loc)
    {
        if(!file_exists($this->directory.$loc.'.json'))
            return false;

        return json_decode(file_get_contents($this->directory.$loc.'.json'),true);
    }

    public function updateFile(Locale $locale, array $array): void
    {
        $array = json_encode($array, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
        file_put_contents($this->directory.$locale->getShortName().'.json', $array);
    }

    public function removeFile(Locale $locale)
    {
        try {
            if(file_exists($this->directory.$locale->getShortName().'.json'))
                unlink($this->directory.$locale->getShortName().'.json');
            return true;
        } catch (FileException $e) {
            return null;
        }
    }

}