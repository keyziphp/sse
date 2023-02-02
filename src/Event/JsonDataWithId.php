<?php

declare(strict_types=1);

namespace KeyziPHP\SSE\Event;

final class JsonDataWithId extends JsonDataOnly {
	public function __construct(protected readonly string|int $id, protected readonly string $event_name, mixed $data) {
		parent::__construct($data);
	}

	public function __toString(): string {
		return implode("\n", [
			"id: {$this->id}",
			"event: {$this->event_name}",
			parent::__toString(),
		]);
	}
}
