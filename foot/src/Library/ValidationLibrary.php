<?php
declare(strict_types=1);

namespace APP\Library;

class ValidationLibrary
{
/**
     * decimal型判定処理
     *
     * 0.1以上99.9以下場合値を返す
     *
     * @param int|float|null $value チェック対象文字列
     * @return bool 判定結果(true:不適切 / false:適切)
     */
    public static function isDecimalFormat(int|float|null $value): bool
    {
        if (is_null($value)) {
            return false;
        }
        // メソッドの引数が[string]なので変更
        $result = (string)$value;
        $comma = '.';

        if (self::isIncludeComma($result, $comma)) {
            // 数値分割処理
            $fullNumber = self::isSplitValue($result, $comma);

            // 数値桁数判定処理(2桁)
            if (!self::isNumberOfDoubleDigits($fullNumber[0])) {
                return false;
            }

            // 10進数自然数判定
            if (!self::isInteger($fullNumber[0])) {
                return false;
            }

            // 数値桁数判定処理(1桁)
            if (!self::isNumberOfADigits($fullNumber[1])) {
                return false;
            }

            // 10進数自然数判定
            if (!self::isInteger($fullNumber[0])) {
                return false;
            }

            return true;
        } else {
            // 数値桁数判定処理(2桁)
            if (!self::isNumberOfDoubleDigits($result)) {
                return false;
            }

            // 10進数自然数判定
            if (!self::isInteger($result)) {
                return false;
            }

            return true;
        }
    }

    /**
     * コンマ判定処理
     *
     * コンマが含まれているか判定する
     *
     * @param string $result チェック対象文字列
     * @param string $comma コンマ
     * @return bool 判定結果(true:コンマが含まれている / false:含まれていない)
     */
    public static function isIncludeComma(string $result, string $comma): bool
    {
        if (str_contains($result, $comma)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 数値桁数判定処理(2桁)
     *
     * @param string $result チェック対象文字列
     * @return bool 判定結果(true:2ビット以下 / false:3ビット以上)
     */
    public static function isNumberOfDoubleDigits(string $result): bool
    {
        $digits = strlen($result);
        if ($digits <= 2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 数値桁数判定処理(1桁)
     *
     * @param string $result チェック対象文字列
     * @return bool 判定結果(true:2ビット以下 / false:3ビット以上)
     */
    public static function isNumberOfADigits(string $result): bool
    {
        $digits = strlen($result);
        if ($digits == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 　数値int型判定処理
     *
     * @param string $value チェック対象文字列
     * @return bool 判定結果(true:int型 / false:不適切)
     */
    public static function isInteger(string $value): bool
    {
        if (ctype_digit($value)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 数値分割処理
     *
     * コンマの前と後で数値を分ける
     *
     * @param string $result チェック対象文字列
     * @param string $comma コンマ
     * @return array 判定結果(true:適切 / false:不適切)
     */
    public static function isSplitValue(string $result, string $comma): array
    {
        $position = strpos($result, $comma);
        $firstHalf = mb_strstr($result, $comma, true);
        $secondHalf = substr($result, $position + 1);

        return [$firstHalf, $secondHalf];
    }

    /**
     * int型またはNULL判定処理
     *
     * int型かnullならtrueを返す
     *
     * @param mixed $condition チェック対象値
     * @return bool 判定結果(true:適切 / false:不適切)
     */
    public static function isIntegerOrNull(mixed $condition): bool
    {
        // 対象の値が空またはNULLの場合true
        if (empty($condition)) {
            return true;
        }

        if (ctype_digit((string)$condition)){
            return true;
        }

        return false;
    }
}