<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function testdb(Request $request){
        $country_code = [
            'AF' => '93',   // Afghanistan
            'AL' => '355',  // Albania
            'DZ' => '213',  // Algeria
            'AD' => '376',  // Andorra
            'AO' => '244',  // Angola
            'AG' => '1',    // Antigua and Barbuda
            'AR' => '54',   // Argentina
            'AM' => '374',  // Armenia
            'AU' => '61',   // Australia
            'AT' => '43',   // Austria
            'AZ' => '994',  // Azerbaijan
            'BS' => '1',    // Bahamas
            'BH' => '973',  // Bahrain
            'BD' => '880',  // Bangladesh
            'BB' => '1',    // Barbados
            'BY' => '375',  // Belarus
            'BE' => '32',   // Belgium
            'BZ' => '501',  // Belize
            'BJ' => '229',  // Benin
            'BT' => '975',  // Bhutan
            'BO' => '591',  // Bolivia
            'BA' => '387',  // Bosnia and Herzegovina
            'BW' => '267',  // Botswana
            'BR' => '55',   // Brazil
            'BN' => '673',  // Brunei Darussalam
            'BG' => '359',  // Bulgaria
            'BF' => '226',  // Burkina Faso
            'BI' => '257',  // Burundi
            'KH' => '855',  // Cambodia
            'CM' => '237',  // Cameroon
            'CA' => '1',    // Canada
            'CV' => '238',  // Cape Verde
            'CF' => '236',  // Central African Republic
            'TD' => '235',  // Chad
            'CL' => '56',   // Chile
            'CN' => '86',   // China
            'CO' => '57',   // Colombia
            'KM' => '269',  // Comoros
            'CG' => '242',  // Congo (Brazzaville)
            'CD' => '243',  // Congo, Democratic Republic of the
            'CR' => '506',  // Costa Rica
            'HR' => '385',  // Croatia
            'CU' => '53',   // Cuba
            'CY' => '357',  // Cyprus
            'CZ' => '420',  // Czech Republic
            'DK' => '45',   // Denmark
            'DJ' => '253',  // Djibouti
            'DM' => '1',    // Dominica
            'DO' => '1',    // Dominican Republic
            'EC' => '593',  // Ecuador
            'EG' => '20',   // Egypt
            'SV' => '503',  // El Salvador
            'GQ' => '240',  // Equatorial Guinea
            'ER' => '291',  // Eritrea
            'EE' => '372',  // Estonia
            'ET' => '251',  // Ethiopia
            'FJ' => '679',  // Fiji
            'FI' => '358',  // Finland
            'FR' => '33',   // France
            'GA' => '241',  // Gabon
            'GM' => '220',  // Gambia
            'GE' => '995',  // Georgia
            'DE' => '49',   // Germany
            'GH' => '233',  // Ghana
            'GR' => '30',   // Greece
            'GD' => '1',    // Grenada
            'GT' => '502',  // Guatemala
            'GN' => '224',  // Guinea
            'GW' => '245',  // Guinea-Bissau
            'GY' => '592',  // Guyana
            'HT' => '509',  // Haiti
            'HN' => '504',  // Honduras
            'HK' => '852',  // Hong Kong, SAR China
            'HU' => '36',   // Hungary
            'IS' => '354',  // Iceland
            'IN' => '91',   // India
            'ID' => '62',   // Indonesia
            'IR' => '98',   // Iran, Islamic Republic of
            'IQ' => '964',  // Iraq
            'IE' => '353',  // Ireland
            'IL' => '972',  // Israel
            'IT' => '39',   // Italy
            'CI' => '225',  // Ivory Coast
            'JM' => '1',    // Jamaica
            'JP' => '81',   // Japan
            'JO' => '962',  // Jordan
            'KZ' => '7',    // Kazakhstan
            'KE' => '254',  // Kenya
            'KI' => '686',  // Kiribati
            'KP' => '850',  // Korea (North)
            'KR' => '82',   // Korea (South)
            'KW' => '965',  // Kuwait
            'KG' => '996',  // Kyrgyzstan
            'LA' => '856',  // Lao PDR
            'LV' => '371',  // Latvia
            'LB' => '961',  // Lebanon
            'LS' => '266',  // Lesotho
            'LR' => '231',  // Liberia
            'LY' => '218',  // Libya
            'LI' => '423',  // Liechtenstein
            'LT' => '370',  // Lithuania
            'LU' => '352',  // Luxembourg
            'MO' => '853',  // Macao, SAR China
            'MK' => '389',  // Macedonia, Republic of
            'MG' => '261',  // Madagascar
            'MW' => '265',  // Malawi
            'MY' => '60',   // Malaysia
            'MV' => '960',  // Maldives
            'ML' => '223',  // Mali
            'MT' => '356',  // Malta
            'MH' => '692',  // Marshall Islands
            'MR' => '222',  // Mauritania
            'MU' => '230',  // Mauritius
            'MX' => '52',   // Mexico
            'FM' => '691',  // Micronesia, Federated States of
            'MD' => '373',  // Moldova
            'MC' => '377',  // Monaco
            'MN' => '976',  // Mongolia
            'ME' => '382',  // Montenegro
            'MA' => '212',  // Morocco
            'MZ' => '258',  // Mozambique
            'MM' => '95',   // Myanmar
            'NA' => '264',  // Namibia
            'NR' => '674',  // Nauru
            'NP' => '977',  // Nepal
            'NL' => '31',   // Netherlands
            'NZ' => '64',   // New Zealand
            'NI' => '505',  // Nicaragua
            'NE' => '227',  // Niger
            'NG' => '234',  // Nigeria
            'NO' => '47',   // Norway
            'OM' => '968',  // Oman
            'PK' => '92',   // Pakistan
            'PW' => '680',  // Palau
            'PS' => '970',  // Palestinian Territory
            'PA' => '507',  // Panama
            'PG' => '675',  // Papua New Guinea
            'PY' => '595',  // Paraguay
            'PE' => '51',   // Peru
            'PH' => '63',   // Philippines
            'PL' => '48',   // Poland
            'PT' => '351',  // Portugal
            'QA' => '974',  // Qatar
            'RO' => '40',   // Romania
            'RU' => '7',    // Russian Federation
            'RW' => '250',  // Rwanda
            'KN' => '1',    // Saint Kitts and Nevis
            'LC' => '1',    // Saint Lucia
            'VC' => '1',    // Saint Vincent and Grenadines
            'WS' => '685',  // Samoa
            'SM' => '378',  // San Marino
            'ST' => '239',  // Sao Tome and Principe
            'SA' => '966',  // Saudi Arabia
            'SN' => '221',  // Senegal
            'RS' => '381',  // Serbia
            'SC' => '248',  // Seychelles
            'SL' => '232',  // Sierra Leone
            'SG' => '65',   // Singapore
            'SK' => '421',  // Slovakia
            'SI' => '386',  // Slovenia
            'SB' => '677',  // Solomon Islands
            'SO' => '252',  // Somalia
            'ZA' => '27',   // South Africa
            'SS' => '211',  // South Sudan
            'ES' => '34',   // Spain
            'LK' => '94',   // Sri Lanka
            'SD' => '249',  // Sudan
            'SR' => '597',  // Suriname
            'SZ' => '268',  // Swaziland
            'SE' => '46',   // Sweden
            'CH' => '41',   // Switzerland
            'SY' => '963',  // Syrian Arab Republic (Syria)
            'TW' => '886',  // Taiwan, Republic of China
            'TJ' => '992',  // Tajikistan
            'TZ' => '255',  // Tanzania, United Republic of
            'TH' => '66',   // Thailand
            'TL' => '670',  // Timor-Leste
            'TG' => '228',  // Togo
            'TO' => '676',  // Tonga
            'TT' => '1',    // Trinidad and Tobago
            'TN' => '216',  // Tunisia
            'TR' => '90',   // Turkey
            'TM' => '993',  // Turkmenistan
            'TV' => '688',  // Tuvalu
            'UG' => '256',  // Uganda
            'UA' => '380',  // Ukraine
            'AE' => '971',  // United Arab Emirates
            'GB' => '44',   // United Kingdom
            'US' => '1',    // United States
            'UY' => '598',  // Uruguay
            'UZ' => '998',  // Uzbekistan
            'VU' => '678',  // Vanuatu
            'VE' => '58',   // Venezuela (Bolivarian Republic)
            'VN' => '84',   // Vietnam
            'YE' => '967',  // Yemen
            'ZM' => '260',  // Zambia
            'ZW' => '263'   // Zimbabwe
        ];

        try {
            $country_code = array_values($country_code);


            $uniqueCodes = array_unique($country_code);
// Convert the array to a JSON string
            $inputArray = json_encode($uniqueCodes);

// Call the stored procedure passing the JSON string as a parameter
            return DB::statement('CALL UpdateCodes(?)', [$inputArray]);
//            $uniqueCodesString = implode(',', $uniqueCodes);
//            $placeholders = implode(',', array_fill(0, count($uniqueCodes), '?'));
           // $sql = "CALL UpdateCodes($uniqueCodes)";
           // DB::statement($sql, $uniqueCodes);
            return  $uniqueCodes;
        }catch (\Exception $exception){
            return $exception;
        }




    }
}
