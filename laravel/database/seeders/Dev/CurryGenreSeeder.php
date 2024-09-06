<?php

declare(strict_types=1);

namespace Database\Seeders\Dev;

use Database\Seeders\AbstractSeeder;
use Illuminate\Support\Facades\DB;

class CurryGenreSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curryGenres = [
            'キーマカレー 🥩',
            'チキンカレー 🐓',
            'ビーフカレー 🐂',
            'ポークカレー 🐖',
            'シーフードカレー 🦐',
            'ベジタブルカレー 🥦',
            'バターチキンカレー 🧈🐔',
            'マトンカレー 🐑',
            'ココナッツカレー 🥥',
            'ダールカレー（豆カレー） 🫘',
            'ビリヤニ 🍚',
            'インドカレー 🇮🇳',
            'スリランカカレー 🇱🇰',
            'スープカレー 🥘',
            'その他 🍛'
        ];
        

        foreach ($curryGenres as $genre) {
            DB::table('genres')->insert(
                [
                    'name' => $genre,
                ] + $this->commonColumns
            );
        }
	}
}
