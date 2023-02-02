<?php

declare(strict_types=1);

namespace KeyziPHP\SSE\Event;

final class Comment extends BaseEvent {

	public function __construct(protected readonly string $comment) {
	}

	public function __toString(): string {
		//TODO: multiline comment?
		return ": {$this->comment}" . static::END_MESSAGE;
	}
}
