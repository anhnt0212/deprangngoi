<?php

namespace AppBundle\Resizer;

use Imagine\Image\ImagineInterface;
use Imagine\Image\Box;
use Gaufrette\File;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Resizer\ResizerInterface;
use Imagine\Image\ImageInterface;
use Imagine\Exception\InvalidArgumentException;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;

class CustomResizer implements ResizerInterface {

    protected $adapter;
    protected $mode;
    protected $metadata;

    /**
     * @param ImagineInterface $adapter
     * @param string $mode
     */
    public function __construct(ImagineInterface $adapter, $mode, MetadataBuilderInterface $metadata) {
        $this->adapter = $adapter;
        $this->mode = $mode;
        $this->metadata = $metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function resize(MediaInterface $media, File $in, File $out, $format, array $settings) {
        if (!(isset($settings['width']) && $settings['width']))
            throw new \RuntimeException(sprintf('Width parameter is missing in context "%s" for provider "%s"', $media->getContext(), $media->getProviderName()));

        $image = $this->adapter->load($in->getContent());

        $content = $image->thumbnail($this->getBox($media, $settings), $this->mode)->get($format, array('quality' => $settings['quality']));

        $out->setContent($content, $this->metadata->get($media, $out->getName()));
    }

    /**
     * {@inheritdoc}
     */
    public function getBox(MediaInterface $media, array $settings) {
        $hasWidth = isset($settings['width']) && $settings['width'];
        $hasHeight = isset($settings['height']) && $settings['height'];
        $media->setWidth(180);
        $media->setHeight(180);
        if (!$hasWidth && !$hasHeight):
            throw new \RuntimeException(sprintf('Width/Height parameter is missing in context "%s" for provider "%s". Please add at least one parameter.', $media->getContext(), $media->getProviderName()));
        endif;
        if ($hasWidth && $hasHeight):
            if ($settings['width'] < 1):
                $settings['width'] = 180;
            endif;
            if ($settings['height'] < 1):
                $settings['height'] = $settings['width'];
            endif;
            return new Box($settings['width'], $settings['height']);
        endif;

        $size = $media->getBox();
        if (!$hasHeight):
            $settings['height'] = intval($settings['width'] * $size->getHeight() / $size->getWidth());
        endif;

        if (!$hasWidth):
            $settings['width'] = intval($settings['height'] * $size->getWidth() / $size->getHeight());
        endif;
        return $this->computeBox($media, $settings);
    }

    /**
     * @throws InvalidArgumentException
     *
     * @param MediaInterface $media
     * @param array $settings
     *
     * @return Box
     */
    private function computeBox(MediaInterface $media, array $settings) {
        if ($this->mode !== ImageInterface::THUMBNAIL_INSET && $this->mode !== ImageInterface::THUMBNAIL_OUTBOUND)
            throw new InvalidArgumentException('Invalid mode specified');

        $size = $media->getBox();

        $ratios = [
            $settings['width'] / $size->getWidth(),
            $settings['height'] / $size->getHeight()
        ];

        if ($this->mode === ImageInterface::THUMBNAIL_INSET)
            $ratio = min($ratios);
        else
            $ratio = max($ratios);

        return $size->scale($ratio);
    }

}
