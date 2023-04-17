<?php
declare(strict_types=1);

namespace App\Constant;

/**
 * 国名定数クラス
 * 
 * @package App\Constant
*/
class CountryConstant
{
    /**
     * 国名：アイスランド共和国
     *
     * @var int
     */
    public const COUNTRY_LIST = [
        1 => 'アイスランド共和国',
        2 => 'アイルランド',
        3 => 'アゼルバイジャン共和国',
        4 => 'アフガニスタン',
        5 => 'アメリカ合衆国',
        6 => 'アラブ首長国連邦',
        7 => 'アルジェリア民主人民共和国',
        8 => 'アルゼンチン共和国',
        9 => 'アルバニア共和国',
        10 => 'アルメニア共和国',
        11 => 'アンゴラ共和国',
        12 => 'アンティグア・バーブーダ',
        13 => 'アンドラ',
        14 => 'イエメン共和国',
        15 => 'イスラエル国',
        16 => 'イタリア共和国',
        17 => 'イラク共和国',
        18 => 'イラン・イスラム共和国',

    ];

    /**
     * 国名:英語表記
     * 
     * @var string[]
     */
    public const COUNTRY_ENGLISH_LIST = [
        1 => 'Afghanistan',
        2 => 'Albania',
        3 => 'Algeria',
        4 => 'Andorra',
        5 => 'Angola',
        6 => 'Antigua and Barbuda',
        7 => 'Argentina',
        8 => 'Armenia',
        9 => 'Australia',
        10 => 'Austria',
        11 => 'Azerbaijan',
        12 => 'Bahamas',
        13 => 'Bahrain',
        14 => 'Bangladesh',
        15 => 'Barbados',
        16 => 'Belarus',
        17 => 'Belgium',
        18 => 'Belize',
        19 => 'Benin',
        20 => 'Bhutan',
        21 => 'Bolivia (Plurinational State of)',
        22 => 'Bosnia and Herzegovina',
        23 => 'Botswana',
        24 => 'Brazil',
        25 => 'Brunei Darussalam',
        26 => 'Bulgaria',
        27 => 'Burkina Faso',
        28 => 'Burundi',
        29 => 'Cabo Verde',
        30 => 'Cambodia',
        31 => 'Cameroon',
        32 => 'Canada',
        33 => 'Central African Republic',
        34 => 'Chad',
        35 => 'Chile',
        36 => 'China',
        37 => 'Colombia',
        38 => 'Comoros',
        39 => 'Congo',
        40 => 'Costa Rica',
        41 => 'Côte d\'Ivoire',
        42 => 'Croatia',
        43 => 'Cuba',
        44 => 'Cyprus',
        45 => 'Czech Republic',
        46 => 'Democratic People\'s Republic of Korea',
        47 => 'Democratic Republic of the Congo',
        48 => 'Denmark',
        49 => 'Djibouti',
        50 => 'Dominica',
        51 => 'Dominican Republic',
        52 => 'Ecuador',
        53 => 'Egypt',
        54 => 'El Salvador',
        55 => 'Equatorial Guinea',
        56 => 'Eritrea',
        57 => 'Estonia',
        58 => 'Eswatini',
        59 => 'Ethiopia',
        60 => 'Fiji',
        61 => 'Finland',
        62 => 'France',
        63 => 'Gabon',
        64 => 'Gambia',
        65 => 'Georgia',
        66 => 'Germany',
        67 => 'Ghana',
        68 => 'Greece',
        69 => 'Grenada',
        70 => 'Guatemala',
        71 => 'Guinea',
        72 => 'Guinea-Bissau',
        73 => 'Guyana',
        74 => 'Haiti',
        75 => 'Honduras',
        76 => 'Hungary',
        77 => 'Iceland',
        78 => 'India',
        79 => 'Indonesia',
        80 => 'Iran (Islamic Republic of)',
        81 => 'Iraq',
        82 => 'Ireland',
        83 => 'Israel',
        84 => 'Italy',
        85 => 'Jamaica',
        86 => 'Japan',
        87 => 'Jordan',
        88 => 'Kazakhstan',
        89 => 'Kenya',
        90 => 'Kiribati',
        91 => 'Kuwait',
        92 => 'Kyrgyzstan',
        93 => 'Laos',
        94 => 'Latvia',
        95 => 'Lebanon',
        96 => 'Lesotho',
        97 => 'Liberia',
        98 => 'Libya',
        99 => 'Liechtenstein',
        100 => 'Lithuania',
        101 => 'Luxembourg',
        102 => 'Madagascar',
        103 => 'Malawi',
        104 => 'Malaysia',
        105 => 'Maldives',
        106 => 'Mali',
        107 => 'Malta',
        108 => 'Marshall Islands',
        109 => 'Mauritania',
        110 => 'Mauritius',
        111 => 'Mexico',
        112 => 'Micronesia',
        113 => 'Moldova',
        114 => 'Monaco',
        115 => 'Mongolia',
        116 => 'Montenegro',
        117 => 'Morocco',
        118 => 'Mozambique',
        119 => 'Myanmar',
        120 => 'Namibia',
        121 => 'Nauru',
        122 => 'Nepal',
        123 => 'Netherlands',
        124 => 'New Zealand',
        125 => 'Nicaragua',
        126 => 'Niger',
        127 => 'Nigeria',
        128 => 'North Korea',
        129 => 'North Macedonia',
        130 => 'Norway',
        131 => 'Oman',
        132 => 'Pakistan',
        133 => 'Palau',
        134 => 'Panama',
        135 => 'Papua New Guinea',
        136 => 'Paraguay',
        137 => 'Peru',
        138 => 'Philippines',
        139 => 'Poland',
        140 => 'Portugal',
        141 => 'Qatar',
        142 => 'Romania',
        143 => 'Russia',
        144 => 'Rwanda',
        145 => 'Saint Kitts and Nevis',
        146 => 'Saint Lucia',
        147 => 'Saint Vincent and the Grenadines',
        148 => 'Samoa',
        149 => 'San Marino',
        150 => 'Sao Tome and Principe',
        151 => 'Saudi Arabia',
        152 => 'Senegal',
        153 => 'Serbia',
        154 => 'Seychelles',
        155 => 'Sierra Leone',
        156 => 'Singapore',
        157 => 'Slovakia',
        158 => 'Slovenia',
        159 => 'Solomon Islands',
        160 => 'Somalia',
        161 => 'South Africa',
        162 => 'South Korea',
        163 => 'South Sudan',
        164 => 'Spain',
        165 => 'Sri Lanka',
        166 => 'Sudan',
        167 => 'Suriname',
        168 => 'Swaziland',
        169 => 'Sweden',
        170 => 'Switzerland',
        171 => 'Syria',
        172 => 'Tunisia',
        173 => 'Turkey',
        174 => 'Turkmenistan',
        175 => 'Turks and Caicos Islands',
        176 => 'Tuvalu',
        177 => 'Uganda',
        178 => 'Ukraine',
        179 => 'United Arab Emirates',
        180 => 'United Kingdom of Great Britain and Northern Ireland',
        181 => 'United States Minor Outlying Islands',
        182 => 'United States of America',
        183 => 'Uruguay',
        184 => 'Uzbekistan',
        185 => 'Vanuatu',
        186 => 'Venezuela (Bolivarian Republic of)',
        187 => 'Viet Nam',
        188 => 'Virgin Islands (British)',
        189 => 'Virgin Islands (U.S.)',
        190 => 'Wallis and Futuna',
        191 => 'Western Sahara',
        192 => 'Yemen',
        193 => 'Zambia',
        194 => 'Zimbabwe',
        195 => 'Other'
    ];
}