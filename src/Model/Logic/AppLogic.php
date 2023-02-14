<?php
declare(strict_types=1);

namespace App\Model\Logic;

use Cake\Database\Query;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use App\Traits\LoggerTrait;
use Cake\ORM\Table;

/**
 * Logic基盤
 * 
 * Logic側でクエリを生成して、本クラスでデータ取得処理を一元化
 *
 * @package App\Model\Logic
 */
class AppLogic
{
    // Trait設定
    use LoggerTrait;

    // TableLocator設定
    use LocatorAwareTrait;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    /**
     * EntityInterface取得処理
     *
     * 実行クエリ結果が存在する場合のみEntityInterfaceを返す
     * 結果が存在しない場合はnullを返す
     *
     * @param \Cake\ORM\Query $query 実行クエリ
     * @return \Cake\Datasource\EntityInterface|null 対象モデルEntityInterface
     */
    public function fetchEntityInterface(Query $query): ?EntityInterface
    {
        return $query->first();
    }

    /**
     * ResultSetInterface取得処理
     *
     * 実行クエリ結果が存在する場合のみResultSetInterfaceを返す
     * 結果が存在しない場合はnullを返す
     *
     * @param \Cake\ORM\Query $query 実行クエリ
     * @return \Cake\Datasource\ResultSetInterface|null 対象モデルResultSetInterface
     */
    public function fetchResultSetInterface(Query $query): ?ResultSetInterface
    {
        $resultSetInterface = $query->all();

        if ($resultSetInterface->isEmpty()) {
            return null;
        }

        return $resultSetInterface;
    }

    /**
     * バリデーションエラーメッセージ生成処理
     *
     * バリデーション時のエラーメッセージを配列形式に再生成して返す
     * getError()のパラメータには対象フィールドがセットされる
     * メッセージの末尾に改行コードをつける
     *
     * 添字部分のマジックナンバーは実際にはエラー概要がセットされる(_requiredなど)
     * エラー概要配下に関しては本来はループを実施する必要があるが、エラー概要をKeyとして
     * メッセージ部分をValueとして取得するだけのためマジックナンバーを使用している
     *
     * @param \Cake\Datasource\EntityInterface $entity エラー発生対象EntityInterface
     * @return array 生成したバリデーションエラーメッセージ配列
     */
    public function generateValidationErrorMessage(EntityInterface $entity): array
    {
        $errorMessageList = [];

        foreach ($entity->getErrors() as $key => $value) {
                $errorMessageList[] = array_values($entity->getError($key))[0] . "\n";
            }

        return $errorMessageList;
    }

    /**
     * 更新EntityInterface生成処理
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param \Cake\Datasource\EntityInterface $entityInterface 対象EntityInterface
     * @param array $params 登録パラメータ
     * @return \Cake\Datasource\EntityInterface 生成したEntityInterface
     */
    public function createPatchEntity(
        Table $targetTable,
        EntityInterface $entityInterface,
        array $params
    ): EntityInterface {
        return $targetTable->patchEntity($entityInterface, $params);
    }

    /**
     * データ登録処理
     *
     * INSERT / UPDATE両方対応<br>
     * 対象データを1件INSERT / UPDATE実行<br>
     * エラー時はfalseを返すため、必要あれば呼び元でエラーメッセージを取得すること<br>
     * 例：$entityInterface->getErrors(); // エラーメッセージが配列で格納される
     *
     * @param \Cake\ORM\Table $targetTable 対象テーブル
     * @param \Cake\Datasource\EntityInterface $entityInterface 対象EntityInterface
     * @return \Cake\Datasource\EntityInterface|false 登録後EntityInterface
     */
    public function storeEntity(Table $targetTable, EntityInterface $entityInterface): bool | EntityInterface
    {

        // データ登録処理実行
        $targetTable->save($entityInterface);

        if ($entityInterface->hasErrors()) {
            // バリデーションエラー時は処理中断
            return false;
        }

        return $entityInterface;
    }
}