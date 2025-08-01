<?php

declare(strict_types=1);

namespace Kreait\Firebase\Messaging;

use Beste\Json;
use Kreait\Firebase\Exception\InvalidArgumentException;
use Kreait\Firebase\Exception\Messaging\InvalidArgument;
use Stringable;

use function array_filter;
use function array_intersect;
use function array_keys;
use function count;
use function implode;

/**
 * @see https://firebase.google.com/docs/reference/fcm/rest/v1/projects.messages
 *
 * @phpstan-import-type AndroidConfigShape from AndroidConfig
 * @phpstan-import-type ApnsConfigShape from ApnsConfig
 * @phpstan-import-type FcmOptionsShape from FcmOptions
 * @phpstan-import-type MessageInputShape from Message
 * @phpstan-import-type MessageOutputShape from Message
 * @phpstan-import-type NotificationShape from Notification
 * @phpstan-import-type WebPushConfigShape from WebPushConfig
 */
final class CloudMessage implements Message
{
    private MessageData $data;

    private Notification $notification;

    private AndroidConfig $androidConfig;

    private ApnsConfig $apnsConfig;

    private WebPushConfig $webPushConfig;

    private FcmOptions $fcmOptions;

    private function __construct(
        private MessageTarget $target,
    ) {
        $this->data = MessageData::fromArray([]);
        $this->notification = Notification::fromArray([]);
        $this->androidConfig = AndroidConfig::fromArray([]);
        $this->apnsConfig = ApnsConfig::fromArray([]);
        $this->webPushConfig = WebPushConfig::fromArray([]);
        $this->fcmOptions = FcmOptions::fromArray([]);
    }

    /**
     * @deprecated 7.16.0 Use `CloudMessage::new()` and one of `toToken()`, `toTopic()`, or `toCondition()` instead.
     *
     * @param MessageTarget::CONDITION|MessageTarget::TOKEN|MessageTarget::TOPIC|MessageTarget::UNKNOWN $type
     * @param non-empty-string $value
     */
    public static function withTarget(string $type, string $value): self
    {
        return new self(MessageTarget::with($type, $value));
    }

    public static function new(): self
    {
        return new self(MessageTarget::with(MessageTarget::UNKNOWN, 'unknown'));
    }

    /**
     * @param MessageInputShape $data
     */
    public static function fromArray(array $data): self
    {
        if (count(array_intersect(array_keys($data), MessageTarget::TYPES)) > 1) {
            throw new InvalidArgument(
                'A message can only have one of the following targets: '
                .implode(', ', MessageTarget::TYPES),
            );
        }

        $new = new self(self::determineTargetFromArray($data));

        $messageData = $data['data'] ?? null;
        if ($messageData !== null) {
            $new = $new->withData($messageData);
        }

        $notification = $data['notification'] ?? null;
        if ($notification !== null) {
            $new = $new->withNotification($notification);
        }

        $androidConfig = $data['android'] ?? null;
        if ($androidConfig !== null) {
            $new = $new->withAndroidConfig($androidConfig);
        }

        $apnsConfig = $data['apns'] ?? null;
        if ($apnsConfig !== null) {
            $new = $new->withApnsConfig($apnsConfig);
        }

        $webPushConfig = $data['webpush'] ?? null;
        if ($webPushConfig !== null) {
            $new = $new->withWebPushConfig($webPushConfig);
        }

        $fcmOptions = $data['fcm_options'] ?? null;
        if ($fcmOptions !== null) {
            return $new->withFcmOptions($fcmOptions);
        }

        return $new;
    }

    /**
     * @deprecated 7.16.0 Use one of `toToken()`, `toTopic()`, or `toCondition()` instead.
     *
     * @param MessageTarget::CONDITION|MessageTarget::TOKEN|MessageTarget::TOPIC|MessageTarget::UNKNOWN $type
     * @param non-empty-string $value
     *
     * @throws InvalidArgumentException if the target type or value is invalid
     */
    public function withChangedTarget(string $type, string $value): self
    {
        $new = clone $this;
        $new->target = MessageTarget::with($type, $value);

        return $new;
    }

    /**
     * @param MessageData|array<non-empty-string, Stringable|string> $data
     *
     * @throws InvalidArgumentException
     */
    public function withData(MessageData|array $data): self
    {
        $new = clone $this;
        $new->data = $data instanceof MessageData ? $data : MessageData::fromArray($data);

        return $new;
    }

    /**
     * @param Notification|NotificationShape $notification
     *
     * @throws InvalidArgumentException
     */
    public function withNotification(Notification|array $notification): self
    {
        $new = clone $this;
        $new->notification = $notification instanceof Notification ? $notification : Notification::fromArray($notification);

        return $new;
    }

