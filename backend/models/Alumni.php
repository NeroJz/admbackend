<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumni".
 *
 * @property integer $alumni_id
 * @property string $e_nama
 * @property string $e_kp
 * @property integer $e_jantina
 * @property string $e_alamat
 * @property string $e_poskod
 * @property string $e_alamat_tetap
 * @property string $e_poskod_tetap
 * @property string $e_tel_rumah
 * @property string $e_tel_hp
 * @property string $e_emel1
 * @property string $e_emel2
 * @property string $e_program
 * @property string $e_fakulti
 * @property string $e_tahun_tamat
 */
class Alumni extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alumni';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['e_nama', 'e_kp', 'e_jantina', 'e_alamat', 'e_poskod', 'e_alamat_tetap', 'e_poskod_tetap', 'e_tel_rumah', 'e_tel_hp', 'e_emel1', 'e_emel2', 'e_program', 'e_fakulti', 'e_tahun_tamat'], 'required'],
            [['e_jantina'], 'integer'],
            [['e_nama', 'e_fakulti'], 'string', 'max' => 500],
            [['e_kp', 'e_tel_rumah'], 'string', 'max' => 15],
            [['e_alamat', 'e_alamat_tetap'], 'string', 'max' => 700],
            [['e_poskod', 'e_poskod_tetap', 'e_tahun_tamat'], 'string', 'max' => 10],
            [['e_tel_hp'], 'string', 'max' => 20],
            [['e_emel1', 'e_emel2'], 'string', 'max' => 50],
            [['e_program'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alumni_id' => 'Alumni ID',
            'e_nama' => 'E Nama',
            'e_kp' => 'E Kp',
            'e_jantina' => 'E Jantina',
            'e_alamat' => 'E Alamat',
            'e_poskod' => 'E Poskod',
            'e_alamat_tetap' => 'E Alamat Tetap',
            'e_poskod_tetap' => 'E Poskod Tetap',
            'e_tel_rumah' => 'E Tel Rumah',
            'e_tel_hp' => 'E Tel Hp',
            'e_emel1' => 'E Emel1',
            'e_emel2' => 'E Emel2',
            'e_program' => 'E Program',
            'e_fakulti' => 'E Fakulti',
            'e_tahun_tamat' => 'E Tahun Tamat',
        ];
    }
}
