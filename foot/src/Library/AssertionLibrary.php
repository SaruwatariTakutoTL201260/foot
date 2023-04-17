<?php
declare(strict_types=1);

namespace App\Library;

use Cake\ORM\Query;

/**
 * ユニットテスト用ライブラリ
 *
 * テスト実行時に使用するメソッドを定義<br>
 * テスト以外に使用する想定はない
 *
 * @package App/Library
 */
class AssertionLibrary
{
    /**
     * リテラル文字列型リスト
     *
     * 生成されるクエリ内でシングルクォートで値が囲まれる前提の型
     *
     * @var string[]
     */
    private const LITERAL_LIST = [
        'string', 'text', 'json', 'date', 'datetime', 'timestamp', 'time', 'uuid'
    ];

    /**
     * 数値型リスト
     *
     * 生成されるクエリ内で値をそのまま使用する前提の型
     *
     * @var string[]
     */
    private const NUMERIC_LIST = [
        'integer', 'biginteger', 'tinyinteger', 'boolean', 'float', 'decimal'
    ];

    /**
     * エスケープ処理対象文字
     *
     * ピリオドはエイリアス指定の関係上除外している<br>
     * 半角ハイフンは[]の間に記載する場合はエスケープ必要だが除外
     *
     * @var string[]
     */
    private const ESCAPED_LIST = [
        '\\' => '\\',
        '*' => '\*',
        '+' => '\+',
        '?' => '\?',
        '{' => '\{',
        '}' => '\}',
        '(' => '\(',
        ')' => '\)',
        '[' => '\[',
        ']' => '\]',
        '^' => '\^',
        '$' => '\$',
        '|' => '\|',
        '/' => '\/',
    ];

    /**
     * 実行SQL文字列生成処理
     *
     * 生成済のクエリに対して指定したパラメータを含むSQL文字列を返す<br>
     * カスタムファインダーのテスト実施時等に使用する想定
     *
     * @param \Cake\ORM\Query $query 対象クエリ
     * @return string|false パラメータをバインドしたクエリ文字列
     */
    public static function getBindingQuery(Query $query): string | false
    {
        // クエリから未バインドSQL文字列を取得
        $queryString = $query->sql();

        // バインドしたパラメータを取得
        $bindParams = $query->getValueBinder()->bindings();

        foreach ($bindParams as $param => $value) {
            if (in_array($value['type'], self::NUMERIC_LIST)) {
                // 数値型の場合
                $queryString = mb_ereg_replace(
                    $param,
                    "{$value['value']}",
                    $queryString
                );
            } elseif (in_array($value['type'], self::LITERAL_LIST)) {
                // リテラル文字列の場合
                $queryString = mb_ereg_replace(
                    $param,
                    "'{$value['value']}'",
                    $queryString
                );
            } else {
                // 上記以外の場合はリテラル文字列型として扱う
                // Logicのテスト実行時にcontainしている場合、typeが取得できないためこのような処理にしている
                $queryString = mb_ereg_replace(
                    $param,
                    "'{$value['value']}'",
                    $queryString
                );
            }
        }

        // 生成したSQL文字列を返す
        return $queryString;
    }

    /**
     * 対象パターンエスケープ処理
     *
     * カスタムファインダーテスト時等に使用<br>
     * assertRegExpSql()の処理内容が正規表現のため、エスケープ処理が必要な場合に使用すること
     * エスケープ対象文字は定数指定
     *
     * @param string $pattern 指定されたパターン
     * @return string エスケープ処理後のパターン
     */
    public static function getEscapedPattern(string $pattern): string
    {
        // 指定されたパターン文字列を1文字ずつ分割して配列にセット
        $splitChar = mb_str_split($pattern);

        // エスケープ文字列格納変数初期化
        $escapedPattern = '';

        foreach ($splitChar as $char) {
            if (array_key_exists($char, self::ESCAPED_LIST)) {
                // エスケープ処理対象文字の場合は文字列置換してセット
                $escapedPattern .= self::ESCAPED_LIST[$char];
            } else {
                $escapedPattern .= $char;
            }
        }

        // エスケープ処理後の文字列を返す
        return $escapedPattern;
    }
}
