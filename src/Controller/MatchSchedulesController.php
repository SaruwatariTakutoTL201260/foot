<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use App\Facade\MatchSheduleFacade;
use Cake\Event\EventInterface;

/**
 * 試合日程Controller
 * 
 * @package App\Controller
 * @property \App\Facade\MatchSheduleFacade $facade
 */
class MatchSchedulesController extends AppController
{
    /**
     * 試合日程Facade
     * 
     * @var \App\Facade\MatchSheduleFacade
     */
    protected MatchSheduleFacade $facade;

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
        $this->facade = new MatchSheduleFacade();
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
     * 試合日程一覧取得
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
// dd($result);
        // 取得した処理結果を返す
        $this->set('result', $result);
    }
}
