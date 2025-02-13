<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $addressIndex = 0;

    public function definition()
    {
        /*
        $addresses = [
            '0xf33c13a871b8132827D0370359024726d137D98F',
            '0xdc52fd9c0F960059932E1bcD521B3C588134f62E',
            '0x1Bdd01191B1c4134D2071B39ea846b9E1Ac2De2e',
            '0xB55506abfF9212E3447Ca7942A8c75b77FAd61A7',
            '0x78490E03B50bec0922397DE03966CcbA133dD84D',
            '0x4E484a9329006770f3b0090F31e96FbD054b9e10',
            '0xE659d196348ff53Db02a0989Fe513c60ba6B09D1',
            '0x48BD931FF170CCF38190D2A617C133Ab28fc1ef5',
            '0xEa2616479716cc345a7797C71639A306451A9AC5',
            '0xA9DE06F5692AFFe05A5661708cF59F14c2BA19c4',
            '0x9429708fD69C596037bAF376C2b2e0cd105Cd34a',
        ];

        // Get the current address based on the index
        $address = $addresses[self::$addressIndex];

        // Increment the index and reset if it exceeds the array length
        self::$addressIndex = (self::$addressIndex + 1) % count($addresses);

        return [
            'address' => strtolower($address),
        ];*/
    }
}
