<?php
declare(strict_types=1);

namespace App\Library;

use Cake\Utility\Inflector;

/**
 * データ変換ライブラリ
 * 
 * @package App\Library
 */
class ConvertLibrary
{
    /**
     * キャメルケースからスネークケースへの変換
     * 
     * @param array $params パラメータ
     * @return array 処理結果配列
     */
    public static function convertToSnakeCase(array $params): array
    {
        // 変換した値を格納する配列
        $result = [];

        foreach ($params as $key => $value) {
            // キャメルケース → スネークケースに変換
            $key = Inflector::underscore($key);
            $result[$key] = $value;
        }

        return $result;
    }
    
    /**
     * スネークケースからキャメルケースへの変換処理
     * 
     * @param array $params パラメータ
     * @return array 処理結果配列
     */
    public static function convertToCamelCase(array $params): array
    {
        $result = [];

        foreach ($params as $key => $value) {
            // キーが文字列以外の場合は変換しない
            if (is_string($key)) {
                $key = Inflector::variable($key);
            }

            // 値が配列の場合は再帰的に変換を行う
            if (is_array($value)) {
                $result[$key] = self::convertToCamelCase($value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}