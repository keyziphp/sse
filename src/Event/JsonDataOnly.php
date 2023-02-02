<?php

declare(strict_types=1);

namespace KeyziPHP\SSE\Event;

class JsonDataOnly extends BaseEvent {

	protected readonly string $json;

	public function __construct(protected readonly mixed $data) {
		$this->json = json_encode($this->data, \JSON_THROW_ON_ERROR);
	}

	public function __toString(): string {
		return "data: {$this->json}" . static::END_MESSAGE;
	}
}
