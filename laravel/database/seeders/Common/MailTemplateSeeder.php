<?php

declare(strict_types=1);

namespace Database\Seeders\Common;

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
                'type' => MailTemplate::TYPE_SEND_TWO_STEP_AUTHENTICATION_TOKEN,   // 確認コード通知メール
                'subject' => '【重要】ログインの認証コード（Curry Addiction）',
                'body' => <<<'EOS'
                Curry Addictionにログインするための認証コードが発行されました。
                ご本人確認のため、以下の認証コードを入力してください。

                ------------------------------------
                認証コード：
                {!!$onetime_token!!}
                ------------------------------------

                このコードは発行後5分間有効です。
                有効期限を過ぎると無効となりますので、ご注意ください。

                本メールに心当たりがない場合は、無視してください。

                このメールは送信専用となっております。
                ご返信いただいてもお応えできかねますのでご了承ください。

                [Curry Addiction] サポート

                EOS,
            ] + $this->commonColumns
        );
    }
}
