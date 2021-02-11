<?php
/**
 * Created by PhpStorm.
 * User: Thodin
 * Date: 11.02.2021
 * Time: 14:56
 */

namespace Thodin\SoobshcheniyaOtFormyZahvata\Classes;

use Cookie;

/**
 * Class UTMParser
 * @package Thodin\SoobshcheniyaOtFormyZahvata\Classes
 *
 * work with javascript plugin sbjs
 * @see sourcebuster.min.js
 */
class UTMParser
{
    /**
     *
     */
    const COOKIE_NAME_CURRENT = 'sbjs_current';

    /**
     *
     */
    const COOKIE_NAME_FIRST = 'sbjs_first';

    /**
     *
     */
    const COOKIE_NAME_FIRST_ADD = 'sbjs_first_add';

    /**
     *
     */
    const NEED_PARAMS_CURRENT_MAP = [
        'typ' => 'traffic_type',
        'src' => 'utm_source',
        'mdm' => 'utm_medium',
        'cmp' => 'utm_campaign',
        'cnt' => 'utm_content',
        'trm' => 'utm_term',
    ];

    /**
     *
     */
    const NEED_PARAMS_FIRST_MAP = [
        'typ' => 'traffic_type',
        'src' => 'utm_source',
        'mdm' => 'utm_medium',
        'cmp' => 'utm_campaign',
        'cnt' => 'utm_content',
        'trm' => 'utm_term',
    ];

    /**
     *
     */
    const NEED_PARAMS_FIRST_ADD_MAP = [
        'fd' => 'first date',
        'ep' => 'entry point',
        'rf' => 'referral',
    ];

    /**
     *
     * @return array|null
     * @example typ=utm|||src=youtube|||mdm=(none)|||cmp=(none)|||cnt=(none)|||trm=(none)
     *
     */
    public function getCurrent()
    {
        return $this->parse(Cookie::get(self::COOKIE_NAME_CURRENT), self::NEED_PARAMS_CURRENT_MAP);
    }

    /**
     * @return array|null
     * @example typ=utm|||src=youtube|||mdm=(none)|||cmp=(none)|||cnt=(none)|||trm=(none)
     */
    public function getFirst()
    {
        return $this->parse(Cookie::get(self::COOKIE_NAME_FIRST), self::NEED_PARAMS_FIRST_MAP);
    }

    /**
     * @return array|null
     * @example fd=2021-02-10 22:54:16|||ep=http://megallp.test:88/catalog/|||rf=(none)
     */
    public function getFirstAdd()
    {
        return $this->parse(Cookie::get(self::COOKIE_NAME_FIRST_ADD), self::NEED_PARAMS_FIRST_ADD_MAP);
    }

    /**
     * @param string $sSbString
     * @param array  $map
     *
     * @return array|null
     */
    protected function parse(string $sSbString, array $map)
    {
        if (empty($sSbString))
        {
            return null;
        }

        $arValues = explode('|||', $sSbString);
        $arOut = [];

        if (!is_array($arValues))
        {
            return null;
        }

        $arParsedKeyValues = [];

        foreach ($arValues as $keyValue)
        {
            $arTmp = explode('=', $keyValue, 2);
            if (count($arTmp) === 2)
            {
                $arParsedKeyValues[$arTmp[0]] = $arTmp[1];
            }
        }

        foreach ($map as $k => $var)
        {
            if (array_key_exists($k, $arParsedKeyValues) && mb_strlen($arParsedKeyValues[$k]) > 0 && $arParsedKeyValues[$k] !== '(none)')
            {
                $arOut[$var] = $arParsedKeyValues[$k];
            }
        }

        return $arOut;
    }

    /**
     * @param array $array
     *
     * @return string
     */
    public function join(array $array)
    {
        $out = '';
        foreach ($array as $k => $v)
        {
            $out .= $k . " = " . $v . "\n";
        }

        return $out;
    }
}
