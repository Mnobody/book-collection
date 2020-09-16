<?php

declare(strict_types=1);

namespace App\Widget;

use Yiisoft\Html\Html;
use Yiisoft\Yii\Bootstrap5\Widget;

final class Message extends Widget
{
    private array $options = [];
    private string $body;
    private string $type;
    private bool $withCloseButton = true;

    protected function run(): string
    {
        $this->buildOptions();

        return
            Html::beginTag('div', $this->options) . "\n" .
                $this->renderBody() . "\n" .
                $this->renderCloseButton() . "\n" .
            Html::endTag('div');
    }

    private function buildOptions(): void
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-flash-message";
        }
        if (!isset($this->options['role'])) {
            $this->options['role'] = 'alert';
        }

        $this->options['class'] = "alert alert-{$this->type}" . ($this->withCloseButton ? ' alert-dismissible fade show' : '');
    }

    private function renderBody(): string
    {
        return $this->body;
    }

    private function renderCloseButton(): string
    {
        if (!$this->withCloseButton) {
            return '';
        }

        return Html::button(
            Html::tag('span', '&times;', ['aria-hidden' => 'true']),
            ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']
        );
    }

    public function body(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function withCloseButton(bool $value): self
    {
        $this->withCloseButton = $value;
        return $this;
    }
}
