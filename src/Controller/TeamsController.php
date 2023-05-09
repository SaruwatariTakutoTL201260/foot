<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use App\Facade\TeamFacade;
use Cake\Event\EventInterface;

/**
 * チームController
 * 
 * @package App\Controller
 * @property \App\Facade\LeagueFacade $facade
 */
class TeamsController extends AppController
{
    /**
     * チームFacade
     * 
     * @var \App\Facade\TeamFacade
     */
    protected TeamFacade $facade;

    /**
     * 初期化
     *
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Facade設定
        $this->facade = new TeamFacade();
    }

    /**
     * 前処理
     *
     * @param \Cake\Event\EventInterface $event イベント
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * チーム一覧取得
     *
     * @return 
     */
    public function index(): void
    {
        // アクセス許可メソッド判定
        $this->request->allowMethod(['get']);

        // クエリを設定
        $condition = $this->request->getQueryParams();

        if (isset($condition['league_id'])) {
            $condition['league_id'] = (int)$condition['league_id'];
        }

        $result = $this->facade->executeIndex($condition);

        // 取得した処理結果を返す
        $this->set('result', $result);
    }

    /**
     * チームデータ取得
     *
     * @param int $id 取得ID
     * @return void
     */
    public function view(int $id): void
    {
        // アクセス許可メソッド判定
        $this->request->allowMethod(['get']);

        $result = $this->facade->executeIndex(['id' => $id]);

        // 取得した処理結果を返す
        $this->set('result', $result);
    }
}
