<?php

declare(strict_types=1);

namespace Database\Seeders\Dev;

use App\Models\MailTemplate;
use Database\Seeders\AbstractSeeder;
use Illuminate\Support\Facades\DB;

class MailTemplateSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// メールテンプレート追加
        DB::table('mail_templates')->insert(
            [
                'type' => MailTemplate::TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN,   // 確認コード通知メール1
                'subject' => 'ログインの確認コード（Curry Addiction）',
                'body' => <<<'EOS'
                Curry Addictionにログインするための確認コードが発行されました。
                -------------------------------------------------------
                確認コード：
                {!!$onetime_token!!}
                -------------------------------------------------------

                このメールは送信専用となっております。
                ご返信いただいてもお応えできかねますのでご了承ください。

                本メールに心当たりがない場合は、無視してください。

                EOS,
            ] + $this->commonColumns
        );
    }
}
