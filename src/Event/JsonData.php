<?php

declare(strict_types=1);

namespace KeyziPHP\SSE\Event;

final class JsonData extends JsonDataOnly {
	public function __construct(protected readonly string $event_name, mixed $data) {
		parent::__construct($data);
	}

	public function __toString(): string {
		return "event: {$this->event_name}\n" . parent::__toString();
	}
}

