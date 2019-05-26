<?php

namespace app\models;

use Yii;
use app\models\Player;
use app\helpers\RoleHelper;

/**
 * This is the model class for table "game".
 *
 * @property int $id
 * @property string $timestamp
 * @property string $started
 * @property int $players
 * @property string $percival
 * @property string $mordred
 * @property string $morgana
 * @property string $oberon
 */
class Game extends \yii\db\ActiveRecord
{
    // Number of players determine the number of minion
    public $minionRules = [
        5 => 2,
        6 => 2,
        7 => 3,
        8 => 3,
        9 => 3,
        10 => 4
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp', 'players'], 'required'],
            [['started', 'percival', 'mordred', 'morgana', 'oberon'], 'string'],
            [['players'], 'integer'],
            [['timestamp'], 'string', 'max' => 50],
            ['players', 'checkRules'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'started' => 'Started',
            'players' => 'Players',
            'percival' => 'Percival',
            'mordred' => 'Mordred',
            'morgana' => 'Morgana',
            'oberon' => 'Oberon',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function checkRules($attribute, $params)
    {
        $specialMinionCount = 0;
        if ($this->mordred == "1") $specialMinionCount++;
        if ($this->morgana == "1") $specialMinionCount++;
        if ($this->oberon == "1") $specialMinionCount++;

        $numberOfMinions = $this->minionRules[$this->players];

        if ($specialMinionCount > $numberOfMinions) {
            $this->addError('players', 'Number of special characters out number minion count!');
        }
    }

    /**
     * Start the game!
     * @return [type] [description]
     */
    public function startGame()
    {
        // do a rule check
        if($this->validate() && $this->checkNumberOfPlayers()) {
            $this->assignRoles();
            return true;
        }

        return false;
    }

    /**
     * Check if all players have joined
     * @return boolean True if all players have joined
     */
    private function checkNumberOfPlayers()
    {
        $playerCount = $this->getPlayerCount();

        if ($playerCount < $this->players) {
            $this->addError('players', 'Not all players have joined yet!');
        }

        return $playerCount == $this->players;
    }

    public function checkOpenSlot()
    {
        $playerCount = $this->getPlayerCount();
        return $playerCount < $this->players;
    }

    /**
     * Get number of players joined
     * @return int
     */
    public function getPlayerCount()
    {
        return $playerCount = Player::find()->where(['fk_game_id' => $this->id])->count();
    }

    /**
     * Assign roles and save to database
     */
    private function assignRoles()
    {
        $roles = RoleHelper::assign($this);

        // @todo save roles to database
        ArrayHelper::fPrint($roles);exit;
    }
}
