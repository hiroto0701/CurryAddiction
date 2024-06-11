<?php

namespace App\Mail;

use App\Models\MailTemplate;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Blade;

abstract class DbTemplateMailable extends Mailable
{
    /**
     * @var ?MailTemplate
     */
    protected ?MailTemplate $template;
    protected ?MailTemplate $defaultTemplate;

    /**
     * DBのmail_templatesからテンプレートを取得するメールの基底クラス
     *
     * @param int $mailTemplateType
     */
    public function __construct(int $mailTemplateType)
    {
        $this->defaultTemplate = MailTemplate::where('type', $mailTemplateType)
            ->first();
        $this->template = MailTemplate::where('type', $mailTemplateType)
            ->first();
    }

    /**
    * DBのテンプレートでSubjectが定義されていればSubjectを書き換え
    *
    * @param  $message
    * @return DbTemplateMailable
    */
    public function buildSubject($message): DbTemplateMailable
    {
        $templateSubjectString = $this->template?->subject ?? $this->defaultTemplate?->subject;
        $templateSubject = $templateSubjectString ? Blade::render($templateSubjectString, $this->viewData) : null;
        $this->subject = $templateSubject ?? $this->subject;
        return parent::buildSubject($message);
    }

    /**
     * DBのテンプレートでbodyが定義されていればrawで書き換え
     *
     * @return array|string
     * @throws \ReflectionException
     */
    protected function buildView()
    {
        $templateBody = $this->template?->body ?? $this->defaultTemplate?->body;
        if ($templateBody !== null) {
            return [
                'raw' => Blade::render($templateBody, $this->viewData)
            ];
        }
        return parent::buildView();
    }
}
