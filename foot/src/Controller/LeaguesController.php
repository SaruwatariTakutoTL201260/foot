<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use App\Facade\LeagueFacade;
use Cake\Event\EventInterface;

/**
 * リーグController
 * 
 * @package App\Controller
 * @property \App\Facade\LeagueFacade $facade
 */
class LeaguesController extends AppController
{
    /**
     * リーグFacade
     * 
     * @var \App\Facade\LeagueFacade
     */
    protected LeagueFacade $facade;

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
        $this->facade = new LeagueFacade();
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
     * 企業一覧データ取得
     *
     * @return 
     */
    public function index(): void
    {
        // アクセス許可メソッド判定
        $this->request->allowMethod(['get']);

        // クエリストリングと企業IDを取得条件として設定
        $condition = $this->request->getQueryParams();

        $result = $this->facade->executeIndex([]);

        // 取得した処理結果を返す
        $this->set('result', $result);
    }
}
