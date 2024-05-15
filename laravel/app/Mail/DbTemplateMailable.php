<?php

namespace App\Mail;

use App\Models\MailTemplate;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Factory;

abstract class DbTemplateMailable extends Mailable
{
    /**
     * @var ?MailTemplate
     */
    private ?MailTemplate $template;

    public $body;

    public $templateType;

    /**
     * DBのmail_templatesからテンプレートを取得するメールの基底クラス
     *
     * @param int $managementCompanyId
     * @param int $mailTemplateType
     * @param MailTemplate $rawMailTemplate
     */
    public function __construct(int $mailTemplateType, MailTemplate $rawMailTemplate = null)
    {
        $this->templateType = $mailTemplateType;
        //指定されたテンプレートを使用
        $this->template = $rawMailTemplate;
    }

    /**
    * DBのテンプレートでSubjectが定義されていればSubjectを書き換え
    *
    * @param  \Illuminate\Mail\Message  $message
    * @return $this
    */
    public function buildSubject($message)
    {
        $templateSubject = optional($this->template)->subject;
        if ($templateSubject !== null) {
            $this->subject = Blade::render($templateSubject, $this->viewData);
        }
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
        $templateBody = optional($this->template)->body;
        if ($templateBody !== null) {
            $this->body = Blade::render($templateBody, $this->viewData);
            return [
                'raw' => $this->body,
            ];
        }
        return parent::buildView();
    }

    /**
     * Subject、Bodyを書き換え(テンプレート編集プレビュー用)
     *
     */
    public function buildPreview()
    {
        $templateSubject = optional($this->template)->subject;
        if ($templateSubject !== null) {
            $this->subject = Blade::render($templateSubject, $this->viewData);
        }
        $templateBody = optional($this->template)->body;
        if ($templateBody !== null) {
            $this->body = Blade::render($templateBody, $this->viewData);
        }
    }
}
