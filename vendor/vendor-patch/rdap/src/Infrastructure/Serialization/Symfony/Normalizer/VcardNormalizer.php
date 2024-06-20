<?php

declare(strict_types=1);
/**
 * Registration Data Access Protocol – core objects implementation package according to the RFC 7483
 *
 * @link      https://github.com/hiqdev/rdap
 * @package   rdap
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2019, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\rdap\core\Infrastructure\Serialization\Symfony\Normalizer;

use JeroenDesloovere\VCard\VCard;
use Sabre\VObject\Reader as VCardReader;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class EnumNormalizer.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
final class VcardNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }


    public function getSupportedTypes(?string $format): array {
      return ['*']; 
    }
    
    /** {@inheritdoc} */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof VCard;
    }

    /** {@inheritdoc} */
    public function normalize(mixed $object, ?string $format = null, array $context = []): \ArrayObject|array|string|int|float|bool|null
    {
        /** @var VCard $object */
        $vCardString = $object->buildVCard();

        $vCardObject = VCardReader::read($vCardString);

        return $vCardObject->jsonSerialize();
    }
}
