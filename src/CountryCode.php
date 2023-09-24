<?php
declare(strict_types=1);

namespace CountryCode;

use CountryCode\Dictionaries\CountryDictionary;
use CountryCode\Exception\CountryCodeNotFoundException;

class CountryCode
{

    /**
     * @var CountryDictionary
     */
    private $countryDictionary;


    public function __construct()
    {
        $this->countryDictionary = new CountryDictionary();
    }


    public function getCodeAlpha2(string $countryName): string
    {
        try {
            $code = $this->findCode($countryName, 2);
        } catch (CountryCodeNotFoundException $exception) {

            return $exception->getMessage();
        }

        return $code;
    }

    public function getCodeAlpha3(string $countryName): string
    {
        try {
            $code = $this->findCode($countryName, 3);
        } catch (CountryCodeNotFoundException $exception) {

            return $exception->getMessage();
        }

        return $code;
    }


    /**
     * @throws CountryCodeNotFoundException
     */
    private function findCode(string $countryName, int $isoAlphaVersion): string
    {
        $dictionary = $this->countryDictionary->create();

        foreach ($dictionary as $array) {
            $find = strpos(strtoupper($array["names"]), "|" . strtoupper($countryName) . "|");

            if ($find !== false) {
                switch ($isoAlphaVersion) {
                    case 2:

                        return $array["alpha-2"];
                    case 3:

                        return $array["alpha-3"];
                    default:

                        throw new CountryCodeNotFoundException("An error when looking for Alpha-". $isoAlphaVersion ." code for country: '" . $countryName . "' occurred.");
                }
            }
        }

        throw new CountryCodeNotFoundException("No Alpha-". $isoAlphaVersion ." code for country with name: '" . $countryName . "' found.");
    }

}