<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property string $name
 * @property string $team
 * @property string $role
 * @property int $fk_game_id
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'fk_game_id'], 'required'],
            [['fk_game_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['team', 'role'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Your name',
            'team' => 'Team',
            'role' => 'Role',
            'fk_game_id' => 'Fk Game ID',
        ];
    }
}