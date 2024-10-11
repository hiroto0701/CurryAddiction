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
            'マトンカレー 🐑',
            'バターチキンカレー 🧈🐓',
            'ベジタブルカレー 🥦',
            'ダールカレー（豆カレー） 🫘',
            'ビリヤニ 🍚',
            'ジャパニーズカレー 🗾',
            'インドカレー 👳🏾‍♂️',
            'スリランカカレー 🦁',
            'スープカレー 🥘',
            'オリジナルカレー 👨🏻‍🍳',
            'カレーヌードル 🍜'
        ];

        // その他以外のカレーを挿入
        foreach ($curryGenres as $genre) {
            DB::table('genres')->insert(
                [
                    'name' => $genre,
                ] + $this->commonColumns
            );
        }

        // "その他" を id = 99 に固定
        DB::table('genres')->insert(
            [
                'id' => 99,
                'name' => 'その他 🍛',
            ] + $this->commonColumns
        );
    }
}