    /**
     * @param AndroidConfig|AndroidConfigShape $config
     *
     * @throws InvalidArgumentException
     */
    public function withAndroidConfig($config): self
    {
        $new = clone $this;
        $new->androidConfig = $config instanceof AndroidConfig ? $config : AndroidConfig::fromArray($config);

        return $new;
    }

    /**
     * @param ApnsConfig|ApnsConfigShape $config
     *
     * @throws InvalidArgumentException
     */
    public function withApnsConfig($config): self
    {
        $new = clone $this;
        $new->apnsConfig = $config instanceof ApnsConfig ? $config : ApnsConfig::fromArray($config);

        return $new;
    }

    /**
     * @param WebPushConfig|WebPushConfigShape $config
     */
    public function withWebPushConfig($config): self
    {
        $new = clone $this;
        $new->webPushConfig = $config instanceof WebPushConfig ? $config : WebPushConfig::fromArray($config);

        return $new;
    }

    /**
     * @param FcmOptions|FcmOptionsShape $options
     */
    public function withFcmOptions($options): self
    {
        $new = clone $this;
        $new->fcmOptions = $options instanceof FcmOptions ? $options : FcmOptions::fromArray($options);

        return $new;
    }

    /**
     * Enables default notifications sounds on iOS and Android devices. WebPush doesn't support sounds.
     */
    public function withDefaultSounds(): self
    {
        $new = clone $this;
        $new->apnsConfig = $this->apnsConfig->withDefaultSound();
        $new->androidConfig = $this->androidConfig->withDefaultSound();

        return $new;
    }

    public function withLowestPossiblePriority(): self
    {
        $new = clone $this;
        $new->apnsConfig = $this->apnsConfig->withPowerConservingPriority();
        $new->androidConfig = $this->androidConfig->withNormalMessagePriority();
        $new->webPushConfig = $this->webPushConfig->withVeryLowUrgency();

        return $new;
    }

    public function withHighestPossiblePriority(): self
    {
        $new = clone $this;
        $new->apnsConfig = $this->apnsConfig->withImmediatePriority();
        $new->androidConfig = $this->androidConfig->withHighMessagePriority();
        $new->webPushConfig = $this->webPushConfig->withHighUrgency();

        return $new;
    }

    /**
     * @param non-empty-string $token
     */
    public function toToken(string $token): self
    {
        $new = clone $this;
        $new->target = MessageTarget::with(MessageTarget::TOKEN, $token);

        return $new;
    }

    /**
     * @param non-empty-string $topic
     */
    public function toTopic(string $topic): self
    {
        $new = clone $this;
        $new->target = MessageTarget::with(MessageTarget::TOPIC, $topic);

        return $new;
    }

    /**
     * @param non-empty-string $condition
     */
    public function toCondition(string $condition): self
    {
        $new = clone $this;
        $new->target = MessageTarget::with(MessageTarget::CONDITION, $condition);

        return $new;
    }

    /**
     * @deprecated 7.16.0
     */
    public function hasTarget(): bool
    {
        return $this->target->type() !== MessageTarget::UNKNOWN;
    }

    /**
     * @deprecated 7.16.0
     */
    public function target(): MessageTarget
    {
        return $this->target;
    }

    public function jsonSerialize(): array
    {
        $data = [
            'data' => $this->data,
            'notification' => $this->notification,
            'android' => $this->androidConfig,
            'apns' => $this->apnsConfig,
            'webpush' => $this->webPushConfig,
            'fcm_options' => $this->fcmOptions,
        ];

        $data = Json::decode(Json::encode($data), true);

        if ($this->target->type() !== MessageTarget::UNKNOWN) {
            $data[$this->target->type()] = $this->target->value();
        }

        return array_filter(
            $data,
            static fn($value): bool => $value !== null && $value !== [],
        );
    }

    /**
     * @param array<mixed> $data
     */
    private static function determineTargetFromArray(array $data): MessageTarget
    {
        $targetValue = $data[MessageTarget::CONDITION] ?? null;
        if ($targetValue !== null) {
            return MessageTarget::with(MessageTarget::CONDITION, $targetValue);
        }

        $targetValue = $data[MessageTarget::TOKEN] ?? null;
        if ($targetValue !== null) {
            return MessageTarget::with(MessageTarget::TOKEN, $targetValue);
        }

        $targetValue = $data[MessageTarget::TOPIC] ?? null;
        if ($targetValue) {
            return MessageTarget::with(MessageTarget::TOPIC, $targetValue);
        }

        return MessageTarget::with(MessageTarget::UNKNOWN, 'unknown');
    }
}
