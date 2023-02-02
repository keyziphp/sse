<?php

declare(strict_types=1);

namespace KeyziPHP\SSE\Event;

abstract class BaseEvent implements \Stringable {
	const END_MESSAGE = "\n\n";
}
